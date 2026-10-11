<?php
$articles = require __DIR__ . '/20_articles_data.php';

$sql = "-- 20 New High-Converting Commercial Articles for Wahana Totalita\n";
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

foreach ($articles as $a) {
    $title     = addslashes($a['title']);
    $slug      = addslashes($a['slug']);
    $metaTitle = addslashes($a['meta_title']);
    $metaDesc  = addslashes($a['meta_desc']);
    $keywords  = addslashes($a['keywords']);
    $category  = addslashes($a['category']);
    $author    = addslashes($a['author']);
    $content   = addslashes($a['content']);
    $faqData   = addslashes(json_encode($a['faq'], JSON_UNESCAPED_UNICODE));

    $sql .= "INSERT INTO `articles` (`title`, `slug`, `meta_title`, `meta_desc`, `keywords`, `category`, `thumbnail`, `content`, `faq_data`, `author`, `status`, `published_at`, `created_at`, `updated_at`)\n";
    $sql .= "VALUES ('$title', '$slug', '$metaTitle', '$metaDesc', '$keywords', '$category', '', '$content', '$faqData', '$author', 'published', NOW(), NOW(), NOW())\n";
    $sql .= "ON DUPLICATE KEY UPDATE `content` = VALUES(`content`), `meta_desc` = VALUES(`meta_desc`), `meta_title` = VALUES(`meta_title`), `keywords` = VALUES(`keywords`), `faq_data` = VALUES(`faq_data`), `updated_at` = NOW();\n\n";
}

file_put_contents(__DIR__ . '/20_new_articles.sql', $sql);
echo "Generated SQL file: " . __DIR__ . "/20_new_articles.sql (" . filesize(__DIR__ . '/20_new_articles.sql') . " bytes)\n";
