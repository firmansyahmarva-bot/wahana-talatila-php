<?php
// 1. Extract talks from tools/safety-talk.php
require_once __DIR__ . '/../config.php';
$stContent = file_get_contents(__DIR__ . '/../tools/safety-talk.php');
if (preg_match('/\$talks\s*=\s*(\[[\s\S]*?\]);\s*\n\s*\/\/ Contextual/i', $stContent, $m)) {
    eval('$talks = ' . $m[1] . ';');
    file_put_contents(__DIR__ . '/../data/tools_safety_talk.json', json_encode($talks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "Extracted safety talks: " . count($talks) . "\n";
} else {
    echo "Failed to extract talks\n";
}

if (preg_match('/\$topic_destinations\s*=\s*(\[[\s\S]*?\]);\s*\n/i', $stContent, $m)) {
    eval('$dest = ' . $m[1] . ';');
    file_put_contents(__DIR__ . '/../data/tools_topic_destinations.json', json_encode($dest, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "Extracted topic destinations: " . count($dest) . "\n";
}

// 2. Extract apd from tools/apd-selector.php
$apdContent = file_get_contents(__DIR__ . '/../tools/apd-selector.php');
if (preg_match('/\$apdList\s*=\s*(\[[\s\S]*?\]);\s*\n/i', $apdContent, $m)) {
    eval('$apdList = ' . $m[1] . ';');
    file_put_contents(__DIR__ . '/../data/tools_apd.json', json_encode($apdList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "Extracted apd items: " . count($apdList) . "\n";
} else {
    echo "Failed to extract apdList\n";
}
