<?php

declare(strict_types=1);

$reqPath = current_request_path();
$isAdmin = str_starts_with($reqPath, '/admin');
$bodyClass = 'site' . ($isAdmin ? ' site--admin' : '') . ($reqPath === '/' ? ' site--home' : '');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e((string) app_config('app.name')) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400&family=Figtree:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(url('/assets/styles.css')) ?>">
</head>
<body class="<?= e($bodyClass) ?>">
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
    <div class="container site-header__inner">
        <a class="site-brand" href="<?= e(url('/')) ?>">
            <span class="site-brand__mark" aria-hidden="true"></span>
            <span class="site-brand__text"><?= e((string) app_config('app.name')) ?></span>
        </a>
        <nav class="site-nav" aria-label="Primary">
            <a class="site-nav__link<?= $reqPath === '/' ? ' is-active' : '' ?>" href="<?= e(url('/')) ?>">Home</a>
            <a class="site-nav__link<?= str_starts_with($reqPath, '/programme') ? ' is-active' : '' ?>" href="<?= e(url('/programmes')) ?>">Programmes</a>
            <a class="site-nav__link<?= $isAdmin ? ' is-active' : '' ?>" href="<?= e(url('/admin/dashboard')) ?>">Admin</a>
        </nav>
    </div>
</header>
<main id="main" class="container main-content">
    <?php if ($message = flash('success')): ?>
        <p class="alert success" role="status"><?= e($message) ?></p>
    <?php endif; ?>
    <?php if ($message = flash('error')): ?>
        <p class="alert error" role="alert"><?= e($message) ?></p>
    <?php endif; ?>
    <?php include $templatePath; ?>
</main>
<footer class="site-footer">
    <div class="container site-footer__inner">
        <p><?= e((string) app_config('app.name')) ?> — CTEC2712 coursework demo</p>
    </div>
</footer>
</body>
</html>
