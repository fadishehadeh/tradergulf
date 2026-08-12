<div class="page-header">
    <div class="container">
        <h1><?= e($page['title']) ?></h1>
    </div>
</div>

<div class="container">
<div style="max-width:800px">
    <div class="card card-body" style="line-height:1.9">
        <?php if ($page['content_html']): ?>
            <?= $page['content_html'] ?>
        <?php else: ?>
            <p style="color:var(--muted)">This page is being updated. Please check back soon.</p>
        <?php endif; ?>
    </div>
</div>
</div>
