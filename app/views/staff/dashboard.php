<section class="admin-panel admin-panel--intro staff-dashboard__intro">
    <div class="admin-panel__head">
        <h1>Staff dashboard</h1>
        <p class="admin-meta">Signed in as <strong><?= e($staffMember['Name']) ?></strong></p>
    </div>
    <form method="post" action="<?= e(url('/staff/logout')) ?>" class="admin-logout-form">
        <?= csrf_input() ?>
        <button type="submit" class="secondary">Sign out</button>
    </form>
</section>

<section class="admin-panel staff-dashboard__section" aria-labelledby="modules-led-heading">
    <h2 id="modules-led-heading" class="section-title">Modules I lead</h2>
    <?php if (!$modulesLed): ?>
        <p class="muted">You are not recorded as the module leader for any modules yet.</p>
    <?php else: ?>
        <ul class="staff-module-list">
            <?php foreach ($modulesLed as $mod): ?>
                <li class="staff-module-list__item">
                    <h3 class="staff-module-list__title"><?= e($mod['ModuleName']) ?></h3>
                    <?php if (!empty($mod['Description'])): ?>
                        <p><?= e($mod['Description']) ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<section class="admin-panel staff-dashboard__section" aria-labelledby="programmes-led-heading">
    <h2 id="programmes-led-heading" class="section-title">Programmes I lead</h2>
    <p class="muted staff-dashboard__hint">Programmes where you are the <strong>programme leader</strong> (overall course lead).</p>
    <?php if (!$programmesAsLeader): ?>
        <p class="muted">You are not listed as programme leader for any programmes.</p>
    <?php else: ?>
        <ul class="staff-programme-led-list">
            <?php foreach ($programmesAsLeader as $prog): ?>
                <li>
                    <strong><?= e($prog['ProgrammeName']) ?></strong>
                    <span class="muted"> — <?= e($prog['LevelName']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<section class="admin-panel staff-dashboard__section" aria-labelledby="impact-heading">
    <h2 id="impact-heading" class="section-title">My modules across programmes</h2>
    <p class="muted staff-dashboard__hint">Where modules you lead are offered, including year of study.</p>
    <?php if (!$programmeImpact): ?>
        <p class="muted">None of your modules are assigned to a programme yet, or you do not lead any modules.</p>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <caption class="sr-only">Programmes and years for modules you lead</caption>
                <thead>
                <tr>
                    <th>Programme</th>
                    <th>Level</th>
                    <th>Year</th>
                    <th>Module</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($programmeImpact as $row): ?>
                    <tr>
                        <td data-label="Programme"><?= e($row['ProgrammeName']) ?></td>
                        <td data-label="Level"><?= e($row['LevelName']) ?></td>
                        <td data-label="Year"><?= (int) $row['Year'] ?></td>
                        <td data-label="Module"><?= e($row['ModuleName']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
