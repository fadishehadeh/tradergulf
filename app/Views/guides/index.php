<div class="page-header">
    <div class="container">
        <h1>Forex Trading Guides</h1>
        <p>Beginner-friendly guides to help you understand forex trading and make better decisions.</p>
    </div>
</div>

<div class="container">

    <div style="text-align:center;padding:.5rem 0 1.25rem">
        <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:.3rem">Advertisement</div>
        <a href="https://clicks.pipaffiliates.com/c?m=149878&c=1236678" referrerpolicy="no-referrer-when-downgrade" target="_blank" rel="nofollow noopener sponsored" data-track="banner_click" data-track-label="pip_guides">
            <img src="https://ads.pipaffiliates.com/i/149878?c=1236678" width="600" height="90" referrerpolicy="no-referrer-when-downgrade" alt="Sponsored" style="max-width:100%;height:auto;border-radius:6px;display:inline-block" loading="lazy">
        </a>
    </div>

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
