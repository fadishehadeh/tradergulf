<div class="a-card" style="max-width:640px">
    <div class="a-card-header">
        <div>
            <h3 style="margin:0;font-size:1rem">
                <?= $ad ? 'Edit Ad' : 'New Ad' ?> - <?= e($zone['name']) ?>
            </h3>
            <p style="color:var(--a-muted);font-size:.8rem;margin:.2rem 0 0">
                <?= e((string)$zone['width']) ?>×<?= e((string)$zone['height']) ?>px &nbsp;·&nbsp;
                $<?= number_format((float)$zone['price_monthly'], 0) ?>/month
            </p>
        </div>
        <a href="<?= url('admin/ads') ?>" class="btn-a btn-a-ghost btn-a-sm">← Back</a>
    </div>

    <form method="post" action="<?= $ad ? url('admin/ads/' . $ad['id'] . '/edit') : url('admin/ads/create') ?>"
          style="padding:1.5rem;display:flex;flex-direction:column;gap:1.25rem">
        <?= csrf_field() ?>
        <input type="hidden" name="zone_id" value="<?= $zone['id'] ?>">

        <div>
            <label class="a-label">Advertiser Name</label>
            <input type="text" name="advertiser" class="a-input"
                   value="<?= e($ad['advertiser'] ?? '') ?>"
                   placeholder="e.g. Exness, XTB, IC Markets">
        </div>

        <div>
            <label class="a-label">Image URL <span style="color:#dc2626">*</span></label>
            <input type="url" name="image_url" class="a-input" required
                   value="<?= e($ad['image_url'] ?? '') ?>"
                   placeholder="https://cdn.example.com/banner-728x90.jpg">
            <p style="font-size:.75rem;color:var(--a-muted);margin:.4rem 0 0">
                Upload your image to any CDN or your own hosting. Recommended: <?= $zone['width'] ?>×<?= $zone['height'] ?>px, PNG or JPG.
            </p>
        </div>

        <div>
            <label class="a-label">Destination URL (Click URL) <span style="color:#dc2626">*</span></label>
            <input type="url" name="click_url" class="a-input" required
                   value="<?= e($ad['click_url'] ?? '') ?>"
                   placeholder="https://www.advertiser.com/landing-page">
        </div>

        <div>
            <label class="a-label">Alt Text (for accessibility)</label>
            <input type="text" name="alt_text" class="a-input"
                   value="<?= e($ad['alt_text'] ?? '') ?>"
                   placeholder="e.g. Trade with XTB - tight spreads, no commissions">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div>
                <label class="a-label">Start Date</label>
                <input type="date" name="starts_at" class="a-input"
                       value="<?= e($ad['starts_at'] ?? '') ?>">
            </div>
            <div>
                <label class="a-label">End Date</label>
                <input type="date" name="ends_at" class="a-input"
                       value="<?= e($ad['ends_at'] ?? '') ?>">
                <p style="font-size:.75rem;color:var(--a-muted);margin:.4rem 0 0">Leave blank = no expiry</p>
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:.65rem">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1" style="width:1rem;height:1rem"
                   <?= (!$ad || $ad['is_active']) ? 'checked' : '' ?>>
            <label for="is_active" style="font-weight:600;font-size:.88rem;cursor:pointer">
                Active (show on site immediately)
            </label>
        </div>

        <?php if ($ad && $ad['image_url']): ?>
        <div style="background:#f8fafc;border:1px solid var(--a-border);border-radius:8px;padding:1rem;text-align:center">
            <p style="font-size:.75rem;color:var(--a-muted);margin:0 0 .6rem">Current image preview</p>
            <img src="<?= e($ad['image_url']) ?>" alt="preview"
                 style="max-width:100%;max-height:120px;object-fit:contain;border-radius:4px">
        </div>
        <?php endif; ?>

        <div style="display:flex;gap:.75rem;padding-top:.5rem;border-top:1px solid var(--a-border)">
            <button type="submit" class="btn-a btn-a-primary">
                <?= $ad ? 'Save Changes' : 'Create Ad' ?>
            </button>
            <a href="<?= url('admin/ads') ?>" class="btn-a btn-a-ghost">Cancel</a>
        </div>
    </form>
</div>
