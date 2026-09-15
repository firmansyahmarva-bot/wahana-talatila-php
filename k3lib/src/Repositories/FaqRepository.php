<?php
namespace App\Repositories;

use App\Database;

class FaqRepository
{
    private \PDO $db;
    public function __construct() { $this->db = Database::connection(); }

    // Program-specific FAQs first, then generic ones. Deduped, capped.
    public function forProgram(?int $programId, int $limit = 6): array
    {
        if ($programId) {
            $stmt = $this->db->prepare(
                "SELECT * FROM faqs WHERE program_id = ? OR program_id IS NULL
                 ORDER BY (program_id IS NULL), sort_order LIMIT ?"
            );
            $stmt->bindValue(1, $programId, \PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, \PDO::PARAM_INT);
        } else {
            $stmt = $this->db->prepare(
                "SELECT * FROM faqs WHERE program_id IS NULL ORDER BY sort_order LIMIT ?"
            );
            $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
