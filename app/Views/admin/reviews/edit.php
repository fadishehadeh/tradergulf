<div style="margin-bottom:1rem">
    <a href="<?= url('admin/brokers') ?>" class="btn-a btn-a-ghost btn-a-sm">← All Brokers</a>
    <a href="<?= url("brokers/{$broker['slug']}") ?>" target="_blank"
       class="btn-a btn-a-ghost btn-a-sm" style="margin-left:.4rem">View Public Page</a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h2>Review Content: <?= e($broker['name']) ?></h2>
        <span style="font-size:.78rem;color:#94a3b8">
            <?= $review ? 'Last updated: ' . e($review['last_updated'] ?? '-') : 'No review yet - fill in the fields below' ?>
        </span>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" class="a-form">
        <?= csrf_field() ?>

        <!-- Pros / Cons -->
        <div class="section-divider">Pros & Cons</div>
        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="pros_text">Pros (one per line)</label>
                <textarea id="pros_text" name="pros_text" class="tall"><?= e($review['pros_text'] ?? '') ?></textarea>
            </div>
            <div class="a-field">
                <label for="cons_text">Cons (one per line)</label>
                <textarea id="cons_text" name="cons_text" class="tall"><?= e($review['cons_text'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Review sections -->
        <div class="section-divider">Review Sections (HTML accepted)</div>

        <?php
        $sections = [
            'intro_html'         => 'Introduction',
            'overview_html'      => 'Overview',
            'regulation_html'    => 'Regulation & Safety',
            'account_types_html' => 'Account Types',
            'platforms_html'     => 'Trading Platforms',
            'spreads_html'       => 'Spreads & Fees',
            'deposits_html'      => 'Deposits & Withdrawals',
            'support_html'       => 'Customer Support',
            'verdict_html'       => 'Verdict',
        ];
        foreach ($sections as $field => $label): ?>
        <div class="a-field">
            <label for="<?= $field ?>"><?= $label ?></label>
            <textarea id="<?= $field ?>" name="<?= $field ?>" class="tall"
            ><?= e($review[$field] ?? '') ?></textarea>
        </div>
        <?php endforeach; ?>

        <!-- SEO -->
        <div class="section-divider">SEO</div>
        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title"
                       value="<?= e($review['meta_title'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="meta_description">Meta Description</label>
                <input type="text" id="meta_description" name="meta_description"
                       value="<?= e($review['meta_description'] ?? '') ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">Save Review</button>
            <a href="<?= url("admin/brokers/{$broker['id']}/edit") ?>" class="btn-a btn-a-ghost">Edit Broker Info</a>
        </div>
    </form>
    </div>
</div>
