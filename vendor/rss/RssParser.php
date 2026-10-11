<?php
/**
 * RssParser — lightweight RSS/Atom feed parser using PHP's SimpleXML.
 * No external dependencies. Used for K3 news and incident database auto-update.
 */
class RssParser {
    private int    $timeout;
    private string $userAgent;

    public function __construct(int $timeout = 15) {
        $this->timeout   = $timeout;
        $this->userAgent = 'Mozilla/5.0 (compatible; WahanaTotalitaBot/1.0; +https://wahanatotalita.com)';
    }

    /**
     * Parse one or more RSS/Atom feeds and return normalized item array.
     * @param  string|array $urls  Single URL string or array of URLs
     * @param  int          $limit Max items to return per feed (0 = all)
     * @return array               List of ['title','link','description','date','source'] items
     */
    public function fetch(string|array $urls, int $limit = 20): array {
        $urls  = (array)$urls;
        $items = [];
        foreach ($urls as $url) {
            try {
                $raw  = $this->download($url);
                $feed = $this->parse($raw, $url, $limit);
                $items = array_merge($items, $feed);
            } catch (Throwable $e) {
                error_log("[RssParser] Error fetching $url: " . $e->getMessage());
            }
        }
        usort($items, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);
        return $items;
    }

    /**
     * Download feed content via cURL.
     */
    private function download(string $url): string {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_USERAGENT      => $this->userAgent,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_ENCODING       => 'gzip, deflate',
            CURLOPT_HTTPHEADER     => ['Accept: application/rss+xml, application/atom+xml, text/xml, */*'],
        ]);
        $body = curl_exec($ch);
        $err  = curl_error($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($err || $body === false) throw new RuntimeException("cURL error: $err");
        if ($code < 200 || $code >= 300) throw new RuntimeException("HTTP $code for $url");
        return (string)$body;
    }

    /**
     * Parse raw XML into normalized item array.
     */
    private function parse(string $xml, string $sourceUrl, int $limit): array {
        libxml_use_internal_errors(true);
        $sxe = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        libxml_clear_errors();
        if (!$sxe) return [];

        $items      = [];
        $sourceName = parse_url($sourceUrl, PHP_URL_HOST) ?? $sourceUrl;

        // Detect RSS vs Atom
        if (isset($sxe->channel)) {
            // RSS 2.0
            $channel = $sxe->channel;
            $entries = $channel->item ?? [];
            foreach ($entries as $item) {
                $items[] = [
                    'title'       => $this->text($item->title),
                    'link'        => $this->text($item->link),
                    'description' => $this->stripHtml($this->text($item->description)),
                    'date'        => $this->text($item->pubDate ?? $item->{'dc:date'} ?? ''),
                    'timestamp'   => strtotime($this->text($item->pubDate ?? '')) ?: 0,
                    'source'      => $sourceName,
                    'source_url'  => $sourceUrl,
                    'category'    => $this->text($item->category ?? ''),
                ];
                if ($limit > 0 && count($items) >= $limit) break;
            }
        } elseif (isset($sxe->entry)) {
            // Atom
            foreach ($sxe->entry as $entry) {
                $link = '';
                foreach ($entry->link as $l) {
                    if ((string)($l['rel'] ?? '') !== 'alternate') continue;
                    $link = (string)$l['href'];
                }
                if (!$link) $link = (string)($entry->link['href'] ?? '');
                $items[] = [
                    'title'       => $this->text($entry->title),
                    'link'        => $link,
                    'description' => $this->stripHtml($this->text($entry->summary ?? $entry->content ?? '')),
                    'date'        => $this->text($entry->updated ?? $entry->published ?? ''),
                    'timestamp'   => strtotime($this->text($entry->updated ?? '')) ?: 0,
                    'source'      => $sourceName,
                    'source_url'  => $sourceUrl,
                    'category'    => '',
                ];
                if ($limit > 0 && count($items) >= $limit) break;
            }
        }
        return $items;
    }

    private function text(mixed $node): string {
        if ($node === null) return '';
        return trim((string)$node);
    }

    private function stripHtml(string $html): string {
        $text = strip_tags(str_replace(['<br>', '<br/>', '<br />'], ' ', $html));
        return preg_replace('/\s+/', ' ', $text);
    }

    /**
     * Filter items that contain any of the given keywords (case-insensitive).
     */
    public function filterByKeywords(array $items, array $keywords): array {
        return array_values(array_filter($items, function ($item) use ($keywords) {
            $haystack = strtolower($item['title'] . ' ' . $item['description'] . ' ' . $item['category']);
            foreach ($keywords as $kw) {
                if (str_contains($haystack, strtolower($kw))) return true;
            }
            return false;
        }));
    }

    /**
     * Pre-defined Indonesian K3/HSE news feeds.
     */
    public static function k3Feeds(): array {
        return [
            'https://www.kemnaker.go.id/feed',
            'https://www.ilo.org/global/topics/safety-and-health-at-work/newsroom/news/lang--en/rss.xml',
            'https://news.google.com/rss/search?q=kecelakaan+kerja+indonesia&hl=id&gl=ID&ceid=ID:id',
            'https://news.google.com/rss/search?q=K3+keselamatan+kerja&hl=id&gl=ID&ceid=ID:id',
            'https://news.google.com/rss/search?q=BNSP+sertifikasi&hl=id&gl=ID&ceid=ID:id',
        ];
    }

    /**
     * Pre-defined LPSE/tender news feeds.
     */
    public static function tenderFeeds(): array {
        return [
            'https://news.google.com/rss/search?q=LPSE+pengadaan+pemerintah+yogyakarta&hl=id&gl=ID&ceid=ID:id',
            'https://news.google.com/rss/search?q=tender+BUMN+2025&hl=id&gl=ID&ceid=ID:id',
        ];
    }
}
