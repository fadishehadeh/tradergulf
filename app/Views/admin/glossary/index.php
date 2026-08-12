<div class="a-card">
    <div class="a-card-header">
        <h2>Glossary (<?= count($terms) ?> terms)</h2>
        <a href="<?= url('admin/glossary/create') ?>" class="btn-a btn-a-accent">+ Add Term</a>
    </div>
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Term</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($terms)): ?>
            <tr><td colspan="3" style="color:#94a3b8;text-align:center;padding:2rem">No terms yet.</td></tr>
            <?php else: ?>
            <?php foreach ($terms as $t): ?>
            <tr>
                <td style="font-weight:600"><?= e($t['term']) ?></td>
                <td style="font-size:.82rem;color:#64748b"><?= e($t['slug']) ?></td>
                <td>
                    <div class="row-actions">
                        <a href="<?= url("admin/glossary/{$t['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                        <form action="<?= url("admin/glossary/{$t['id']}/delete") ?>" method="post"
                              onsubmit="return confirm('Delete term &quot;<?= e(addslashes($t['term'])) ?>&quot;?')">
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
