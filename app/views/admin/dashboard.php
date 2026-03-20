<section>
    <h2>Admin dashboard</h2>
    <p>Signed in as <strong><?= e($user['Username']) ?></strong> (<?= e($user['Role']) ?>).</p>

    <form method="post" action="/admin/logout">
        <?= csrf_input() ?>
        <button type="submit" class="secondary">Logout</button>
    </form>
</section>

<section>
    <h3>Programmes</h3>
    <p><a href="/admin/programmes/create">Create programme</a></p>
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
                        <a href="/admin/programmes/<?= (int) $programme['ProgrammeID'] ?>/edit">Edit</a>
                        <form class="inline" method="post" action="/admin/programmes/<?= (int) $programme['ProgrammeID'] ?>/delete">
                            <?= csrf_input() ?>
                            <button type="submit" class="danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section>
    <h3>Modules</h3>
    <p><a href="/admin/modules/create">Create module</a></p>
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
                        <a href="/admin/modules/<?= (int) $module['ModuleID'] ?>/edit">Edit</a>
                        <form class="inline" method="post" action="/admin/modules/<?= (int) $module['ModuleID'] ?>/delete">
                            <?= csrf_input() ?>
                            <button type="submit" class="danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section>
    <h3>Mailing list</h3>
    <p><a href="/admin/mailing">View and export mailing lists</a></p>
</section>

<section>
    <h3>Programme module assignments</h3>
    <p><a href="/admin/programme-modules">Manage modules per programme and year</a></p>
</section>
