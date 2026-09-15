<?php

declare(strict_types=1);

namespace Engine\Support;

/**
 * Minimal, dependency-free YAML parser/dumper covering the subset the engine
 * actually uses: nested maps, lists (including lists of maps), scalars,
 * quoted strings, inline `[a, b]` lists, `null`/`true`/`false`, ints/floats.
 * No anchors, multi-doc streams, or block scalars — not needed here.
 * Exists so the engine has zero external dependencies (no composer install
 * required to run).
 */
final class Yaml
{
    public static function parseFile(string $path): array
    {
        if (!is_file($path)) {
            return [];
        }

        return self::parse(file_get_contents($path) ?: '');
    }

    public static function parse(string $yaml): array
    {
        $lines = [];
        foreach (explode("\n", str_replace("\r\n", "\n", $yaml)) as $line) {
            $trimmed = trim($line);
            if ($trimmed === '' || $trimmed === '---' || str_starts_with($trimmed, '#')) {
                continue;
            }
            $line = self::stripInlineComment($line);
            if (trim($line) === '') {
                continue;
            }
            $lines[] = rtrim($line);
        }

        if ($lines === []) {
            return [];
        }

        $pos = 0;
        $result = self::parseBlock($lines, $pos, self::indentOf($lines[0]));

        return is_array($result) ? $result : [];
    }

    public static function dump(array $data, int $indentLevel = 0): string
    {
        $pad = str_repeat(' ', $indentLevel * 2);

        if (array_is_list($data)) {
            if ($data === []) {
                return $pad . "[]\n";
            }

            $out = '';
            foreach ($data as $value) {
                if (is_array($value) && $value !== [] && !array_is_list($value)) {
                    $block = rtrim(self::dump($value, 0));
                    $blockLines = explode("\n", $block);
                    $out .= $pad . '- ' . $blockLines[0] . "\n";
                    for ($i = 1; $i < count($blockLines); $i++) {
                        $out .= $pad . '  ' . $blockLines[$i] . "\n";
                    }
                } elseif (is_array($value)) {
                    $out .= $pad . "-\n" . self::dump($value, $indentLevel + 1);
                } else {
                    $out .= $pad . '- ' . self::scalarDump($value) . "\n";
                }
            }

            return $out;
        }

        if ($data === []) {
            return $pad . "{}\n";
        }

        $out = '';
        foreach ($data as $key => $value) {
            $keyStr = self::keyDump((string) $key);
            if (is_array($value)) {
                if ($value === []) {
                    $out .= $pad . $keyStr . ': ' . (array_is_list($value) ? '[]' : '{}') . "\n";
                } else {
                    $out .= $pad . $keyStr . ":\n" . self::dump($value, $indentLevel + 1);
                }
            } else {
                $out .= $pad . $keyStr . ': ' . self::scalarDump($value) . "\n";
            }
        }

        return $out;
    }

    private static function stripInlineComment(string $line): string
    {
        $inQuote = null;
        for ($i = 0, $len = strlen($line); $i < $len; $i++) {
            $char = $line[$i];
            if ($inQuote !== null) {
                if ($char === $inQuote) {
                    $inQuote = null;
                }
                continue;
            }
            if ($char === '"' || $char === "'") {
                $inQuote = $char;
                continue;
            }
            if ($char === '#' && ($i === 0 || $line[$i - 1] === ' ')) {
                return rtrim(substr($line, 0, $i));
            }
        }

        return $line;
    }

    private static function indentOf(string $line): int
    {
        return strlen($line) - strlen(ltrim($line, ' '));
    }

    private static function parseBlock(array $lines, int &$pos, int $indent): mixed
    {
        if (!isset($lines[$pos]) || self::indentOf($lines[$pos]) !== $indent) {
            return null;
        }

        $content = ltrim($lines[$pos]);

        return (str_starts_with($content, '- ') || $content === '-')
            ? self::parseList($lines, $pos, $indent)
            : self::parseMap($lines, $pos, $indent);
    }

