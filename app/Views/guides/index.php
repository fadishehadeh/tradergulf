<div class="page-header">
    <div class="container">
        <h1>Forex Trading Guides</h1>
        <p>Beginner-friendly guides to help you understand forex trading and make better decisions.</p>
    </div>
</div>

<div class="container">
<?php if (!empty($guides)): ?>
    <div class="article-grid">
    <?php foreach ($guides as $g): ?>
        <div class="article-card">
            <div class="article-card-body">
                <div class="article-meta"><?= date('M j, Y', strtotime($g['published_at'])) ?></div>
                <h3><a href="<?= url('guides/' . $g['slug']) ?>"><?= e($g['title']) ?></a></h3>
                <?php if ($g['excerpt']): ?>
                <p><?= e($g['excerpt']) ?></p>
                <?php endif; ?>
                <a href="<?= url('guides/' . $g['slug']) ?>" class="btn btn-ghost btn-sm" style="margin-top:.75rem">Read Guide →</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <div style="text-align:center;padding:4rem;color:var(--muted)">
        <p>No guides published yet. Check back soon.</p>
    </div>
<?php endif; ?>
</div>
