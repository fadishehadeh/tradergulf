<div class="a-card">
    <div class="a-card-header">
        <h2>Static Pages</h2>
    </div>
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Page</th>
                    <th>Slug</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($pages)): ?>
            <tr><td colspan="4" style="color:#94a3b8;text-align:center;padding:2rem">No pages found.</td></tr>
            <?php else: ?>
            <?php foreach ($pages as $p): ?>
            <tr>
                <td style="font-weight:600"><?= e($p['title']) ?></td>
                <td style="font-size:.82rem;color:#64748b"><?= e($p['slug']) ?></td>
                <td style="font-size:.82rem;color:#64748b">
                    <?= $p['updated_at'] ? date('M j, Y', strtotime($p['updated_at'])) : '-' ?>
                </td>
                <td>
                    <div class="row-actions">
                        <a href="<?= url("admin/pages/{$p['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                        <a href="<?= url($p['slug']) ?>" target="_blank" class="btn-a btn-a-ghost btn-a-sm">View</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
