<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Models\AdminUserModel;
use Models\InterestModel;
use Models\ModuleModel;
use Models\ProgrammeModuleModel;
use Models\ProgrammeModel;
use Models\StaffModel;

final class AdminController extends Controller
{
    private AdminUserModel $users;
    private ProgrammeModel $programmes;
    private ModuleModel $modules;
    private ProgrammeModuleModel $programmeModules;
    private StaffModel $staff;
    private InterestModel $interests;

    public function __construct()
    {
        $this->users = new AdminUserModel();
        $this->programmes = new ProgrammeModel();
        $this->modules = new ModuleModel();
        $this->programmeModules = new ProgrammeModuleModel();
        $this->staff = new StaffModel();
        $this->interests = new InterestModel();
    }

    public function loginForm(): void
    {
        $this->view('admin/login');
    }

    public function login(): void
    {
        verify_csrf();
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $user = $this->users->findByUsername($username);

        if (!$user || !password_verify($password, $user['PasswordHash'])) {
            flash('error', 'Invalid credentials.');
            redirect('/admin/login');
        }

        $_SESSION['user'] = [
            'AdminUserID' => (int) $user['AdminUserID'],
            'Username' => $user['Username'],
            'Role' => $user['Role'],
        ];

        redirect('/admin');
    }

    public function logout(): void
    {
        verify_csrf();
        unset($_SESSION['user']);
        redirect('/admin/login');
    }

    public function dashboard(): void
    {
        $this->requireLogin();
        $this->view('admin/dashboard', [
            'programmes' => $this->programmes->allForAdmin(),
            'modules' => $this->modules->all(),
            'user' => $_SESSION['user'],
        ]);
    }

    public function programmeForm(?int $id = null): void
    {
        $this->requireLogin();
        $this->view('admin/programme_form', [
            'programme' => $id ? $this->programmes->find($id, true) : null,
            'levels' => $this->programmes->levels(),
            'staff' => $this->staff->all(),
            'action' => $id ? '/admin/programmes/' . $id . '/update' : '/admin/programmes/create',
        ]);
    }

    public function saveProgramme(?int $id = null): void
    {
        $this->requireLogin();
        verify_csrf();
        $payload = [
            'name' => trim(strip_tags((string) ($_POST['name'] ?? ''))),
            'level' => (int) ($_POST['level_id'] ?? 0),
            'leader' => (int) ($_POST['leader_id'] ?? 0) > 0 ? (int) $_POST['leader_id'] : null,
            'description' => trim(strip_tags((string) ($_POST['description'] ?? ''))),
            'image' => trim((string) ($_POST['image'] ?? '')),
            'published' => isset($_POST['is_published']) ? 1 : 0,
        ];

        if ($payload['name'] === '' || $payload['level'] < 1) {
            flash('error', 'Programme name and level are required.');
            redirect($id ? '/admin/programmes/' . $id . '/edit' : '/admin/programmes/create');
        }

        if ($id === null) {
            $this->programmes->create($payload);
            flash('success', 'Programme created.');
        } else {
            $this->programmes->update($id, $payload);
            flash('success', 'Programme updated.');
        }
        redirect('/admin');
    }

    public function deleteProgramme(int $id): void
    {
        $this->requireRole('admin');
        verify_csrf();
        $this->programmes->delete($id);
        flash('success', 'Programme deleted.');
        redirect('/admin');
    }

    public function moduleForm(?int $id = null): void
    {
        $this->requireLogin();
        $this->view('admin/module_form', [
            'module' => $id ? $this->modules->find($id) : null,
            'staff' => $this->staff->all(),
            'action' => $id ? '/admin/modules/' . $id . '/update' : '/admin/modules/create',
        ]);
    }

    public function saveModule(?int $id = null): void
    {
        $this->requireLogin();
        verify_csrf();
        $payload = [
            'name' => trim(strip_tags((string) ($_POST['name'] ?? ''))),
            'leader' => (int) ($_POST['leader_id'] ?? 0) > 0 ? (int) $_POST['leader_id'] : null,
            'description' => trim(strip_tags((string) ($_POST['description'] ?? ''))),
            'image' => trim((string) ($_POST['image'] ?? '')),
        ];

        if ($payload['name'] === '') {
            flash('error', 'Module name is required.');
            redirect($id ? '/admin/modules/' . $id . '/edit' : '/admin/modules/create');
        }

        if ($id === null) {
            $this->modules->create($payload);
            flash('success', 'Module created.');
        } else {
            $this->modules->update($id, $payload);
            flash('success', 'Module updated.');
        }
        redirect('/admin');
    }

    public function deleteModule(int $id): void
    {
        $this->requireRole('admin');
        verify_csrf();
        $this->modules->delete($id);
        flash('success', 'Module deleted.');
        redirect('/admin');
    }

    public function mailingList(): void
    {
        $this->requireRole('admin');
        $programmeId = isset($_GET['programme']) ? (int) $_GET['programme'] : 0;
        $list = $programmeId > 0 ? $this->interests->byProgramme($programmeId) : [];

        $this->view('admin/mailing', [
            'programmes' => $this->programmes->allForAdmin(),
            'selectedProgramme' => $programmeId,
            'mailingList' => $list,
        ]);
    }

    public function programmeModules(): void
    {
        $this->requireLogin();
        $this->view('admin/programme_modules', [
            'assignments' => $this->programmeModules->allAssignments(),
            'programmes' => $this->programmes->allForAdmin(),
            'modules' => $this->modules->all(),
        ]);
    }

    public function addProgrammeModule(): void
    {
        $this->requireLogin();
        verify_csrf();

        $programmeId = (int) ($_POST['programme_id'] ?? 0);
        $moduleId = (int) ($_POST['module_id'] ?? 0);
        $year = (int) ($_POST['year'] ?? 0);

        if ($programmeId < 1 || $moduleId < 1 || $year < 1 || $year > 4) {
            flash('error', 'Programme, module, and valid year are required.');
            redirect('/admin/programme-modules');
        }

        if ($this->programmeModules->create($programmeId, $moduleId, $year)) {
            flash('success', 'Module assigned to programme.');
        } else {
            flash('error', 'Could not add assignment (possible duplicate).');
        }
        redirect('/admin/programme-modules');
    }

    public function deleteProgrammeModule(int $id): void
    {
        $this->requireRole('admin');
        verify_csrf();
        $this->programmeModules->delete($id);
        flash('success', 'Assignment removed.');
        redirect('/admin/programme-modules');
    }

    public function exportMailingList(): void
    {
        $this->requireRole('admin');
        $programmeId = isset($_GET['programme']) ? (int) $_GET['programme'] : 0;
        if ($programmeId < 1) {
            redirect('/admin/mailing');
        }

        $rows = $this->interests->byProgramme($programmeId);
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="mailing-list-' . $programmeId . '.csv"');
        $fp = fopen('php://output', 'w');
        fputcsv($fp, ['StudentName', 'Email', 'RegisteredAt'], ',', '"', '\\');
        foreach ($rows as $row) {
            fputcsv($fp, [$row['StudentName'], $row['Email'], $row['RegisteredAt']], ',', '"', '\\');
        }
        fclose($fp);
        exit;
    }
}
