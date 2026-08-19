<div class="a-card">
    <div class="a-card-header">
        <h2>Articles (<?= count($articles) ?>)</h2>
        <a href="<?= url('admin/articles/create') ?>" class="btn-a btn-a-accent">+ New Article</a>
    </div>
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($articles)): ?>
            <tr><td colspan="5" style="color:#94a3b8;text-align:center;padding:2rem">No articles yet.</td></tr>
            <?php else: ?>
            <?php foreach ($articles as $a): ?>
            <tr>
                <td>
                    <div style="font-weight:600"><?= e($a['title']) ?></div>
                </td>
                <td>
                    <span class="badge badge-blue"><?= e(ucfirst($a['category'])) ?></span>
                </td>
                <td>
                    <?php if ($a['is_published']): ?>
                    <span class="badge badge-green">Live</span>
                    <?php else: ?>
                    <span class="badge badge-amber">Draft</span>
                    <?php endif; ?>
                </td>
                <td style="font-size:.82rem;color:#64748b">
                    <?= $a['published_at'] ? date('M j, Y', strtotime($a['published_at'])) : '-' ?>
                </td>
                <td>
                    <div class="row-actions">
                        <a href="<?= url("admin/articles/{$a['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                        <form action="<?= url("admin/articles/{$a['id']}/delete") ?>" method="post"
                              onsubmit="return confirm('Delete this article?')">
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
