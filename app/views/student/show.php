<article>
    <h2><?= e($programme['ProgrammeName']) ?></h2>
    <p><strong>Level:</strong> <?= e($programme['LevelName']) ?></p>
    <p><strong>Programme leader:</strong> <?= e($programme['ProgrammeLeader'] ?? 'TBA') ?></p>
    <?php if (!empty($programme['Image'])): ?>
        <img src="<?= e($programme['Image']) ?>" alt="<?= e($programme['ProgrammeName']) ?> image" class="programme-image">
    <?php endif; ?>
    <p><?= e($programme['Description'] ?? '') ?></p>
</article>

<section>
    <h3>Modules by year</h3>
    <?php if (!$modulesByYear): ?>
        <p>No modules are assigned yet.</p>
    <?php endif; ?>

    <?php foreach ($modulesByYear as $year => $modules): ?>
        <h4>Year <?= (int) $year ?></h4>
        <ul class="module-list">
            <?php foreach ($modules as $module): ?>
                <li>
                    <h5><?= e($module['ModuleName']) ?></h5>
                    <p><strong>Module leader:</strong> <?= e($module['ModuleLeader'] ?? 'TBA') ?></p>
                    <p><?= e($module['Description'] ?? '') ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</section>

<section class="interest-grid">
    <div>
        <h3>Register your interest</h3>
        <form method="post" action="/interest/register">
            <?= csrf_input() ?>
            <input type="hidden" name="programme_id" value="<?= (int) $programme['ProgrammeID'] ?>">
            <label for="student_name">Your full name</label>
            <input id="student_name" name="student_name" required maxlength="100">

            <label for="email">Email address</label>
            <input id="email" type="email" name="email" required maxlength="255">
            <button type="submit">Register interest</button>
        </form>
    </div>

    <div>
        <h3>Withdraw interest</h3>
        <form method="post" action="/interest/withdraw">
            <?= csrf_input() ?>
            <input type="hidden" name="programme_id" value="<?= (int) $programme['ProgrammeID'] ?>">
            <label for="withdraw_email">Email address</label>
            <input id="withdraw_email" type="email" name="email" required maxlength="255">
            <button type="submit" class="secondary">Withdraw</button>
        </form>
    </div>
</section>
