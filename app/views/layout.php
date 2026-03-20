<?php

declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e((string) app_config('app.name')) ?></title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
    <div class="container">
        <h1><a href="/"><?= e((string) app_config('app.name')) ?></a></h1>
        <nav aria-label="Primary">
            <a href="/">Programmes</a>
            <a href="/admin/dashboard">Admin</a>
        </nav>
    </div>
</header>
<main id="main" class="container">
    <?php if ($message = flash('success')): ?>
        <p class="alert success" role="status"><?= e($message) ?></p>
    <?php endif; ?>
    <?php if ($message = flash('error')): ?>
        <p class="alert error" role="alert"><?= e($message) ?></p>
    <?php endif; ?>
    <?php include $templatePath; ?>
</main>
</body>
</html>
