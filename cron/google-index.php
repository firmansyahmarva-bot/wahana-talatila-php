<?php
/**
 * cron/google-index.php
 * Requests Google to (re)crawl URLs via the Google Indexing API.
 * Self-contained: native cURL + openssl, no Composer/libraries needed.
 *
 * ⚠️ HONEST CAVEAT: Google's Indexing API OFFICIALLY supports only JobPosting
 * and BroadcastEvent pages. For ordinary content pages Google frequently
 * ACCEPTS the request (HTTP 200) but does NOT actually index faster. Treat
 * this as a nudge, not a cure. The real levers are: a clean sitemap, fixing
 * 503-on-DB-error, and making pages genuinely unique.
 *
 * SETUP (one-time):
 *  1. Google Cloud Console → create project → enable "Indexing API".
 *  2. Create a Service Account → create a JSON key → download it.
 *  3. In Google Search Console → Settings → Users and permissions →
 *     add the service account's client_email as an OWNER of the property.
 *  4. Paste client_email and private_key below.
 */

declare(strict_types=1);
error_reporting(E_ALL);

// ─── 1. PASTE YOUR SERVICE ACCOUNT JSON VALUES HERE ──────────────────────────
$SERVICE_ACCOUNT = [
    'client_email' => 'wahana-indexing@pena-consultant.iam.gserviceaccount.com',
    'private_key'  => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDHh+hIMKc9MIG1\n3uGdN5CmyK4CBArfRYnWrhaH14lHc0XCnFjNMP4B+mNixmGtYOfSEc66BFUld7xA\ncPFvDI8N9nHwnbQHxikC7Ugppbu6+GFbD2KZJT4Bb4rJxuVRf9qoJJ4Us3Vz8uRT\nNuTjQffBmU0kj4eLVM1kl9LigFqjeBA91UecEFgpa2IbNuYD6yRWh+Xsr72E3whQ\nmUA09CrMPakfNleNyLRJ80SyNN4NQCmuZ9IWbpresX2E8ikfzJMrsPJCYnaE+NA7\nxMeeBUnZsm3q/cGfybRHwBct5Aof3L+QF8aeFAdIWecXsmMt1QKXBGop6bDbCfR5\nWIV6nYrnAgMBAAECggEAEZgbdHyNARL6AeJosypkDNjmqYXXh/v23UfJJwRR9hg+\nvzWpibpqtrW9NfrRQFUQ5ZytXzvxK1ZSDFdvndlJJs2KGx7RpUFx4PCxOGVSI8WY\nH0vz56/GUAd/NC8S9ITmI1J+eZigRqLVEFaau0SLYMMwVet6fV/Zo3Rulr6dTD53\nsFSN9LiEVc8PAWBzvY6WiLniw3SjICQx7QmAYytarWTfX+FA0MQxiImILyoU6xVT\nEbvW3kGkeVICIhNeqHxpKCYnnGNmsD5BDdUzEg7AqUptSX6ORxNarry46uNRPuPl\nDCPAQsvDdRAvjLi1uKSZu4ln5HDnwN9CuYmObehdQQKBgQDi4M02UZAdLLZxfzeA\nkfhMPJV7IyFxuIac1xYVvhPgqkFCXDqXuYyJ+bBWJYwy06C6Djz7S4/aXnM9jXkc\nQ8TAzgstUTpTrU0cPXA7ur5U13JwNUK1+Od2ixzR2nwu+A7hJgqDSdc/Xh1oJjFH\nKOlEg5IvehTbQ7tvGHqhUfH7wQKBgQDhJHo1jQjvV0NlcTTkHjILyfWqKys5+AKV\nOsQThMsGIatRWFvTTVOAhuxzQIBaXzewjoJkRCbVhuXN612kEUnNp3eO6tkaZspS\nn+nKN/DJH8smFUgpWBwVlseRKlbBUMQIYbb8b2VnvrJ/zEt+C9yP8PUpq2Nm/9ay\nUMKs5JZQpwKBgQCLxYDHgRIu1xgC7iQMYmE83moc9XSqMctEnsGtXW+zjlAsCNPU\nG2y4qAn52KH5wiUX2qO5EUErf9qxRhIh1qJFQeri3VL4sCB8UGFvesm9TQnklPtn\nTlOS1XtI0biF2y6XiK8bWQdxs5KcUkMzmsGzAvexph1pQ94aQFN0RR62QQKBgQC4\nrzOQuiCaNPsUO8knV522DfV3ofHTm56Cy7IMUOI6JWRjVhf9PXFB/Wv5HvArMfB8\n5GoR1dYFUqMwR+KIs6XXDYkFs6BkB+3v2T3uo/ThBzOeCdcoEx72lrkeW5zO93HX\nblCswrRsZgIG048Z1qEXcpGpnO3tj/COVbFcIicsAQKBgFF1gcHdTvyCzmynOw6t\nEPQgIXAkVJNVI5/EfsG16Oww488HtRwDZLmdUCDPdX6ZdrejN3L6UYx9Jydj/Zrd\n8reOqXuDPjuLa6anJRSC3Y+7hrCuJfEhkk1nq6mnBgHgnAtYblPu5sDg6oLA+yz/\nxvxVTnnXPhC784gR0ZZ+DKa6\n-----END PRIVATE KEY-----\n",
];

