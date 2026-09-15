<?php
namespace App\Repositories;

use App\Database;

class KeywordRepository
{
    private \PDO $db;
    public function __construct() { $this->db = Database::connection(); }

    public function findBySlug(string $normSlug): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM keywords WHERE norm_slug = ? LIMIT 1");
        $stmt->execute([$normSlug]);
        return $stmt->fetch() ?: null;
    }

    public function recordHit(int $id): void
    {
        $this->db->prepare("UPDATE keywords SET hits = hits + 1 WHERE id = ?")->execute([$id]);
    }

    // A sensible, grouped slice of long-tails for the hub's internal index —
    // NOT the whole table (dumping 10k links = doorway signal). Grouped by
    // modifier, capped per group.
    public function indexSample(int $perModifier = 12): array
    {
        $mods = $this->db->query("SELECT DISTINCT modifier FROM keywords WHERE modifier IS NOT NULL ORDER BY modifier")->fetchAll();
        $out = [];
        $stmt = $this->db->prepare(
            "SELECT phrase, norm_slug FROM keywords WHERE modifier = ? ORDER BY RAND() LIMIT ?"
        );
        foreach ($mods as $m) {
            $stmt->bindValue(1, $m['modifier'], \PDO::PARAM_STR);
            $stmt->bindValue(2, $perModifier, \PDO::PARAM_INT);
            $stmt->execute();
            $out[$m['modifier']] = $stmt->fetchAll();
        }
        return $out;
    }

    public function total(): int
    {
        return (int)$this->db->query("SELECT COUNT(*) c FROM keywords")->fetch()['c'];
    }
}
