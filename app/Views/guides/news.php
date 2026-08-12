<div class="page-header">
    <div class="container">
        <h1>Forex Market News</h1>
        <p>Latest forex market news, analysis, and updates.</p>
    </div>
</div>

<div class="container">
<?php if (!empty($news)): ?>
    <div class="article-grid">
    <?php foreach ($news as $n): ?>
        <div class="article-card">
            <div class="article-card-body">
                <div class="article-meta"><?= date('M j, Y', strtotime($n['published_at'])) ?></div>
                <h3><a href="<?= url('news/' . $n['slug']) ?>"><?= e($n['title']) ?></a></h3>
                <?php if ($n['excerpt']): ?>
                <p><?= e($n['excerpt']) ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <div style="text-align:center;padding:4rem;color:var(--muted)">
        <p>No news articles yet. Check back soon.</p>
    </div>
<?php endif; ?>
</div>
