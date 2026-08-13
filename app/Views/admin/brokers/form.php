<div class="a-card">
    <div class="a-card-header">
        <h2><?= isset($broker['id']) ? 'Edit Broker' : 'Add New Broker' ?></h2>
        <a href="<?= url('admin/brokers') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
    </div>
    <div class="a-card-body">
    <form action="<?= e($action) ?>" method="post" class="a-form" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Basic Info -->
        <div class="section-divider">Basic Info</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="name">Broker Name <span class="req">*</span></label>
                <input type="text" id="name" name="name" required
                       value="<?= e($broker['name'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="slug">URL Slug <span class="req">*</span></label>
                <input type="text" id="slug" name="slug"
                       value="<?= e($broker['slug'] ?? '') ?>"
                       placeholder="auto-generated from name">
                <div class="hint">Leave blank to auto-generate from name</div>
            </div>
        </div>

        <div class="a-form-row a-form-row-3">
            <div class="a-field">
                <label for="headquarters">Headquarters Country</label>
                <input type="text" id="headquarters" name="headquarters"
                       value="<?= e($broker['headquarters'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="founded_year">Year Founded</label>
                <input type="number" id="founded_year" name="founded_year"
                       min="1900" max="<?= date('Y') ?>"
                       value="<?= e($broker['founded_year'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="overall_rating">Overall Rating (0–5)</label>
                <input type="number" id="overall_rating" name="overall_rating"
                       min="0" max="5" step="0.1"
                       value="<?= e($broker['overall_rating'] ?? '4.0') ?>">
            </div>
        </div>

        <!-- Trading Conditions -->
        <div class="section-divider">Trading Conditions</div>

        <div class="a-form-row a-form-row-3">
            <div class="a-field">
                <label for="min_deposit">Min Deposit (USD)</label>
                <input type="number" id="min_deposit" name="min_deposit"
                       min="0" step="1"
                       value="<?= e($broker['min_deposit'] ?? '0') ?>">
            </div>
            <div class="a-field">
                <label for="spread_eurusd">EUR/USD Spread (pips)</label>
                <input type="text" id="spread_eurusd" name="spread_eurusd"
                       value="<?= e($broker['spread_eurusd'] ?? '1.0') ?>">
            </div>
            <div class="a-field">
                <label for="max_leverage">Max Leverage</label>
                <input type="text" id="max_leverage" name="max_leverage"
                       placeholder="e.g. 1:500"
                       value="<?= e($broker['max_leverage'] ?? '1:100') ?>">
            </div>
        </div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="regulation">Regulation (comma-separated)</label>
                <input type="text" id="regulation" name="regulation"
                       placeholder="e.g. FCA, CySEC, ASIC"
                       value="<?= e($broker['regulation'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label for="platforms">Platforms (comma-separated)</label>
                <input type="text" id="platforms" name="platforms"
                       placeholder="e.g. MT4, MT5, cTrader"
                       value="<?= e($broker['platforms'] ?? '') ?>">
            </div>
        </div>

        <!-- Links & Media -->
        <div class="section-divider">Links & Media</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label for="affiliate_url">Affiliate / Visit URL</label>
                <input type="url" id="affiliate_url" name="affiliate_url"
                       value="<?= e($broker['affiliate_url'] ?? '') ?>">
            </div>
            <div class="a-field">
                <label>Broker Logo</label>
                <?php if (!empty($broker['logo'])): ?>
                <div style="margin-bottom:.6rem">
                    <img src="<?= asset('img/brokers/' . $broker['logo']) ?>" alt="Current logo"
                         style="max-height:40px;max-width:140px;object-fit:contain;display:block;margin-bottom:.4rem;border:1px solid var(--a-border);border-radius:6px;padding:4px;background:#fff">
                    <span style="font-size:.77rem;color:var(--a-text-muted)">Current: <?= e($broker['logo']) ?></span>
                </div>
                <?php endif; ?>
                <input type="file" id="logo_file" name="logo_file"
                       accept="image/jpeg,image/png,image/webp,image/svg+xml"
                       style="font-size:.85rem">
                <div class="hint">Upload a new logo (JPG, PNG, WebP, SVG · max 1 MB). Recommended: transparent PNG, 200×60 px. Leave blank to keep the current logo.</div>
                <input type="hidden" name="logo" value="<?= e($broker['logo'] ?? '') ?>">
            </div>
        </div>

        <!-- Settings -->
        <div class="section-divider">Settings</div>

        <label class="a-checkbox">
            <input type="checkbox" name="is_active" value="1"
                   <?= !empty($broker['is_active']) ? 'checked' : '' ?>>
            Active (shown on site)
        </label>

        <label class="a-checkbox">
            <input type="checkbox" name="is_featured" value="1"
                   <?= !empty($broker['is_featured']) ? 'checked' : '' ?>>
            ⭐ Featured (pinned to top, gold border — paid placement)
        </label>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">
                <?= isset($broker['id']) ? 'Save Changes' : 'Create Broker' ?>
            </button>
            <?php if (isset($broker['id'])): ?>
            <a href="<?= url("admin/brokers/{$broker['id']}/review") ?>" class="btn-a btn-a-ghost">
                Edit Review Content
            </a>
            <?php endif; ?>
            <a href="<?= url('admin/brokers') ?>" class="btn-a btn-a-ghost">Cancel</a>
        </div>
    </form>
    </div>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('blur', function() {
    const slugField = document.getElementById('slug');
    if (slugField.value !== '') return;
    slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
});
</script>
