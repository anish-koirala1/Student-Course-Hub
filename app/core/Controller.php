<?php

declare(strict_types=1);

namespace Core;

class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $templatePath = __DIR__ . '/../views/' . $template . '.php';
        if (!file_exists($templatePath)) {
            http_response_code(500);
            echo 'View not found.';
            return;
        }
        include __DIR__ . '/../views/layout.php';
    }

    protected function requireLogin(): void
    {
        if (empty($_SESSION['user'])) {
            flash('error', 'Please login first.');
            redirect('/admin/login');
        }
    }

    protected function requireRole(string $role): void
    {
        $this->requireLogin();
        if (($_SESSION['user']['Role'] ?? '') !== $role) {
            http_response_code(403);
            echo 'Forbidden';
            exit;
        }
    }
}
