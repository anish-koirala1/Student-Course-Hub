<section class="admin-panel admin-panel--form">
    <h1 class="admin-page-title"><?= $module ? 'Edit module' : 'Create module' ?></h1>
    <form method="post" action="<?= e($action) ?>">
        <?= csrf_input() ?>
        <label for="name">Module name</label>
        <input id="name" name="name" required maxlength="150" value="<?= e($module['ModuleName'] ?? '') ?>">

        <label for="leader_id">Module leader</label>
        <select id="leader_id" name="leader_id">
            <option value="0">No leader assigned</option>
            <?php foreach ($staff as $member): ?>
                <?php $selected = (int) ($module['ModuleLeaderID'] ?? 0) === (int) $member['StaffID']; ?>
                <option value="<?= (int) $member['StaffID'] ?>" <?= $selected ? 'selected' : '' ?>>
                    <?= e($member['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"><?= e($module['Description'] ?? '') ?></textarea>

        <label for="image">Image URL</label>
        <input id="image" name="image" maxlength="255" value="<?= e($module['Image'] ?? '') ?>">

        <div class="form-actions">
            <button type="submit"><?= $module ? 'Update module' : 'Create module' ?></button>
            <a href="<?= e(url('/admin')) ?>" class="button-link button-link--ghost">Cancel</a>
        </div>
    </form>
</section>
