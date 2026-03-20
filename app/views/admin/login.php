<section class="auth-card">
    <h2>Admin login</h2>
    <form method="post" action="/admin/login">
        <?= csrf_input() ?>
        <label for="username">Username</label>
        <input id="username" name="username" required autocomplete="username">

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        <button type="submit">Login</button>
    </form>
</section>
