<div class="page-header">
    <div class="container">
        <h1>Forex Trading Guides</h1>
        <p>Beginner-friendly guides to help you understand forex trading and make better decisions.</p>
    </div>
</div>

<div class="container">

    <div style="padding:.5rem 0 1.25rem">
        <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_guides_top">
            <div class="adv-inner">
                <div><div class="adv-tag">Advertisement</div><div class="adv-title">Advertise With Trader Gulf</div><div class="adv-sub">Reach thousands of active forex traders</div></div>
                <div class="adv-btn">Get In Touch →</div>
            </div>
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

<?php if (!empty($guides)): ?>
<script type="application/ld+json"><?= json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',                   'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Forex Trading Guides', 'item' => url('guides')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'ItemList',
    'name'            => 'Forex Trading Guides',
    'description'     => 'Beginner-friendly guides to help you understand forex trading and make better decisions.',
    'url'             => url('guides'),
    'numberOfItems'   => count($guides),
    'itemListElement' => array_values(array_map(fn($g, $i) => [
        '@type'    => 'ListItem',
        'position' => $i + 1,
        'name'     => $g['title'],
        'url'      => url('guides/' . $g['slug']),
    ], $guides, array_keys($guides))),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endif; ?>
