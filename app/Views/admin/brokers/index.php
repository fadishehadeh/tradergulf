<div class="a-card">
    <div class="a-card-header">
        <h2>All Brokers (<?= count($brokers) ?>)</h2>
        <a href="<?= url('admin/brokers/create') ?>" class="btn-a btn-a-accent">+ Add Broker</a>
    </div>
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($brokers)): ?>
            <tr><td colspan="5" style="color:#94a3b8;text-align:center;padding:2rem">No brokers yet.</td></tr>
            <?php else: ?>
            <?php foreach ($brokers as $b): ?>
            <tr>
                <td>
                    <div style="font-weight:600"><?= e($b['name']) ?></div>
                    <div style="font-size:.75rem;color:#94a3b8"><?= e($b['slug']) ?></div>
                </td>
                <td><?= e($b['headquarters']) ?></td>
                <td><strong><?= e($b['overall_rating']) ?></strong>/5</td>
                <td>
                    <?php if ($b['is_active']): ?>
                    <span class="badge badge-green">Active</span>
                    <?php else: ?>
                    <span class="badge badge-gray">Inactive</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="row-actions">
                        <a href="<?= url("admin/brokers/{$b['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                        <a href="<?= url("admin/brokers/{$b['id']}/review") ?>" class="btn-a btn-a-ghost btn-a-sm">Review</a>
                        <a href="<?= url("brokers/{$b['slug']}") ?>" target="_blank" class="btn-a btn-a-ghost btn-a-sm">View</a>
                        <form action="<?= url("admin/brokers/{$b['id']}/delete") ?>" method="post"
                              onsubmit="return confirm('Delete <?= e(addslashes($b['name'])) ?>? This also removes the review.')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-a btn-a-danger btn-a-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
