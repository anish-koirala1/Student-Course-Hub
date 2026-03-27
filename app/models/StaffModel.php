<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use PDO;

final class StaffModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT StaffID, Name FROM Staff ORDER BY Name'
        )->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT StaffID, Name, Username FROM Staff WHERE StaffID = :id LIMIT 1'
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM Staff WHERE Username = :username LIMIT 1'
        );
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function modulesLed(int $staffId): array
    {
        $stmt = $this->db->prepare(
            'SELECT ModuleID, ModuleName, Description, Image
             FROM Modules
             WHERE ModuleLeaderID = :id
             ORDER BY ModuleName'
        );
        $stmt->execute(['id' => $staffId]);

        return $stmt->fetchAll();
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function programmesAsLeader(int $staffId): array
    {
        $stmt = $this->db->prepare(
            'SELECT p.ProgrammeID, p.ProgrammeName, l.LevelName
             FROM Programmes p
             JOIN Levels l ON l.LevelID = p.LevelID
             WHERE p.ProgrammeLeaderID = :id
             ORDER BY p.ProgrammeName'
        );
        $stmt->execute(['id' => $staffId]);

        return $stmt->fetchAll();
    }

    /**
     * Programme/year rows for each module this staff leads (curriculum impact).
     *
     * @return list<array<string, mixed>>
     */
    public function programmeImpactByStaff(int $staffId): array
    {
        $stmt = $this->db->prepare(
            'SELECT p.ProgrammeID, p.ProgrammeName, l.LevelName, pm.Year, m.ModuleID, m.ModuleName
             FROM Modules m
             JOIN ProgrammeModules pm ON pm.ModuleID = m.ModuleID
             JOIN Programmes p ON p.ProgrammeID = pm.ProgrammeID
             JOIN Levels l ON l.LevelID = p.LevelID
             WHERE m.ModuleLeaderID = :id
             ORDER BY p.ProgrammeName, pm.Year, m.ModuleName'
        );
        $stmt->execute(['id' => $staffId]);

        return $stmt->fetchAll();
    }
}
