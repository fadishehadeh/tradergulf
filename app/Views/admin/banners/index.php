<div class="a-card">
    <div class="a-card-header">
        <h2>All Banners</h2>
        <span class="badge badge-gray"><?= count($banners) ?> positions</span>
    </div>
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Position</th>
                    <th>Type</th>
                    <th>Broker Linked</th>
                    <th>Affiliate URL</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($banners as $b): ?>
            <tr>
                <td style="color:var(--muted)"><?= (int)$b['sort_order'] ?></td>
                <td>
                    <div style="font-weight:600"><?= e($b['label'] ?? $b['position']) ?></div>
                    <div style="font-size:.75rem;color:var(--muted)"><?= e($b['position']) ?></div>
                </td>
                <td>
                    <?php if ($b['type'] === 'landscape'): ?>
                    <span class="badge badge-blue">Landscape 728×90</span>
                    <?php else: ?>
                    <span class="badge badge-amber">Portrait 300×600</span>
                    <?php endif; ?>
                </td>
                <td><?= $b['broker_name'] ? e($b['broker_name']) : '<span style="color:var(--muted)">—</span>' ?></td>
                <td style="max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                    <?php if (!empty($b['link_url']) && $b['link_url'] !== '#'): ?>
                    <a href="<?= e($b['link_url']) ?>" target="_blank" style="font-size:.8rem;color:var(--muted)"><?= e($b['link_url']) ?></a>
                    <?php else: ?>
                    <span style="color:var(--danger);font-size:.8rem">⚠ No URL set</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($b['is_active']): ?>
                    <span class="badge badge-green">Active</span>
                    <?php else: ?>
                    <span class="badge badge-gray">Off</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= url("admin/banners/{$b['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="a-card" style="margin-top:1rem;padding:1rem 1.25rem;background:#fffbeb;border-color:#fde68a">
    <p style="font-size:.85rem;color:#78350f">
        <strong>Tip:</strong> Update each banner's affiliate URL with your IB tracking link once you have joined the broker's affiliate or introducing broker programme.
        The "Visit Broker" buttons on the public site pull from these URLs.
    </p>
</div>
