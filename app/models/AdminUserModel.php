<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use PDO;

final class AdminUserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM AdminUsers WHERE Username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
