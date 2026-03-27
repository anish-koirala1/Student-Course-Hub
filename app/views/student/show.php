<article class="programme-detail programme-detail--hero">
    <header class="programme-detail__header">
        <h1><?= e($programme['ProgrammeName']) ?></h1>
        <ul class="meta-chips" aria-label="Programme summary">
            <li><span class="meta-chips__label">Level</span> <?= e($programme['LevelName']) ?></li>
            <li><span class="meta-chips__label">Leader</span> <?= e($programme['ProgrammeLeader'] ?? 'TBA') ?></li>
        </ul>
    </header>
    <?php if (!empty($programme['Image'])): ?>
        <img src="<?= e($programme['Image']) ?>" alt="<?= e($programme['ProgrammeName']) ?> image" class="programme-image">
    <?php endif; ?>
    <p><?= e($programme['Description'] ?? '') ?></p>
</article>

<section class="page-block">
    <h2 class="section-title">Modules by year</h2>
    <?php if (!$modulesByYear): ?>
        <p>No modules are assigned yet.</p>
    <?php endif; ?>

    <?php foreach ($modulesByYear as $year => $modules): ?>
        <h3 class="year-heading">Year <?= (int) $year ?></h3>
        <ul class="module-list">
            <?php foreach ($modules as $module): ?>
                <li class="module-list__item">
                    <h4 class="module-list__title"><?= e($module['ModuleName']) ?></h4>
                    <p><strong>Module leader:</strong> <?= e($module['ModuleLeader'] ?? 'TBA') ?></p>
                    <p><?= e($module['Description'] ?? '') ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</section>

<section class="interest-grid page-block">
    <div class="interest-panel">
        <h2 class="section-title">Register your interest</h2>
        <form method="post" action="<?= e(url('/interest/register')) ?>">
            <?= csrf_input() ?>
            <input type="hidden" name="programme_id" value="<?= (int) $programme['ProgrammeID'] ?>">
            <label for="student_name">Your full name</label>
            <input id="student_name" name="student_name" required maxlength="100">

            <label for="email">Email address</label>
            <input id="email" type="email" name="email" required maxlength="255">
            <button type="submit">Register interest</button>
        </form>
    </div>

    <div class="interest-panel interest-panel--muted">
        <h2 class="section-title">Withdraw interest</h2>
        <form method="post" action="<?= e(url('/interest/withdraw')) ?>">
            <?= csrf_input() ?>
            <input type="hidden" name="programme_id" value="<?= (int) $programme['ProgrammeID'] ?>">
            <label for="withdraw_email">Email address</label>
            <input id="withdraw_email" type="email" name="email" required maxlength="255">
            <button type="submit" class="secondary">Withdraw</button>
        </form>
    </div>
</section>
