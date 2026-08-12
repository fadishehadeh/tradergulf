<!-- Stat tiles -->
<div class="stat-grid">
    <div class="stat-tile">
        <div class="stat-tile-label">Brokers</div>
        <div class="stat-tile-value"><?= $brokers ?></div>
        <div class="stat-tile-sub"><a href="<?= url('admin/brokers') ?>">Manage →</a></div>
    </div>
    <div class="stat-tile">
        <div class="stat-tile-label">Articles</div>
        <div class="stat-tile-value"><?= $articles ?></div>
        <div class="stat-tile-sub"><a href="<?= url('admin/articles') ?>">Manage →</a></div>
    </div>
    <div class="stat-tile">
        <div class="stat-tile-label">Glossary Terms</div>
        <div class="stat-tile-value"><?= $glossary ?></div>
        <div class="stat-tile-sub"><a href="<?= url('admin/glossary') ?>">Manage →</a></div>
    </div>
    <div class="stat-tile">
        <div class="stat-tile-label">Static Pages</div>
        <div class="stat-tile-value"><?= $pages ?></div>
        <div class="stat-tile-sub"><a href="<?= url('admin/pages') ?>">Manage →</a></div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">

    <!-- Recent brokers -->
    <div class="a-card">
        <div class="a-card-header">
            <h2>Recent Brokers</h2>
            <a href="<?= url('admin/brokers/create') ?>" class="btn-a btn-a-accent btn-a-sm">+ Add Broker</a>
        </div>
        <div class="a-table-wrap">
            <table class="a-table">
                <thead>
                    <tr><th>Name</th><th>Rating</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                <?php if (empty($recentBrokers)): ?>
                <tr><td colspan="4" style="color:#94a3b8;text-align:center;padding:1.5rem">No brokers yet.</td></tr>
                <?php else: ?>
                <?php foreach ($recentBrokers as $b): ?>
                <tr>
                    <td style="font-weight:600"><?= e($b['name']) ?></td>
                    <td><?= e($b['overall_rating']) ?></td>
                    <td>
                        <?php if ($b['is_active']): ?>
                        <span class="badge badge-green">Active</span>
                        <?php else: ?>
                        <span class="badge badge-gray">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= url("admin/brokers/{$b['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent articles -->
    <div class="a-card">
        <div class="a-card-header">
            <h2>Recent Articles</h2>
            <a href="<?= url('admin/articles/create') ?>" class="btn-a btn-a-accent btn-a-sm">+ New Article</a>
        </div>
        <div class="a-table-wrap">
            <table class="a-table">
                <thead>
                    <tr><th>Title</th><th>Type</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                <?php if (empty($recentArticles)): ?>
                <tr><td colspan="4" style="color:#94a3b8;text-align:center;padding:1.5rem">No articles yet.</td></tr>
                <?php else: ?>
                <?php foreach ($recentArticles as $a): ?>
                <tr>
                    <td style="font-weight:600;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= e($a['title']) ?></td>
                    <td><span class="badge badge-blue"><?= e($a['category']) ?></span></td>
                    <td>
                        <?php if ($a['is_published']): ?>
                        <span class="badge badge-green">Live</span>
                        <?php else: ?>
                        <span class="badge badge-amber">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= url("admin/articles/{$a['id']}/edit") ?>" class="btn-a btn-a-ghost btn-a-sm">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
