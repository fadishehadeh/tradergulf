<div class="a-card" style="max-width:640px">
    <div class="a-card-header">
        <h2><?= isset($term['id']) ? 'Edit Term' : 'Add New Term' ?></h2>
        <a href="<?= url('admin/glossary') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" class="a-form">
        <?= csrf_field() ?>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="termName">Term <span class="req">*</span></label>
                <input type="text" id="termName" name="term" required
                       value="<?= e($term['term'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug"
                       value="<?= e($term['slug'] ?? '') ?>"
                       placeholder="auto-generated">
            </div>
        </div>

        <div class="a-field">
            <label for="definition_html">Definition <span class="req">*</span></label>
            <textarea id="definition_html" name="definition_html" class="tall" required
            ><?= e($term['definition_html'] ?? '') ?></textarea>
            <div class="hint">Plain text or HTML accepted.</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">
                <?= isset($term['id']) ? 'Save Changes' : 'Add Term' ?>
            </button>
            <a href="<?= url('admin/glossary') ?>" class="btn-a btn-a-ghost">Cancel</a>
        </div>
    </form>
    </div>
</div>

<script>
document.getElementById('termName').addEventListener('blur', function() {
    const slugField = document.getElementById('slug');
    if (slugField.value !== '') return;
    slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
});
</script>
