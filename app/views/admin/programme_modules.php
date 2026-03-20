<section>
    <h2>Programme module assignments</h2>
    <form method="post" action="/admin/programme-modules/create">
        <?= csrf_input() ?>
        <label for="programme_id">Programme</label>
        <select id="programme_id" name="programme_id" required>
            <option value="">Select programme</option>
            <?php foreach ($programmes as $programme): ?>
                <option value="<?= (int) $programme['ProgrammeID'] ?>"><?= e($programme['ProgrammeName']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="module_id">Module</label>
        <select id="module_id" name="module_id" required>
            <option value="">Select module</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?= (int) $module['ModuleID'] ?>"><?= e($module['ModuleName']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="year">Year</label>
        <select id="year" name="year" required>
            <option value="">Select year</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <button type="submit">Add assignment</button>
    </form>
</section>

<section>
    <h3>Current assignments</h3>
    <div class="table-wrap">
        <table>
            <caption class="sr-only">Programme module assignments</caption>
            <thead>
            <tr>
                <th>Programme</th>
                <th>Module</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td data-label="Programme"><?= e($assignment['ProgrammeName']) ?></td>
                    <td data-label="Module"><?= e($assignment['ModuleName']) ?></td>
                    <td data-label="Year"><?= (int) $assignment['Year'] ?></td>
                    <td data-label="Action">
                        <form class="inline" method="post" action="/admin/programme-modules/<?= (int) $assignment['ProgrammeModuleID'] ?>/delete">
                            <?= csrf_input() ?>
                            <button type="submit" class="danger">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
