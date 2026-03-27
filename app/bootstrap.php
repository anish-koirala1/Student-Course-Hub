<?php

declare(strict_types=1);

session_start();

$config = require __DIR__ . '/config/config.php';

spl_autoload_register(static function (string $class): void {
    $prefixes = [
        'Core\\' => __DIR__ . '/core/',
        'Controllers\\' => __DIR__ . '/controllers/',
        'Models\\' => __DIR__ . '/models/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (str_starts_with($class, $prefix)) {
            $relative = substr($class, strlen($prefix));
            $path = $baseDir . str_replace('\\', '/', $relative) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
            return;
        }
    }
});

function app_config(string $key)
{
    global $config;
    $parts = explode('.', $key);
    $value = $config;
    foreach ($parts as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return null;
        }
        $value = $value[$part];
    }
    return $value;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function old(string $key, string $default = ''): string
{
    return $_POST[$key] ?? $default;
}

function flash(string $key, ?string $value = null): ?string
{
    if ($value !== null) {
        $_SESSION['_flash'][$key] = $value;
        return null;
    }

    if (!isset($_SESSION['_flash'][$key])) {
        return null;
    }

    $message = $_SESSION['_flash'][$key];
    unset($_SESSION['_flash'][$key]);
    return $message;
}

/**
 * Base URL path of the app (e.g. "" or "/webassignment/public") for XAMPP subfolder installs.
 */
function request_base_path(): string
{
    static $cached = null;
    if ($cached !== null) {
        return $cached;
    }
    $script = (string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $dir = str_replace('\\', '/', dirname($script));
    $cached = ($dir === '/' || $dir === '.') ? '' : rtrim($dir, '/');

    return $cached;
}

/**
 * Normalised path for routing (no subdirectory prefix), e.g. "/programmes".
 */
function current_request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $base = request_base_path();
    if ($base !== '' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base)) ?: '/';
    }
    if ($path === '' || ($path[0] ?? '') !== '/') {
        $path = '/' . ltrim($path, '/');
    }

    return $path;
}

/**
 * Build an absolute path from site root including subdirectory prefix.
 */
function url(string $path = '/'): string
{
    $base = request_base_path();
    if ($path === '' || $path === '/') {
        return $base === '' ? '/' : $base . '/';
    }
    $path = $path[0] === '/' ? $path : '/' . $path;

    return $base . $path;
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function csrf_input(): string
{
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void
{
    $expected = (string) ($_SESSION['_csrf_token'] ?? '');
    $token = (string) ($_POST['_token'] ?? '');
    if ($expected === '' || $token === '' || !hash_equals($expected, $token)) {
        http_response_code(419);
        echo 'Invalid CSRF token';
        exit;
    }
}
