<?php
namespace App\Sync;

// Mirrors the main `trainings` table into programs_cache (SELECT-only against
// the main DB). Only place the engine ever reads the source of truth.
class ProgramSync
{
    public function __construct(private \PDO $mainDb, private \PDO $hubDb) {}

    public function run(): int
    {
        $rows = $this->mainDb->query(
            "SELECT id, slug, name, price, duration_days, mode, certification,
                    category_id, description, is_active
             FROM trainings"
        )->fetchAll(\PDO::FETCH_ASSOC);

        $settings = require __DIR__ . '/../../config/settings.php';

        $up = $this->hubDb->prepare(
            "INSERT INTO programs_cache
                (id, slug, name, price, duration_days, mode, certification,
                 category_id, description, is_active, external_url, synced_at)
             VALUES
                (:id,:slug,:name,:price,:dur,:mode,:cert,:cat,:desc,:active,:url,NOW())
             ON DUPLICATE KEY UPDATE
                slug=VALUES(slug), name=VALUES(name), price=VALUES(price),
                duration_days=VALUES(duration_days), mode=VALUES(mode),
                certification=VALUES(certification), category_id=VALUES(category_id),
                description=VALUES(description), is_active=VALUES(is_active),
                external_url=VALUES(external_url), synced_at=NOW()"
        );

        $n = 0;
        foreach ($rows as $r) {
            $up->execute([
                'id'     => $r['id'],
                'slug'   => $r['slug'],
                'name'   => $r['name'],
                'price'  => $r['price'],
                'dur'    => $r['duration_days'],
                'mode'   => $r['mode'],
                'cert'   => $r['certification'],
                'cat'    => $r['category_id'],
                'desc'   => $r['description'],
                'active' => $r['is_active'],
                'url'    => str_replace('{slug}', $r['slug'], $settings['program_url_pattern']),
            ]);
            $n++;
        }
        return $n;
    }
}