// ─── 2. URLs to submit ───────────────────────────────────────────────────────
// Option A: hardcode a short list.
// Option B (recommended): pull live from your own sitemap so it stays in sync.
$SITEMAP_URL = 'https://wahanatotalita.com/sitemap.xml';
$MAX_URLS    = 180; // Indexing API free quota is ~200 req/day. Stay under it.

$urls = load_urls_from_sitemap($SITEMAP_URL, $MAX_URLS);
if (!$urls) {
    // Fallback list if sitemap fetch fails:
    $urls = [
        'https://wahanatotalita.com/',
        'https://wahanatotalita.com/artikel/',
    ];
}

// ─── 3. Run ──────────────────────────────────────────────────────────────────
$token = get_access_token($SERVICE_ACCOUNT);
$ok = 0; $fail = 0;
foreach ($urls as $url) {
    [$code, $body] = publish_url($token, $url, 'URL_UPDATED');
    if ($code >= 200 && $code < 300) { $ok++; } else { $fail++; }
    echo date('c') . "  [$code]  $url\n";
    usleep(300000); // 0.3s — be gentle on the API
}
echo "Done. OK=$ok FAIL=$fail\n";

// ─── Helpers ─────────────────────────────────────────────────────────────────
function b64url(string $d): string {
    return rtrim(strtr(base64_encode($d), '+/', '-_'), '=');
}

function get_access_token(array $sa): string {
    $now = time();
    $header = b64url(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
    $claim  = b64url(json_encode([
        'iss'   => $sa['client_email'],
        'scope' => 'https://www.googleapis.com/auth/indexing',
        'aud'   => 'https://oauth2.googleapis.com/token',
        'iat'   => $now,
        'exp'   => $now + 3600,
    ]));
    $input = $header . '.' . $claim;
    $sig = '';
    if (!openssl_sign($input, $sig, $sa['private_key'], 'sha256WithRSAEncryption')) {
        fwrite(STDERR, "Failed to sign JWT — check your private_key formatting.\n");
        exit(1);
    }
    $jwt = $input . '.' . b64url($sig);

    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ]),
        CURLOPT_TIMEOUT        => 30,
    ]);
    $res  = json_decode((string)curl_exec($ch), true);
    curl_close($ch);
    if (empty($res['access_token'])) {
        fwrite(STDERR, "Token error: " . json_encode($res) . "\n");
        exit(1);
    }
    return $res['access_token'];
}

function publish_url(string $token, string $url, string $type): array {
    $ch = curl_init('https://indexing.googleapis.com/v3/urlNotifications:publish');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS     => json_encode(['url' => $url, 'type' => $type]),
        CURLOPT_TIMEOUT        => 30,
    ]);
    $body = (string)curl_exec($ch);
    $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [$code, $body];
}

function load_urls_from_sitemap(string $sitemapUrl, int $max): array {
    $ch = curl_init($sitemapUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_USERAGENT      => 'wahana-indexer/1.0',
    ]);
    $xml = (string)curl_exec($ch);
    curl_close($ch);
    if ($xml === '') return [];
    if (!preg_match_all('#<loc>\s*(.*?)\s*</loc>#i', $xml, $m)) return [];
    $urls = array_map('html_entity_decode', $m[1]);
    return array_slice(array_values(array_unique($urls)), 0, $max);
}
