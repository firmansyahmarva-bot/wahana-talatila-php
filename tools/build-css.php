<?php
/**
 * tools/build-css.php
 * Safe CSS concatenation and minification tool with 4 automated verification gates.
 *
 * Guarantees:
 * 1. ZERO corruption of calc(), var(), and env() expressions.
 * 2. Exact preservation of spacing and syntax inside attribute selectors (e.g. [style*="--accent: #E8611A"]).
 * 3. Exact preservation of quoted strings and url() values.
 * 4. Automated verification gates:
 *    - Gate 1: No var/env/calc expression corruption.
 *    - Gate 2: Attribute selector preservation.
 *    - Gate 3: Exact curly brace balance check.
 *    - Gate 4: Zero UTF-8 BOM/U+FEFF, valid :root survival, and undeclared var() check.
 */

function read_css(string $path): string {
    if (!file_exists($path)) {
        return '';
    }
    $css = file_get_contents($path);
    // Strip leading UTF-8 BOM if present
    return preg_replace('/^\xEF\xBB\xBF/', '', $css);
}

function minify_css(string $css): string {
    $tokens = [];
    $tokenIndex = 0;

    // Strip BOM and null bytes
    $css = preg_replace('/^\xEF\xBB\xBF/', '', $css);
    $css = str_replace("\xEF\xBB\xBF", '', $css);

    // 1. Strip comments first so commented code isn't tokenized
    $css = preg_replace('#/\*.*?\*/#s', '', $css);

    // 2. Tokenize attribute selectors [...] to preserve exact spaces inside [style*="..."]
    $css = preg_replace_callback('/\[[^\]]+\]/s', function ($m) use (&$tokens, &$tokenIndex) {
        $key = "___ATTR_TOKEN_{$tokenIndex}___";
        $tokens[$key] = $m[0];
        $tokenIndex++;
        return $key;
    }, $css);

    // 3. Tokenize calc(), var(), env() with recursive paren matching
    $funcRegex = '/\b(calc|var|env)\s*(\((?>[^()]+|(?2))*\))/is';
    $css = preg_replace_callback($funcRegex, function ($m) use (&$tokens, &$tokenIndex) {
        $key = "___FUNC_TOKEN_{$tokenIndex}___";
        $tokens[$key] = $m[0];
        $tokenIndex++;
        return $key;
    }, $css);

    // 4. Tokenize url(...)
    $css = preg_replace_callback('/url\s*(\((?>[^()]+|(?1))*\))/is', function ($m) use (&$tokens, &$tokenIndex) {
        $key = "___URL_TOKEN_{$tokenIndex}___";
        $tokens[$key] = $m[0];
        $tokenIndex++;
        return $key;
    }, $css);

    // 5. Tokenize remaining quoted strings: "..." and '...'
    $css = preg_replace_callback('/"(?:\\\\.|[^"\\\\])*"|\'(?:\\\\.|[^\'\\\\])*\'/s', function ($m) use (&$tokens, &$tokenIndex) {
        $key = "___STR_TOKEN_{$tokenIndex}___";
        $tokens[$key] = $m[0];
        $tokenIndex++;
        return $key;
    }, $css);

    // 6. Collapse multiple whitespace outside tokens
    $css = preg_replace('/\s+/', ' ', $css);

    // 7. Remove whitespace around delimiters
    $css = preg_replace('/\s*([\{\};:,>~+])\s*/', '$1', $css);

    // 8. Clean up unnecessary semicolons before closing brace
    $css = str_replace(';}', '}', $css);

    // 9. Restore tokens in reverse order (so nested tokens inside calc/attr/strings restore correctly)
    krsort($tokens);
    $css = strtr($css, $tokens);
    // Double pass in case of tokens containing tokens
    $css = strtr($css, $tokens);

    // Final clean of any residual BOM or leading/trailing whitespace
    $css = preg_replace('/^\xEF\xBB\xBF/', '', $css);
    $css = str_replace("\xEF\xBB\xBF", '', $css);

    return trim($css);
}

