<?php

declare(strict_types=1);

namespace Models;

use Core\Database;
use PDO;

final class ProgrammeModuleModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function allAssignments(): array
    {
        $sql = "SELECT pm.ProgrammeModuleID, pm.Year, p.ProgrammeName, m.ModuleName
                FROM ProgrammeModules pm
                JOIN Programmes p ON p.ProgrammeID = pm.ProgrammeID
                JOIN Modules m ON m.ModuleID = pm.ModuleID
                ORDER BY p.ProgrammeName, pm.Year, m.ModuleName";
        return $this->db->query($sql)->fetchAll();
    }

    public function create(int $programmeId, int $moduleId, int $year): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO ProgrammeModules (ProgrammeID, ModuleID, Year)
             VALUES (:programme, :module, :year)"
        );
        return $stmt->execute([
            'programme' => $programmeId,
            'module' => $moduleId,
            'year' => $year,
        ]);
    }

    public function delete(int $programmeModuleId): void
    {
        $stmt = $this->db->prepare("DELETE FROM ProgrammeModules WHERE ProgrammeModuleID = :id");
        $stmt->execute(['id' => $programmeModuleId]);
    }
}
