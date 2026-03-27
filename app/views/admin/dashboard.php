<section class="admin-panel admin-panel--intro">
    <div class="admin-panel__head">
        <h1>Admin dashboard</h1>
        <p class="admin-meta">Signed in as <strong><?= e($user['Username']) ?></strong> <span class="role-pill"><?= e($user['Role']) ?></span></p>
    </div>
    <form method="post" action="<?= e(url('/admin/logout')) ?>" class="admin-logout-form">
        <?= csrf_input() ?>
        <button type="submit" class="secondary">Logout</button>
    </form>
</section>

<section class="admin-panel admin-panel--disclosure">
    <details class="admin-disclosure">
        <summary class="admin-disclosure__summary">
            <span class="admin-disclosure__marker" aria-hidden="true"></span>
            <h2 class="admin-disclosure__title" id="heading-dashboard-programmes">Programmes</h2>
            <a class="text-link admin-disclosure__action" href="<?= e(url('/admin/programmes/create')) ?>">+ Create programme</a>
        </summary>
        <div class="admin-disclosure__body" role="region" aria-labelledby="heading-dashboard-programmes">
            <div class="table-wrap">
                <table>
                    <caption class="sr-only">Programmes list</caption>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Leader</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($programmes as $programme): ?>
                        <tr>
                            <td data-label="Name"><?= e($programme['ProgrammeName']) ?></td>
                            <td data-label="Level"><?= e($programme['LevelName']) ?></td>
                            <td data-label="Leader"><?= e($programme['ProgrammeLeader'] ?? 'TBA') ?></td>
                            <td data-label="Published"><?= (int) $programme['IsPublished'] === 1 ? 'Yes' : 'No' ?></td>
                            <td data-label="Actions">
                                <a href="<?= e(url('/admin/programmes/' . (int) $programme['ProgrammeID'] . '/edit')) ?>">Edit</a>
                                <form class="inline" method="post" action="<?= e(url('/admin/programmes/' . (int) $programme['ProgrammeID'] . '/delete')) ?>">
                                    <?= csrf_input() ?>
                                    <button type="submit" class="danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </details>
</section>

<section class="admin-panel admin-panel--disclosure">
    <details class="admin-disclosure">
        <summary class="admin-disclosure__summary">
            <span class="admin-disclosure__marker" aria-hidden="true"></span>
            <h2 class="admin-disclosure__title" id="heading-dashboard-modules">Modules</h2>
            <a class="text-link admin-disclosure__action" href="<?= e(url('/admin/modules/create')) ?>">+ Create module</a>
        </summary>
        <div class="admin-disclosure__body" role="region" aria-labelledby="heading-dashboard-modules">
            <div class="table-wrap">
                <table>
                    <caption class="sr-only">Modules list</caption>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Leader</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modules as $module): ?>
                        <tr>
                            <td data-label="Name"><?= e($module['ModuleName']) ?></td>
                            <td data-label="Leader"><?= e($module['ModuleLeader'] ?? 'TBA') ?></td>
                            <td data-label="Actions">
                                <a href="<?= e(url('/admin/modules/' . (int) $module['ModuleID'] . '/edit')) ?>">Edit</a>
                                <form class="inline" method="post" action="<?= e(url('/admin/modules/' . (int) $module['ModuleID'] . '/delete')) ?>">
                                    <?= csrf_input() ?>
                                    <button type="submit" class="danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </details>
</section>

<section class="admin-panel admin-panel--compact">
    <h2>Quick links</h2>
    <ul class="admin-link-list">
        <li><a href="<?= e(url('/admin/mailing')) ?>">Mailing lists — view and export</a></li>
        <li><a href="<?= e(url('/admin/programme-modules')) ?>">Programme module assignments</a></li>
    </ul>
</section>
