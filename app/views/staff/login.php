<section class="auth-card">
    <p class="eyebrow">Teaching staff</p>
    <h1>Staff portal</h1>
    <p class="auth-card__hint">Sign in to see the modules you lead and where they appear on programmes.</p>
    <form method="post" action="<?= e(url('/staff/login')) ?>">
        <?= csrf_input() ?>
        <label for="staff_username">Username</label>
        <input id="staff_username" name="username" required autocomplete="username">

        <label for="staff_password">Password</label>
        <input id="staff_password" type="password" name="password" required autocomplete="current-password">
        <button type="submit">Sign in</button>
    </form>
</section>
