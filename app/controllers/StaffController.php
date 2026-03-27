<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Models\StaffModel;

final class StaffController extends Controller
{
    private StaffModel $staff;

    public function __construct()
    {
        $this->staff = new StaffModel();
    }

    public function loginForm(): void
    {
        if (!empty($_SESSION['staff'])) {
            redirect('/staff');
        }
        $this->view('staff/login');
    }

    public function login(): void
    {
        verify_csrf();
        $username = strtolower(trim((string) ($_POST['username'] ?? '')));
        $password = (string) ($_POST['password'] ?? '');

        $row = $username !== '' ? $this->staff->findByUsername($username) : null;

        if (!$row || empty($row['PasswordHash']) || !password_verify($password, (string) $row['PasswordHash'])) {
            flash('error', 'Invalid username or password.');
            redirect('/staff/login');
        }

        $_SESSION['staff'] = [
            'StaffID' => (int) $row['StaffID'],
            'Name' => (string) $row['Name'],
            'Username' => (string) $row['Username'],
        ];

        redirect('/staff');
    }

    public function logout(): void
    {
        verify_csrf();
        unset($_SESSION['staff']);
        flash('success', 'You have been signed out.');
        redirect('/staff/login');
    }

    public function dashboard(): void
    {
        $this->requireStaffLogin();
        $id = (int) $_SESSION['staff']['StaffID'];

        $this->view('staff/dashboard', [
            'staffMember' => $_SESSION['staff'],
            'modulesLed' => $this->staff->modulesLed($id),
            'programmesAsLeader' => $this->staff->programmesAsLeader($id),
            'programmeImpact' => $this->staff->programmeImpactByStaff($id),
        ]);
    }
}
