<?php
/**
 * tools/build-css.php
 * Safe CSS concatenation and minification tool.
 *
 * Guarantees:
 * 1. ZERO corruption of calc(), var(), and env() expressions.
 * 2. Exact preservation of spacing and syntax inside attribute selectors (e.g. [style*="--accent: #E8611A"]).
 * 3. Exact preservation of quoted strings and url() values.
 * 4. Automated verification gates (--check mode).
 */

function minify_css(string $css): string {
    $tokens = [];
    $tokenIndex = 0;

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

    return trim($css);
}

function verify_minified_css(string $srcCss, string $minCss): array {
    $errors = [];

    // Gate 1: Check for mangled var(), env(), calc()
    if (preg_match('/var\(\s*-\s+-|env\([a-z]+\s+-\s+|calc\([^)]*[a-z]\s+-\s+[a-z]/i', $minCss, $m)) {
        $errors[] = "Corrupted var/env/calc expression found: " . $m[0];
    }

    // Gate 2: Check attribute selector spacing preservation
    preg_match_all('/\[style\*="[^"]*"\]/', $srcCss, $srcAttrs);
    preg_match_all('/\[style\*="[^"]*"\]/', $minCss, $minAttrs);
    $srcUnique = array_unique($srcAttrs[0] ?? []);
    $minUnique = array_unique($minAttrs[0] ?? []);
    sort($srcUnique);
    sort($minUnique);
    if ($srcUnique !== $minUnique) {
        $errors[] = "Attribute selectors mismatch! Source: " . implode(', ', $srcUnique) . " vs Min: " . implode(', ', $minUnique);
    }

    // Gate 3: Brace balance check
    $openCount  = substr_count($minCss, '{');
    $closeCount = substr_count($minCss, '}');
    if ($openCount !== $closeCount) {
        $errors[] = "Brace mismatch! '{' count: {$openCount}, '}' count: {$closeCount}";
    }

    return $errors;
}

// CLI runner
if (php_sapi_name() === 'cli' && isset($argv[0]) && realpath($argv[0]) === __FILE__) {
    $baseDir = dirname(__DIR__);
    $checkOnly = in_array('--check', $argv, true);

    echo "Running build-css.php...\n";

    $componentsSrc = $baseDir . '/assets/css/components.css';
    $componentsMin = $baseDir . '/assets/css/components.min.css';

    if (file_exists($componentsSrc)) {
        $src = file_get_contents($componentsSrc);
        $min = minify_css($src);

        $errs = verify_minified_css($src, $min);
        if (!empty($errs)) {
            echo "VERIFICATION FAILED:\n" . implode("\n", $errs) . "\n";
            exit(1);
        }

        if (!$checkOnly) {
            file_put_contents($componentsMin, $min);
            echo "Successfully generated {$componentsMin} (" . number_format(strlen($min)) . " bytes)\n";
        } else {
            echo "Verification passed for components.css!\n";
        }
    }

    // Build core.css (resolving tokens.css) -> core.min.css
    $coreSrc = $baseDir . '/assets/css/core.css';
    $coreMin = $baseDir . '/assets/css/core.min.css';
    if (file_exists($coreSrc)) {
        $src = file_get_contents($coreSrc);
        $tokensSrc = $baseDir . '/assets/css/tokens.css';
        if (file_exists($tokensSrc)) {
            $tokensContent = file_get_contents($tokensSrc);
            $src = str_replace("@import './tokens.css';", $tokensContent, $src);
        }
        $min = minify_css($src);
        $errs = verify_minified_css($src, $min);
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

    $pageSheets = ['zh.css', 'perpanjangan-skp.css', 'jadwal-pelatihan.css', 'kota.css'];
    foreach ($pageSheets as $sheet) {
        $sheetSrc = $baseDir . '/assets/css/page/' . $sheet;
        $sheetMin = str_replace('.css', '.min.css', $sheetSrc);
        if (file_exists($sheetSrc)) {
            $src = file_get_contents($sheetSrc);
            $min = minify_css($src);
            $errs = verify_minified_css($src, $min);
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