    private static function parseList(array $lines, int &$pos, int $indent): array
    {
        $result = [];

        while (isset($lines[$pos]) && self::indentOf($lines[$pos]) === $indent) {
            $content = ltrim($lines[$pos]);
            if (!str_starts_with($content, '-')) {
                break;
            }

            $rest = trim(substr($content, 1));

            if ($rest === '') {
                $pos++;
                $childIndent = isset($lines[$pos]) ? self::indentOf($lines[$pos]) : $indent + 2;
                $result[] = self::parseBlock($lines, $pos, $childIndent);
                continue;
            }

            $colon = self::findColon($rest);
            if ($colon !== null) {
                $keyColStart = $indent + 2;
                $lines[$pos] = str_repeat(' ', $keyColStart) . $rest;
                $result[] = self::parseMap($lines, $pos, $keyColStart);
                continue;
            }

            $result[] = self::scalar($rest);
            $pos++;
        }

        return $result;
    }

    private static function parseMap(array $lines, int &$pos, int $indent): array
    {
        $result = [];

        while (isset($lines[$pos]) && self::indentOf($lines[$pos]) === $indent) {
            $content = ltrim($lines[$pos]);
            if (str_starts_with($content, '-')) {
                break;
            }

            $colon = self::findColon($content);
            if ($colon === null) {
                $pos++;
                continue;
            }

            $key = self::unquote(trim(substr($content, 0, $colon)));
            $valueRaw = trim(substr($content, $colon + 1));
            $pos++;

            if ($valueRaw === '') {
                if (isset($lines[$pos]) && self::indentOf($lines[$pos]) > $indent) {
                    $result[$key] = self::parseBlock($lines, $pos, self::indentOf($lines[$pos]));
                } else {
                    $result[$key] = null;
                }
            } else {
                $result[$key] = self::scalar($valueRaw);
            }
        }

        return $result;
    }

    private static function findColon(string $content): ?int
    {
        if ($content !== '' && ($content[0] === '"' || $content[0] === "'")) {
            $quote = $content[0];
            $end = strpos($content, $quote, 1);
            if ($end !== false) {
                $after = ltrim(substr($content, $end + 1));
                if (str_starts_with($after, ':')) {
                    return strpos($content, ':', $end);
                }
            }
        }

        $pos = strpos($content, ': ');
        if ($pos !== false) {
            return $pos;
        }

        return str_ends_with($content, ':') ? strlen($content) - 1 : null;
    }

    private static function unquote(string $value): string
    {
        if (strlen($value) >= 2 && (($value[0] === '"' && str_ends_with($value, '"')) || ($value[0] === "'" && str_ends_with($value, "'")))) {
            return substr($value, 1, -1);
        }

        return $value;
    }

    private static function scalar(string $value): mixed
    {
        $value = trim($value);

        if ($value === '') {
            return null;
        }
        if (strlen($value) >= 2 && (($value[0] === '"' && str_ends_with($value, '"')) || ($value[0] === "'" && str_ends_with($value, "'")))) {
            return substr($value, 1, -1);
        }
        if ($value === 'null' || $value === '~') {
            return null;
        }
        if ($value === 'true') {
            return true;
        }
        if ($value === 'false') {
            return false;
        }
        if ($value === '[]') {
            return [];
        }
        if (str_starts_with($value, '[') && str_ends_with($value, ']')) {
            $inner = trim(substr($value, 1, -1));

            return $inner === '' ? [] : array_map(static fn ($v) => self::scalar(trim($v)), explode(',', $inner));
        }
        if (preg_match('/^-?\d+$/', $value)) {
            return (int) $value;
        }
        if (preg_match('/^-?\d+\.\d+$/', $value)) {
            return (float) $value;
        }

        return $value;
    }

    private static function scalarDump(mixed $value): string
    {
        if ($value === null) {
            return 'null';
        }
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        return self::quoteIfNeeded((string) $value);
    }

    private static function keyDump(string $key): string
    {
        return self::quoteIfNeeded($key);
    }

    private static function quoteIfNeeded(string $value): string
    {
        $needsQuote = $value === ''
            || $value !== trim($value)
            || str_contains($value, ': ')
            || str_contains($value, '#')
            || str_starts_with($value, '-')
            || in_array($value, ['true', 'false', 'null', '~'], true)
            || preg_match('/^-?\d+(\.\d+)?$/', $value) === 1
            || $value[0] === '"' || $value[0] === "'";

        if (!$needsQuote) {
            return $value;
        }

        return '"' . str_replace(['\\', '"'], ['\\\\', '\\"'], $value) . '"';
    }
}
