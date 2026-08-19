<?php
$selectedBrokers = json_decode($page['broker_ids'] ?? '[]', true) ?: [];
?>

<div class="a-card">
    <div class="a-card-header">
        <h2><?= $isNew ? 'New SEO Page' : ('Edit: ' . e($page['h1'])) ?></h2>
        <div style="display:flex;gap:.5rem;align-items:center">
            <?php if (!$isNew && $page['is_published']): ?>
            <a href="<?= url('best/' . $page['slug']) ?>" target="_blank" class="btn-a btn-a-ghost btn-a-sm">View Live</a>
            <?php endif; ?>
            <a href="<?= url('admin/seo') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
        </div>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" class="a-form">
        <?= csrf_field() ?>

        <div class="section-divider">Page Settings</div>

        <div class="a-form-row a-form-row-3">
            <div class="a-field">
                <label for="page_type">Page Type <span class="req">*</span></label>
                <select id="page_type" name="page_type">
                    <option value="geo"        <?= ($page['page_type'] ?? 'geo') === 'geo'        ? 'selected' : '' ?>>GEO (country/region)</option>
                    <option value="category"   <?= ($page['page_type'] ?? '') === 'category'      ? 'selected' : '' ?>>Category (ECN, MT4, etc.)</option>
                    <option value="comparison" <?= ($page['page_type'] ?? '') === 'comparison'    ? 'selected' : '' ?>>Comparison</option>
                </select>
            </div>
            <div class="a-field">
                <label for="slug">URL Slug <span class="req">*</span><?= !$isNew ? ' <span style="color:var(--muted)">(read-only)</span>' : '' ?></label>
                <input type="text" id="slug" name="slug"
                       value="<?= e($page['slug'] ?? '') ?>"
                       placeholder="forex-brokers-uae"
                       <?= !$isNew ? 'disabled' : '' ?>>
                <?php if (!$isNew): ?>
                <input type="hidden" name="slug" value="<?= e($page['slug'] ?? '') ?>">
                <?php endif; ?>
                <div class="hint">Public URL: /best/<strong><?= e($page['slug'] ?? 'your-slug') ?></strong></div>
            </div>
            <div class="a-field" style="display:flex;align-items:center;gap:.75rem;padding-top:1.6rem">
                <label class="a-checkbox">
                    <input type="checkbox" name="is_published" value="1"
                           <?= !empty($page['is_published']) ? 'checked' : '' ?>>
                    <span>Published (visible on site)</span>
                </label>
            </div>
        </div>

        <div class="section-divider">Headlines & Content</div>

        <div class="a-field">
            <label for="h1">H1 Heading <span class="req">*</span></label>
            <input type="text" id="h1" name="h1"
                   value="<?= e($page['h1'] ?? '') ?>"
                   placeholder="Best Forex Brokers in UAE 2025">
        </div>

        <div class="a-field">
            <label for="intro_html">Introduction (HTML, shown above broker table)</label>
            <textarea id="intro_html" name="intro_html" style="min-height:100px;font-family:monospace;font-size:.82rem"><?= e($page['intro_html'] ?? '') ?></textarea>
            <div class="hint">Brief intro paragraph(s) displayed above the broker comparison table.</div>
        </div>

        <div class="a-field">
            <label for="body_html">Body Content (HTML, shown below broker table)</label>
            <textarea id="body_html" name="body_html" class="tall" style="min-height:320px;font-family:monospace;font-size:.82rem"><?= e($page['body_html'] ?? '') ?></textarea>
            <div class="hint">Use &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;strong&gt;, etc. This is the main SEO content block.</div>
        </div>

        <div class="section-divider">Featured Brokers</div>
        <p style="font-size:.82rem;color:var(--muted);margin-bottom:.75rem">Select brokers to display in the comparison table on this page. Order determines the table row order.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem">
        <?php foreach ($allBrokers as $br): ?>
            <label class="a-checkbox" style="background:#f8fafc;border:1px solid var(--border);border-radius:6px;padding:.5rem .75rem">
                <input type="checkbox" name="broker_ids[]" value="<?= $br['id'] ?>"
                       <?= in_array((int)$br['id'], array_map('intval', $selectedBrokers)) ? 'checked' : '' ?>>
                <span><?= e($br['name']) ?></span>
            </label>
        <?php endforeach; ?>
        </div>

        <div class="section-divider">FAQ (for Google AI Overview & rich results)</div>

        <div class="a-field">
            <label for="faq_json">FAQ JSON Array</label>
            <textarea id="faq_json" name="faq_json" style="min-height:200px;font-family:monospace;font-size:.78rem"><?= e($page['faq_json'] ?? '[]') ?></textarea>
            <div class="hint">Format: <code>[{"q":"Question 1?","a":"Answer 1."},{"q":"Question 2?","a":"Answer 2."}]</code> - Generates FAQ accordion + JSON-LD schema for search engines.</div>
        </div>

        <div class="section-divider">SEO Meta</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title"
                       value="<?= e($page['meta_title'] ?? '') ?>"
                       placeholder="Best Forex Brokers in UAE 2025 | Trader Gulf">
                <div class="hint">Keep under 60 characters for best display in search results.</div>
            </div>
            <div class="a-field">
                <label for="meta_description">Meta Description</label>
                <input type="text" id="meta_description" name="meta_description"
                       value="<?= e($page['meta_description'] ?? '') ?>"
                       placeholder="Compare the top forex brokers for UAE traders in 2025...">
                <div class="hint">Keep under 155 characters.</div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">Save Page</button>
            <a href="<?= url('admin/seo') ?>" class="btn-a btn-a-ghost">Cancel</a>
            <?php if (!$isNew): ?>
            <form action="<?= url("admin/seo/{$page['id']}/delete") ?>" method="post" style="margin:0;margin-left:auto"
                  onsubmit="return confirm('Permanently delete this SEO page?')">
                <?= csrf_field() ?>
                <button type="submit" class="btn-a btn-a-danger">Delete Page</button>
            </form>
            <?php endif; ?>
        </div>
    </form>
    </div>
</div>
