<?php
namespace App\Sync;

// Regenerates the `keywords` long-tail surface from programs_cache x modifiers
// x cities. Idempotent (INSERT IGNORE on unique norm_slug). Re-run after a
// ProgramSync when the program list changes.
//
// NOTE: this builds the DEMAND-MATCHING surface, not indexed URLs. /k3 stays
// the single indexed page; these phrases are served on demand and power the
// hub's internal topical index.
class KeywordBuilder
{
    // Commercial-intent modifiers (Indonesian buyer language). Mix of
    // price/logistics (biaya, jadwal…), trust/quality (resmi, terpercaya…),
    // and question-style phrasing (cara daftar, berapa biaya…) — these mirror
    // how people actually type into Google, not just keyword-stuffed nouns.
    private const MODIFIERS = [
        'biaya'         => 'biaya %s',
        'harga'         => 'harga %s',
        'jadwal'        => 'jadwal %s',
        'syarat'        => 'syarat %s',
        'materi'        => 'materi %s',
        'online'        => '%s online',
        'training'      => 'training %s',
        'sertifikasi'   => 'sertifikasi %s',
        'kursus'        => 'kursus %s',
        'terdekat'      => '%s terdekat',
        'resmi'         => '%s resmi',
        'murah'         => '%s murah',
        'terbaik'       => '%s terbaik',
        'tersertifikasi'=> '%s tersertifikasi',
        'lembaga'       => 'lembaga %s',
        'tempat'        => 'tempat %s',
        'info'          => 'info %s',
        'cara_daftar'   => 'cara daftar %s',
        'berapa_biaya'  => 'berapa biaya %s',
        'kapan_jadwal'  => 'kapan jadwal %s',
        'terpercaya'    => '%s terpercaya',
        'batch'         => 'batch %s',
    ];

    // Cities: provincial capitals (broad reach) plus the mining/oil&gas
    // industrial hubs where actual K3 training demand concentrates — the
    // {training} x {city} pattern already proven in GSC:
    // /pelatihan-k3-pekanbaru/ = 147 impressions from one page.
    private const CITIES = [
        // provincial capitals / major cities
        'jakarta','surabaya','bandung','medan','semarang','makassar','palembang',
        'pekanbaru','balikpapan','samarinda','batam','bekasi','tangerang','depok',
        'bogor','yogyakarta','malang','denpasar','banjarmasin','pontianak',
        // industrial / mining / oil&gas hubs (core K3 buyer geography)
        'cilegon','karawang','cikarang','gresik','sidoarjo','dumai','duri','cepu',
        'sangatta','bontang','tarakan','berau','sorong','muara enim','banjarbaru',
        'pangkalpinang','jambi','lampung','manado','kendari',
    ];

    public function __construct(private \PDO $hubDb) {}

    public function run(): int
    {
        $programs = $this->hubDb->query(
            "SELECT id, name FROM programs_cache WHERE is_active = 1"
        )->fetchAll(\PDO::FETCH_ASSOC);

        $ins = $this->hubDb->prepare(
            "INSERT IGNORE INTO keywords (phrase, norm_slug, program_id, modifier, city)
             VALUES (?,?,?,?,?)"
        );

        $count = 0;
        foreach ($programs as $p) {
            $base = $this->core($p['name']);

            $phrase = 'pelatihan ' . $base;
            $ins->execute([$phrase, norm_slug($phrase), $p['id'], 'base', null]);
            $count++;

            foreach (self::MODIFIERS as $mod => $tpl) {
                $phrase = sprintf($tpl, $base);
                $ins->execute([$phrase, norm_slug($phrase), $p['id'], $mod, null]);
                $count++;
            }

            foreach (self::CITIES as $city) {
                $phrase = 'pelatihan ' . $base . ' ' . $city;
                $ins->execute([$phrase, norm_slug($phrase), $p['id'], 'kota', $city]);
                $count++;
            }
        }

        return $count;
    }

    // Shorten a long program name to its core (drops the "| Sertifikasi X" tail).
    private function core(string $name): string
    {
        $name = preg_replace('/\s*\|.*$/', '', $name);
        $name = preg_replace('/^Pelatihan(\s+dan\s+Sertifikasi)?\s+/i', '', $name);
        return trim($name);
    }
}
