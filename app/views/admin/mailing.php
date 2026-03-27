<section class="admin-panel">
    <h1 class="admin-page-title">Programme mailing lists</h1>
    <form class="filter-form mailing-filter-form" method="get" action="<?= e(url('/admin/mailing')) ?>">
        <label for="programme">Select programme</label>
        <select id="programme" name="programme">
            <option value="">Choose programme</option>
            <?php foreach ($programmes as $programme): ?>
                <option value="<?= (int) $programme['ProgrammeID'] ?>" <?= $selectedProgramme === (int) $programme['ProgrammeID'] ? 'selected' : '' ?>>
                    <?= e($programme['ProgrammeName']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">View mailing list</button>
        <?php if ($selectedProgramme > 0): ?>
            <a class="button-link" href="<?= e(url('/admin/mailing/export') . '?programme=' . (int) $selectedProgramme) ?>">Export CSV</a>
        <?php endif; ?>
    </form>
</section>

<?php if ($selectedProgramme > 0): ?>
    <section class="admin-panel">
        <h2 class="section-title">Interested students</h2>
        <?php if (!$mailingList): ?>
            <p>No students registered for this programme yet.</p>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <caption class="sr-only">Mailing list table</caption>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($mailingList as $row): ?>
                        <tr>
                            <td data-label="Name"><?= e($row['StudentName']) ?></td>
                            <td data-label="Email"><?= e($row['Email']) ?></td>
                            <td data-label="Registered at"><?= e($row['RegisteredAt']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>
