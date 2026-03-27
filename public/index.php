<?php

declare(strict_types=1);

use Controllers\AdminController;
use Controllers\StaffController;
use Controllers\StudentController;

require_once __DIR__ . '/../app/bootstrap.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$base = request_base_path();
if ($base !== '' && str_starts_with($path, $base)) {
    $path = substr($path, strlen($base)) ?: '/';
}
if ($path === '' || ($path[0] ?? '') !== '/') {
    $path = '/' . ltrim($path, '/');
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$student = new StudentController();
$admin = new AdminController();
$staff = new StaffController();

if ($path === '/' && $method === 'GET') {
    $student->landing();
    return;
}

if ($path === '/programmes' && $method === 'GET') {
    $student->index();
    return;
}

if (preg_match('#^/programme/(\d+)$#', $path, $matches) && $method === 'GET') {
    $student->show((int) $matches[1]);
    return;
}

if ($path === '/interest/register' && $method === 'POST') {
    $student->registerInterest();
    return;
}

if ($path === '/interest/withdraw' && $method === 'POST') {
    $student->withdrawInterest();
    return;
}

if ($path === '/staff/login' && $method === 'GET') {
    $staff->loginForm();
    return;
}

if ($path === '/staff/login' && $method === 'POST') {
    $staff->login();
    return;
}

if ($path === '/staff/logout' && $method === 'POST') {
    $staff->logout();
    return;
}

if (($path === '/staff' || $path === '/staff/dashboard') && $method === 'GET') {
    $staff->dashboard();
    return;
}

if ($path === '/admin/login' && $method === 'GET') {
    $admin->loginForm();
    return;
}

if ($path === '/admin/login' && $method === 'POST') {
    $admin->login();
    return;
}

if ($path === '/admin/logout' && $method === 'POST') {
    $admin->logout();
    return;
}

if ($path === '/admin' && $method === 'GET') {
    $admin->dashboard();
    return;
}

if ($path === '/admin/dashboard' && $method === 'GET') {
    $admin->dashboard();
    return;
}

if ($path === '/admin/programmes/create' && $method === 'GET') {
    $admin->programmeForm();
    return;
}

if ($path === '/admin/programmes/create' && $method === 'POST') {
    $admin->saveProgramme();
    return;
}

if (preg_match('#^/admin/programmes/(\d+)/edit$#', $path, $matches) && $method === 'GET') {
    $admin->programmeForm((int) $matches[1]);
    return;
}

if (preg_match('#^/admin/programmes/(\d+)/update$#', $path, $matches) && $method === 'POST') {
    $admin->saveProgramme((int) $matches[1]);
    return;
}

if (preg_match('#^/admin/programmes/(\d+)/delete$#', $path, $matches) && $method === 'POST') {
    $admin->deleteProgramme((int) $matches[1]);
    return;
}

if ($path === '/admin/modules/create' && $method === 'GET') {
    $admin->moduleForm();
    return;
}

if ($path === '/admin/modules/create' && $method === 'POST') {
    $admin->saveModule();
    return;
}

if (preg_match('#^/admin/modules/(\d+)/edit$#', $path, $matches) && $method === 'GET') {
    $admin->moduleForm((int) $matches[1]);
    return;
}

if (preg_match('#^/admin/modules/(\d+)/update$#', $path, $matches) && $method === 'POST') {
    $admin->saveModule((int) $matches[1]);
    return;
}

if (preg_match('#^/admin/modules/(\d+)/delete$#', $path, $matches) && $method === 'POST') {
    $admin->deleteModule((int) $matches[1]);
    return;
}

if ($path === '/admin/mailing' && $method === 'GET') {
    $admin->mailingList();
    return;
}

if ($path === '/admin/mailing/export' && $method === 'GET') {
    $admin->exportMailingList();
    return;
}

if ($path === '/admin/programme-modules' && $method === 'GET') {
    $admin->programmeModules();
    return;
}

if ($path === '/admin/programme-modules/create' && $method === 'POST') {
    $admin->addProgrammeModule();
    return;
}

if (preg_match('#^/admin/programme-modules/(\d+)/delete$#', $path, $matches) && $method === 'POST') {
    $admin->deleteProgrammeModule((int) $matches[1]);
    return;
}

http_response_code(404);
echo 'Not Found';
