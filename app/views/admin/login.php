<section class="auth-card">
    <p class="eyebrow">Staff access</p>
    <h1>Admin login</h1>
    <p class="auth-card__hint">Use your assigned username and password.</p>
    <form method="post" action="<?= e(url('/admin/login')) ?>">
        <?= csrf_input() ?>
        <label for="username">Username</label>
        <input id="username" name="username" required autocomplete="username">

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        <button type="submit">Login</button>
    </form>
</section>
