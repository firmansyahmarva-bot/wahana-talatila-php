<?php
namespace App\Repositories;

use App\Database;

class ProgramRepository
{
    private \PDO $db;
    public function __construct() { $this->db = Database::connection(); }

    public function allActive(): array
    {
        return $this->db->query(
            "SELECT * FROM programs_cache WHERE is_active = 1
             ORDER BY certification, name"
        )->fetchAll();
    }

    // Grouped by certification for the hub's topical structure.
    public function groupedByCertification(): array
    {
        $grouped = [];
        foreach ($this->allActive() as $p) {
            $grouped[$p['certification'] ?: 'Lainnya'][] = $p;
        }
        return $grouped;
    }

    // On-demand match for an incoming query/slug. Tries the keyword map first
    // (exact), then full-text, then LIKE. Returns best-first matches.
    public function search(string $rawQuery, int $limit = 12): array
    {
        $words = array_filter(explode(' ', strtolower(preg_replace('/[^a-z0-9 ]+/', ' ', strtolower($rawQuery)))));
        if (empty($words)) return [];

        // Full-text in boolean mode across name/description/certification.
        $ftTerms = implode(' ', array_map(fn($w) => $w . '*', $words));
        $stmt = $this->db->prepare(
            "SELECT *, MATCH(name, description, certification) AGAINST(? IN BOOLEAN MODE) AS score
             FROM programs_cache
             WHERE is_active = 1 AND MATCH(name, description, certification) AGAINST(? IN BOOLEAN MODE)
             ORDER BY score DESC LIMIT ?"
        );
        $stmt->bindValue(1, $ftTerms, \PDO::PARAM_STR);
        $stmt->bindValue(2, $ftTerms, \PDO::PARAM_STR);
        $stmt->bindValue(3, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if (!empty($rows)) return $rows;

        // Fallback: LIKE on the longest word.
        usort($words, fn($a, $b) => strlen($b) - strlen($a));
        $like = '%' . $words[0] . '%';
        $stmt = $this->db->prepare(
            "SELECT * FROM programs_cache WHERE is_active = 1 AND name LIKE ? ORDER BY name LIMIT ?"
        );
        $stmt->bindValue(1, $like, \PDO::PARAM_STR);
        $stmt->bindValue(2, $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM programs_cache WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function countActive(): int
    {
        return (int)$this->db->query("SELECT COUNT(*) c FROM programs_cache WHERE is_active = 1")->fetch()['c'];
    }
}
