<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('glossary') ?>">Glossary</a><span class="sep">›</span>
            <span><?= e($term['term']) ?></span>
        </div>
        <h1><?= e($term['term']) ?></h1>
    </div>
</div>

<div class="container">
<div style="display:grid;grid-template-columns:1fr 280px;gap:2rem;align-items:start">

    <div>
        <div class="card card-body" style="font-size:1.05rem;line-height:1.9">
            <?= $term['definition_html'] ?>
        </div>

        <?php if (!empty($related)): ?>
        <div style="margin-top:2rem">
            <h3>Related Terms</h3>
            <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.75rem">
            <?php foreach ($related as $r): ?>
                <a href="<?= url('glossary/' . $r['slug']) ?>" class="btn btn-ghost btn-sm"><?= e($r['term']) ?></a>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <aside>
        <div class="card card-body" style="margin-bottom:1rem">
            <h4 style="margin-bottom:.75rem">Browse Glossary</h4>
            <a href="<?= url('glossary') ?>" class="btn btn-outline btn-sm btn-block">← Back to A–Z Index</a>
        </div>
        <div class="card card-body">
            <h4 style="margin-bottom:.75rem">Compare Brokers</h4>
            <p style="font-size:.85rem;color:var(--muted);margin-bottom:.75rem">Ready to trade? Compare top forex brokers side by side.</p>
            <a href="<?= url('compare') ?>" class="btn btn-primary btn-sm btn-block">Compare Now</a>
        </div>
    </aside>

</div>
</div>
