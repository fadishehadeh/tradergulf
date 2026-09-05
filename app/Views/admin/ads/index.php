<?php
$ctr = fn($imp, $clk) => $imp > 0 ? round($clk / $imp * 100, 2) . '%' : '-';
?>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <div>
        <p style="color:var(--a-muted);font-size:.88rem;margin:0">
            Manage paid ad placements. Completely separate from IB broker banners.
        </p>
    </div>
</div>

<?php foreach ($zones as $zone): ?>
<div class="a-card" style="margin-bottom:2rem">
    <div class="a-card-header">
        <div>
            <h3 style="margin:0;font-size:1rem"><?= e($zone['name']) ?></h3>
            <p style="color:var(--a-muted);font-size:.8rem;margin:.2rem 0 0">
                <?= e($zone['description']) ?> &nbsp;·&nbsp;
                <?= $zone['width'] ?>×<?= $zone['height'] ?>px &nbsp;·&nbsp;
                <strong style="color:var(--a-accent)">$<?= number_format((float)$zone['price_monthly'], 0) ?>/mo</strong>
            </p>
        </div>
        <a href="<?= url('admin/ads/create?zone_id=' . $zone['id']) ?>" class="btn-a btn-a-primary btn-a-sm">+ New Ad</a>
    </div>

    <?php if (empty($zone['ads'])): ?>
    <div style="padding:1.5rem;text-align:center;color:var(--a-muted);font-size:.88rem">
        No ads in this zone yet. <a href="<?= url('admin/ads/create?zone_id=' . $zone['id']) ?>" style="color:var(--a-accent)">Add one →</a>
    </div>
    <?php else: ?>
    <table style="width:100%;border-collapse:collapse;font-size:.875rem">
        <thead>
            <tr style="background:#f8fafc;font-size:.72rem;text-transform:uppercase;letter-spacing:.05em;color:var(--a-muted)">
                <th style="padding:.6rem 1rem;text-align:left;border-bottom:1px solid var(--a-border)">Advertiser</th>
                <th style="padding:.6rem 1rem;text-align:left;border-bottom:1px solid var(--a-border)">Image</th>
                <th style="padding:.6rem 1rem;text-align:left;border-bottom:1px solid var(--a-border)">Dates</th>
                <th style="padding:.6rem 1rem;text-align:right;border-bottom:1px solid var(--a-border)">Impr.</th>
                <th style="padding:.6rem 1rem;text-align:right;border-bottom:1px solid var(--a-border)">Clicks</th>
                <th style="padding:.6rem 1rem;text-align:right;border-bottom:1px solid var(--a-border)">CTR</th>
                <th style="padding:.6rem 1rem;text-align:left;border-bottom:1px solid var(--a-border)">Status</th>
                <th style="padding:.6rem 1rem;border-bottom:1px solid var(--a-border)"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($zone['ads'] as $ad): ?>
        <tr style="border-bottom:1px solid var(--a-border)">
            <td style="padding:.75rem 1rem;font-weight:600"><?= e($ad['advertiser'] ?: '-') ?></td>
            <td style="padding:.75rem 1rem">
                <a href="<?= e($ad['image_url']) ?>" target="_blank" rel="noopener"
                   style="font-size:.78rem;color:var(--a-accent);word-break:break-all">
                    <?= e(strlen($ad['image_url']) > 40 ? substr($ad['image_url'], 0, 40) . '…' : $ad['image_url']) ?>
                </a>
            </td>
            <td style="padding:.75rem 1rem;font-size:.8rem;color:var(--a-muted)">
                <?= $ad['starts_at'] ? date('d M y', strtotime($ad['starts_at'])) : '-' ?>
                →
                <?= $ad['ends_at'] ? date('d M y', strtotime($ad['ends_at'])) : 'open' ?>
            </td>
            <td style="padding:.75rem 1rem;text-align:right;font-weight:600"><?= number_format($ad['impressions']) ?></td>
            <td style="padding:.75rem 1rem;text-align:right;font-weight:600"><?= number_format($ad['clicks']) ?></td>
            <td style="padding:.75rem 1rem;text-align:right;color:var(--a-muted)"><?= $ctr($ad['impressions'], $ad['clicks']) ?></td>
            <td style="padding:.75rem 1rem">
                <?php if ($ad['is_active']): ?>
                <span style="display:inline-flex;align-items:center;gap:.3rem;background:rgba(52,211,153,.12);color:#059669;padding:.2rem .6rem;border-radius:20px;font-size:.72rem;font-weight:700">● Live</span>
                <?php else: ?>
                <span style="display:inline-flex;align-items:center;gap:.3rem;background:rgba(100,116,139,.1);color:var(--a-muted);padding:.2rem .6rem;border-radius:20px;font-size:.72rem;font-weight:700">● Paused</span>
                <?php endif; ?>
            </td>
            <td style="padding:.75rem 1rem">
                <div style="display:flex;gap:.4rem;justify-content:flex-end">
                    <a href="<?= url('admin/ads/' . $ad['id'] . '/edit') ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                    <form method="post" action="<?= url('admin/ads/' . $ad['id'] . '/toggle') ?>" style="margin:0">
                        <?= csrf_field() ?>
                        <button class="btn-a btn-a-ghost btn-a-sm" type="submit">
                            <?= $ad['is_active'] ? 'Pause' : 'Activate' ?>
                        </button>
                    </form>
                    <form method="post" action="<?= url('admin/ads/' . $ad['id'] . '/delete') ?>" style="margin:0"
                          onsubmit="return confirm('Delete this ad?')">
                        <?= csrf_field() ?>
                        <button class="btn-a btn-a-sm" style="background:#fee2e2;color:#dc2626;border:none;cursor:pointer;padding:.35rem .75rem;border-radius:6px;font-size:.8rem" type="submit">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?php endforeach; ?>
