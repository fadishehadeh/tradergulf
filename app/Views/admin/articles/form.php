<div class="a-card">
    <div class="a-card-header">
        <h2><?= isset($article['id']) ? 'Edit Article' : 'New Article' ?></h2>
        <a href="<?= url('admin/articles') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" class="a-form">
        <?= csrf_field() ?>

        <div class="section-divider">Article Info</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="title">Title <span class="req">*</span></label>
                <input type="text" id="title" name="title" required
                       value="<?= e($article['title'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="slug">URL Slug</label>
                <input type="text" id="slug" name="slug"
                       value="<?= e($article['slug'] ?? '') ?>"
                       placeholder="auto-generated from title">
            </div>
        </div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="category">Type <span class="req">*</span></label>
                <select id="category" name="category" required>
                    <option value="guide" <?= ($article['category'] ?? '') === 'guide' ? 'selected' : '' ?>>Trading Guide</option>
                    <option value="news"  <?= ($article['category'] ?? '') === 'news'  ? 'selected' : '' ?>>Market News</option>
                </select>
            </div>
            <div class="a-field">
                <label for="published_at">Publish Date</label>
                <input type="datetime-local" id="published_at" name="published_at"
                       value="<?= e(isset($article['published_at']) ? date('Y-m-d\TH:i', strtotime($article['published_at'])) : '') ?>">
            </div>
        </div>

        <div class="a-field">
            <label for="excerpt">Excerpt</label>
            <textarea id="excerpt" name="excerpt"><?= e($article['excerpt'] ?? '') ?></textarea>
            <div class="hint">Short summary shown in listings (plain text, ~160 chars)</div>
        </div>

        <div class="section-divider">Content (HTML)</div>

        <div class="a-field">
            <label for="content_html">Body Content</label>
            <textarea id="content_html" name="content_html" class="tall"
                      style="min-height:380px;font-family:monospace;font-size:.82rem"
            ><?= e($article['content_html'] ?? '') ?></textarea>
            <div class="hint">HTML is allowed — use &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, etc.</div>
        </div>

        <div class="section-divider">SEO</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title"
                       value="<?= e($article['meta_title'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="meta_description">Meta Description</label>
                <input type="text" id="meta_description" name="meta_description"
                       value="<?= e($article['meta_description'] ?? '') ?>">
            </div>
        </div>

        <div class="section-divider">Publishing</div>

        <label class="a-checkbox">
            <input type="checkbox" name="is_published" value="1"
                   <?= !empty($article['is_published']) ? 'checked' : '' ?>>
            Published (visible on site)
        </label>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">
                <?= isset($article['id']) ? 'Save Changes' : 'Create Article' ?>
            </button>
            <a href="<?= url('admin/articles') ?>" class="btn-a btn-a-ghost">Cancel</a>
        </div>
    </form>
    </div>
</div>

<script>
document.getElementById('title').addEventListener('blur', function() {
    const slugField = document.getElementById('slug');
    if (slugField.value !== '') return;
    slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
});
</script>
