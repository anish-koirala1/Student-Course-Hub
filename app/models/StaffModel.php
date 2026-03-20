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
        return $this->db->query("SELECT StaffID, Name FROM Staff ORDER BY Name")->fetchAll();
    }
}
