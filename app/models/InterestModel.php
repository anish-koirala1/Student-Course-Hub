<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use PDO;
use PDOException;

final class InterestModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function register(int $programmeId, string $name, string $email): bool
    {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO InterestedStudents (ProgrammeID, StudentName, Email)
                 VALUES (:programme, :name, :email)"
            );
            return $stmt->execute([
                'programme' => $programmeId,
                'name' => $name,
                'email' => strtolower($email),
            ]);
        } catch (PDOException $exception) {
            return false;
        }
    }

    public function withdraw(int $programmeId, string $email): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM InterestedStudents WHERE ProgrammeID = :programme AND Email = :email"
        );
        $stmt->execute(['programme' => $programmeId, 'email' => strtolower($email)]);
        return $stmt->rowCount() > 0;
    }

    public function byProgramme(int $programmeId): array
    {
        $stmt = $this->db->prepare(
            "SELECT StudentName, Email, RegisteredAt
             FROM InterestedStudents
             WHERE ProgrammeID = :id
             ORDER BY RegisteredAt DESC"
        );
        $stmt->execute(['id' => $programmeId]);
        return $stmt->fetchAll();
    }
}
