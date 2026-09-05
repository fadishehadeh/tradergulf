<div class="a-card">
    <div class="a-card-header">
        <h2><?= e($page['title']) ?></h2>
        <div style="display:flex;gap:.5rem;align-items:center">
            <a href="<?= url($page['slug']) ?>" target="_blank" class="btn-a btn-a-ghost btn-a-sm">View Page</a>
            <a href="<?= url('admin/pages') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
        </div>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" class="a-form">
        <?= csrf_field() ?>

        <div class="section-divider">Page Info</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="title">Page Title</label>
                <input type="text" id="title" name="title"
                       value="<?= e($page['title'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label>Slug (read-only)</label>
                <input type="text" value="<?= e($page['slug'] ?? '') ?>" disabled
                       style="background:#f8fafc;color:#94a3b8">
            </div>
        </div>

        <div class="section-divider">Content (HTML)</div>

        <div class="a-field">
            <label for="content_html">Page Content</label>
            <textarea id="content_html" name="content_html" class="tall"
                      style="min-height:420px;font-family:monospace;font-size:.82rem"
            ><?= e($page['content_html'] ?? '') ?></textarea>
            <div class="hint">HTML is allowed - use &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;strong&gt;, etc.</div>
        </div>

        <div class="section-divider">SEO</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title"
                       value="<?= e($page['meta_title'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="meta_description">Meta Description</label>
                <input type="text" id="meta_description" name="meta_description"
                       value="<?= e($page['meta_description'] ?? '') ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">Save Changes</button>
            <a href="<?= url('admin/pages') ?>" class="btn-a btn-a-ghost">Cancel</a>
        </div>
    </form>
    </div>
</div>
