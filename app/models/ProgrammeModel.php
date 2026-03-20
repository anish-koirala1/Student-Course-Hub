<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use PDO;

final class ProgrammeModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function allPublished(?int $levelId, string $query): array
    {
        $sql = "SELECT p.ProgrammeID, p.ProgrammeName, p.Description, p.Image, l.LevelName, s.Name AS ProgrammeLeader
                FROM Programmes p
                JOIN Levels l ON l.LevelID = p.LevelID
                LEFT JOIN Staff s ON s.StaffID = p.ProgrammeLeaderID
                WHERE p.IsPublished = 1";
        $params = [];

        if ($levelId !== null) {
            $sql .= " AND p.LevelID = :level";
            $params['level'] = $levelId;
        }

        if ($query !== '') {
            $sql .= " AND p.ProgrammeName LIKE :q";
            $params['q'] = '%' . $query . '%';
        }

        $sql .= " ORDER BY p.ProgrammeName";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function levels(): array
    {
        return $this->db->query("SELECT LevelID, LevelName FROM Levels ORDER BY LevelID")->fetchAll();
    }

    public function find(int $id, bool $adminMode = false): ?array
    {
        $sql = "SELECT p.*, l.LevelName, s.Name AS ProgrammeLeader
                FROM Programmes p
                JOIN Levels l ON l.LevelID = p.LevelID
                LEFT JOIN Staff s ON s.StaffID = p.ProgrammeLeaderID
                WHERE p.ProgrammeID = :id";
        if (!$adminMode) {
            $sql .= " AND p.IsPublished = 1";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function modulesByYear(int $programmeId): array
    {
        $stmt = $this->db->prepare(
            "SELECT pm.Year, m.ModuleName, m.Description, m.Image, s.Name AS ModuleLeader
             FROM ProgrammeModules pm
             JOIN Modules m ON m.ModuleID = pm.ModuleID
             LEFT JOIN Staff s ON s.StaffID = m.ModuleLeaderID
             WHERE pm.ProgrammeID = :id
             ORDER BY pm.Year, m.ModuleName"
        );
        $stmt->execute(['id' => $programmeId]);
        $rows = $stmt->fetchAll();

        $grouped = [];
        foreach ($rows as $row) {
            $year = (int) $row['Year'];
            $grouped[$year][] = $row;
        }
        return $grouped;
    }

    public function allForAdmin(): array
    {
        $sql = "SELECT p.ProgrammeID, p.ProgrammeName, p.IsPublished, l.LevelName, s.Name AS ProgrammeLeader
                FROM Programmes p
                JOIN Levels l ON l.LevelID = p.LevelID
                LEFT JOIN Staff s ON s.StaffID = p.ProgrammeLeaderID
                ORDER BY p.ProgrammeName";
        return $this->db->query($sql)->fetchAll();
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO Programmes (ProgrammeName, LevelID, ProgrammeLeaderID, Description, Image, IsPublished)
             VALUES (:name, :level, :leader, :description, :image, :published)"
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE Programmes
             SET ProgrammeName = :name, LevelID = :level, ProgrammeLeaderID = :leader,
                 Description = :description, Image = :image, IsPublished = :published
             WHERE ProgrammeID = :id"
        );
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM Programmes WHERE ProgrammeID = :id");
        $stmt->execute(['id' => $id]);
    }
}
