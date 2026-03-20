<section>
    <h2>Explore degree programmes</h2>
    <form class="filter-form" method="get" action="/programmes">
        <label for="q">Search by keyword</label>
        <input id="q" name="q" value="<?= e($query) ?>" placeholder="e.g. Cyber Security">

        <label for="level">Level</label>
        <select id="level" name="level">
            <option value="">All levels</option>
            <?php foreach ($levels as $level): ?>
                <option value="<?= (int) $level['LevelID'] ?>" <?= $selectedLevel === (int) $level['LevelID'] ? 'selected' : '' ?>>
                    <?= e($level['LevelName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Apply</button>
    </form>

    <?php if (!$programmes): ?>
        <p>No programmes found.</p>
    <?php endif; ?>

    <ul class="cards" aria-label="Programmes">
        <?php foreach ($programmes as $programme): ?>
            <li class="card">
                <h3>
                    <a href="/programme/<?= (int) $programme['ProgrammeID'] ?>">
                        <?= e($programme['ProgrammeName']) ?>
                    </a>
                </h3>
                <p><strong>Level:</strong> <?= e($programme['LevelName']) ?></p>
                <p><strong>Programme leader:</strong> <?= e($programme['ProgrammeLeader'] ?? 'TBA') ?></p>
                <p><?= e($programme['Description'] ?? '') ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