function verify_minified_css(string $srcCss, string $minCss, array $knownTokens = []): array {
    $errors = [];

    // Gate 1: Check for mangled var(), env(), calc()
    if (preg_match('/var\(\s*-\s+-|env\([a-z]+\s+-\s+|calc\([^)]*[a-z]\s+-\s+[a-z]/i', $minCss, $m)) {
        $errors[] = "Gate 1: Corrupted var/env/calc expression found: " . $m[0];
    }

    // Gate 2: Check attribute selector spacing preservation
    preg_match_all('/\[style\*="[^"]*"\]/', $srcCss, $srcAttrs);
    preg_match_all('/\[style\*="[^"]*"\]/', $minCss, $minAttrs);
    $srcUnique = array_unique($srcAttrs[0] ?? []);
    $minUnique = array_unique($minAttrs[0] ?? []);
    sort($srcUnique);
    sort($minUnique);
    if ($srcUnique !== $minUnique) {
        $errors[] = "Gate 2: Attribute selectors mismatch! Source: " . implode(', ', $srcUnique) . " vs Min: " . implode(', ', $minUnique);
    }

    // Gate 3: Brace balance check
    $openCount  = substr_count($minCss, '{');
    $closeCount = substr_count($minCss, '}');
    if ($openCount !== $closeCount) {
        $errors[] = "Gate 3: Brace mismatch! '{' count: {$openCount}, '}' count: {$closeCount}";
    }

    // Gate 4: Zero BOM / U+FEFF check
    if (preg_match('/\x{FEFF}/u', $minCss) || str_starts_with($minCss, "\xEF\xBB\xBF")) {
        $errors[] = "Gate 4: BOM/U+FEFF present in minified output";
    }

    // Gate 4b: :root survival check
    if (str_contains($srcCss, ':root') && !str_starts_with($minCss, ':root{') && !str_starts_with($minCss, ':root ')) {
        $errors[] = "Gate 4b: No :root rule cleanly survived at start of minified output";
    }

    // Gate 4c: Undefined var() check (assert every var(--foo) has a declared token or allowlist entry)
    preg_match_all('/var\(\s*(--[\w-]+)\s*\)/', $minCss, $used);
    preg_match_all('/(--[\w-]+)\s*:/', $minCss, $declared);
    $allowList = [
        '--green', '--green-dark', '--green-mid', '--green-light',
        '--orange', '--orange-dark', '--orange-light',
        '--theme-color-primary', '--theme-color-accent',
        '--zh-font',
        '--reveal-delay', // dynamic per-element animation stagger
    ];
    $declaredTokens = array_merge($declared[1] ?? [], $knownTokens, $allowList);
    $missing = array_diff(array_unique($used[1] ?? []), array_unique($declaredTokens));
    if (!empty($missing)) {
        $errors[] = "Gate 4c: Undeclared var() tokens used without fallback: " . implode(', ', $missing);
    }

    return $errors;
}

// CLI runner
if (php_sapi_name() === 'cli' && isset($argv[0]) && realpath($argv[0]) === __FILE__) {
    $baseDir = dirname(__DIR__);
    $checkOnly = in_array('--check', $argv, true);

    echo "Running build-css.php...\n";

    // 1. Build core.css (concatenating tokens.css + core.css) -> core.min.css
    $tokensSrc = $baseDir . '/assets/css/tokens.css';
    $coreSrc   = $baseDir . '/assets/css/core.css';
    $coreMin   = $baseDir . '/assets/css/core.min.css';

    $coreTokens = [];
    if (file_exists($tokensSrc)) {
        $tokensContent = read_css($tokensSrc);
        preg_match_all('/(--[\w-]+)\s*:/', $tokensContent, $dt);
        $coreTokens = array_unique($dt[1] ?? []);
    }

    if (file_exists($coreSrc)) {
        $coreContent = read_css($coreSrc);
        // Prepend tokens cleanly without BOM
        $src = (isset($tokensContent) ? $tokensContent . "\n" : "") . $coreContent;
        $min = minify_css($src);
        $errs = verify_minified_css($src, $min, $coreTokens);
        if (!empty($errs)) {
            echo "VERIFICATION FAILED for core.css:\n" . implode("\n", $errs) . "\n";
            exit(1);
        }
        if (!$checkOnly) {
            file_put_contents($coreMin, $min);
            echo "Successfully generated {$coreMin} (" . number_format(strlen($min)) . " bytes)\n";
        } else {
            echo "Verification passed for core.css!\n";
        }
    }

    // 2. Build components.css -> components.min.css
    $componentsSrc = $baseDir . '/assets/css/components.css';
    $componentsMin = $baseDir . '/assets/css/components.min.css';

    if (file_exists($componentsSrc)) {
        $src = read_css($componentsSrc);
        $min = minify_css($src);

        $errs = verify_minified_css($src, $min, $coreTokens);
        if (!empty($errs)) {
            echo "VERIFICATION FAILED for components.css:\n" . implode("\n", $errs) . "\n";
            exit(1);
        }

        if (!$checkOnly) {
            file_put_contents($componentsMin, $min);
            echo "Successfully generated {$componentsMin} (" . number_format(strlen($min)) . " bytes)\n";
        } else {
            echo "Verification passed for components.css!\n";
        }
    }

    // 3. Build page stylesheets
    $pageSheets = ['home.css', 'zh.css', 'perpanjangan-skp.css', 'jadwal-pelatihan.css', 'kota.css'];
    foreach ($pageSheets as $sheet) {
        $sheetSrc = $baseDir . '/assets/css/page/' . $sheet;
        $sheetMin = str_replace('.css', '.min.css', $sheetSrc);
        if (file_exists($sheetSrc)) {
            $src = read_css($sheetSrc);
            $min = minify_css($src);
            $errs = verify_minified_css($src, $min, $coreTokens);
            if (!empty($errs)) {
                echo "VERIFICATION FAILED for {$sheet}:\n" . implode("\n", $errs) . "\n";
                exit(1);
            }
            if (!$checkOnly) {
                file_put_contents($sheetMin, $min);
                echo "Successfully generated {$sheetMin} (" . number_format(strlen($min)) . " bytes)\n";
            } else {
                echo "Verification passed for {$sheet}!\n";
            }
        }
    }

    echo "All CSS verification checks PASSED cleanly.\n";
    exit(0);
}