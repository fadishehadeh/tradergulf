<div class="a-card-header" style="margin-bottom:1rem;padding:0">
    <div></div>
    <a href="<?= url('admin/seo/create') ?>" class="btn-a btn-a-accent">+ New SEO Page</a>
</div>

<?php
$grouped = [];
foreach ($pages as $p) {
    $grouped[$p['page_type']][] = $p;
}
$labels = ['geo' => '🌍 GEO Pages', 'category' => '📂 Category Pages', 'comparison' => '⚖️ Comparison Pages'];
?>

<?php foreach ($grouped as $type => $group): ?>
<div class="a-card" style="margin-bottom:1.25rem">
    <div class="a-card-header">
        <h2><?= $labels[$type] ?? ucfirst($type) ?></h2>
        <span class="badge badge-gray"><?= count($group) ?> page<?= count($group) !== 1 ? 's' : '' ?></span>
    </div>
    <div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr><th>H1 / Title</th><th>Slug</th><th>Status</th><th>Updated</th><th></th></tr>
            </thead>
            <tbody>
            <?php foreach ($group as $p): ?>
            <tr>
                <td style="font-weight:600"><?= e($p['h1']) ?></td>
                <td style="font-family:monospace;font-size:.8rem;color:var(--muted)">/best/<?= e($p['slug']) ?></td>
                <td>
                    <?php if ($p['is_published']): ?>
                    <span class="badge badge-green">Live</span>
                    <?php else: ?>
                    <span class="badge badge-amber">Draft</span>
                    <?php endif; ?>
                </td>
                <td style="font-size:.8rem;color:var(--muted)"><?= date('M j, Y', strtotime($p['updated_at'])) ?></td>
                <td>
                    <div class="row-actions">
                        <?php if ($p['is_published']): ?>
                        <a href="<?= url('best/' . $p['slug']) ?>" target="_blank" class="btn-a btn-a-ghost btn-a-sm">View</a>
                        <?php endif; ?>
                        <a href="<?= url("admin/seo/{$p['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                        <form action="<?= url("admin/seo/{$p['id']}/delete") ?>" method="post" style="margin:0"
                              onsubmit="return confirm('Delete this SEO page?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-a btn-a-danger btn-a-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endforeach; ?>

<?php if (empty($pages)): ?>
<div class="a-card" style="text-align:center;padding:3rem">
    <div style="font-size:2rem;margin-bottom:.75rem">📄</div>
    <p style="color:var(--muted)">No SEO pages yet. Create your first one to start ranking for GEO and category queries.</p>
    <a href="<?= url('admin/seo/create') ?>" class="btn-a btn-a-accent" style="margin-top:1rem">+ Create First SEO Page</a>
</div>
<?php endif; ?>
