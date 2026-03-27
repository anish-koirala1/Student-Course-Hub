<section class="admin-panel admin-panel--form">
    <h1 class="admin-page-title"><?= $programme ? 'Edit programme' : 'Create programme' ?></h1>
    <form method="post" action="<?= e($action) ?>">
        <?= csrf_input() ?>
        <label for="name">Programme name</label>
        <input id="name" name="name" required maxlength="150" value="<?= e($programme['ProgrammeName'] ?? '') ?>">

        <label for="level_id">Level</label>
        <select id="level_id" name="level_id" required>
            <option value="">Select level</option>
            <?php foreach ($levels as $level): ?>
                <?php $selected = (int) ($programme['LevelID'] ?? 0) === (int) $level['LevelID']; ?>
                <option value="<?= (int) $level['LevelID'] ?>" <?= $selected ? 'selected' : '' ?>>
                    <?= e($level['LevelName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="leader_id">Programme leader</label>
        <select id="leader_id" name="leader_id">
            <option value="0">No leader assigned</option>
            <?php foreach ($staff as $member): ?>
                <?php $selected = (int) ($programme['ProgrammeLeaderID'] ?? 0) === (int) $member['StaffID']; ?>
                <option value="<?= (int) $member['StaffID'] ?>" <?= $selected ? 'selected' : '' ?>>
                    <?= e($member['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"><?= e($programme['Description'] ?? '') ?></textarea>

        <label for="image">Image URL</label>
        <input id="image" name="image" maxlength="255" value="<?= e($programme['Image'] ?? '') ?>">

        <?php $published = isset($programme) ? (int) ($programme['IsPublished'] ?? 0) === 1 : true; ?>
        <label class="checkbox-row">
            <input type="checkbox" name="is_published" value="1" <?= $published ? 'checked' : '' ?>>
            Published on student-facing website
        </label>

        <div class="form-actions">
            <button type="submit"><?= $programme ? 'Update programme' : 'Create programme' ?></button>
            <a href="<?= e(url('/admin')) ?>" class="button-link button-link--ghost">Cancel</a>
        </div>
    </form>
</section>
