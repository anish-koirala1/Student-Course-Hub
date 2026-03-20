<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use PDO;

final class ModuleModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function all(): array
    {
        $sql = "SELECT m.ModuleID, m.ModuleName, m.Description, s.Name AS ModuleLeader
                FROM Modules m
                LEFT JOIN Staff s ON s.StaffID = m.ModuleLeaderID
                ORDER BY m.ModuleName";
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM Modules WHERE ModuleID = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO Modules (ModuleName, ModuleLeaderID, Description, Image)
             VALUES (:name, :leader, :description, :image)"
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE Modules SET ModuleName = :name, ModuleLeaderID = :leader, Description = :description, Image = :image
             WHERE ModuleID = :id"
        );
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM Modules WHERE ModuleID = :id");
        $stmt->execute(['id' => $id]);
    }
}
