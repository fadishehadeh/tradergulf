<div class="page-header">
    <div class="container">
        <h1>Forex Broker Reviews</h1>
        <p>Independent, in-depth reviews of the world's top forex and CFD brokers.</p>
    </div>
</div>

<div class="container">

    <?php $__listingTopAd = ad_zone('broker_listing_top'); if ($__listingTopAd) echo $__listingTopAd; ?>

    <div style="padding:.5rem 0 1rem">
        <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_brokers_top">
            <div class="adv-inner">
                <div><div class="adv-tag">Advertisement</div><div class="adv-title">Advertise With Trader Gulf</div><div class="adv-sub">Reach thousands of active forex traders</div></div>
                <div class="adv-btn">Get In Touch →</div>
            </div>
        </a>
    </div>

    <?php $__betweenAd = ad_zone('between_listings'); ?>
    <div style="display:flex;flex-direction:column;gap:1rem">
    <?php foreach ($brokers as $__brokerIdx => $b): ?>
        <div class="card">
            <div class="card-body" style="display:grid;grid-template-columns:160px 1fr auto;gap:1.5rem;align-items:center">

                <!-- Broker name -->
                <div style="text-align:center">
                    <div style="font-weight:800;font-size:1.1rem;color:var(--navy)"><?= e($b['name']) ?></div>
                </div>

                <!-- Stats -->
                <div>
                    <h3 style="margin-bottom:.25rem"><?= e($b['name']) ?> Review</h3>
                    <?php if ($b['tagline']): ?>
                    <p style="color:var(--muted);font-size:.9rem;margin-bottom:.85rem"><?= e($b['tagline']) ?></p>
                    <?php endif; ?>
                    <div style="display:flex;gap:1.25rem;flex-wrap:wrap">
                        <div><span style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">Min Deposit</span><br><strong>$<?= e(number_format((float)$b['min_deposit'])) ?></strong></div>
                        <div><span style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">EUR/USD Spread</span><br><strong><?= e($b['spread_eurusd']) ?> pips</strong></div>
                        <div><span style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">Max Leverage</span><br><strong><?= e($b['max_leverage']) ?></strong></div>
                        <div><span style="font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em">Regulation</span><br><strong><?= e($b['regulation']) ?></strong></div>
                        <?php if ($b['has_islamic']): ?>
                        <div><span class="tag tag-green">Islamic ✓</span></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Actions -->
                <div style="display:flex;flex-direction:column;gap:.65rem;min-width:140px">
                    <a href="<?= url('brokers/' . $b['slug']) ?>" class="btn btn-outline btn-sm">Read Review</a>
                    <?php if ($b['affiliate_url']): ?>
                    <a href="<?= url('go/' . $b['slug']) ?>" class="btn btn-primary btn-sm" target="_blank" rel="nofollow noopener"
                       data-track="affiliate_click" data-track-label="<?= e($b['name']) ?>">Visit Broker</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php if ($__betweenAd && ($__brokerIdx + 1) % 4 === 0 && ($__brokerIdx + 1) < count($brokers)): ?>
        <?= $__betweenAd ?>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>

    <?php if ($pages > 1): ?>
    <div style="display:flex;justify-content:center;gap:.4rem;margin-top:2rem;flex-wrap:wrap">
        <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="btn btn-ghost btn-sm">← Prev</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
        <a href="?page=<?= $i ?>" class="btn btn-sm <?= $i === $page ? 'btn-primary' : 'btn-ghost' ?>"><?= $i ?></a>
        <?php endfor; ?>
        <?php if ($page < $pages): ?>
        <a href="?page=<?= $page + 1 ?>" class="btn btn-ghost btn-sm">Next →</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="card card-body" style="margin-top:2rem;font-size:.85rem;color:var(--muted);line-height:1.7">
        <strong>Disclaimer:</strong> Trader Gulf is an independent review site. We may receive compensation when you click on links to brokers we review. This does not affect our ratings or editorial independence. CFD and forex trading involves significant risk of loss.
    </div>

</div>

<?php
$__breadcrumb = [
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Forex Broker Reviews', 'item' => url('brokers')],
    ],
];
$__itemList = [
    '@context'       => 'https://schema.org',
    '@type'          => 'ItemList',
    'name'           => 'Best Forex Brokers — Independent Reviews',
    'description'    => 'Independent, in-depth reviews of the world\'s top forex and CFD brokers.',
    'url'            => url('brokers'),
    'numberOfItems'  => count($brokers),
    'itemListElement'=> array_values(array_map(fn($b, $i) => [
        '@type'    => 'ListItem',
        'position' => $i + 1,
        'name'     => $b['name'] . ' Review',
        'url'      => url('brokers/' . $b['slug']),
    ], $brokers, array_keys($brokers))),
];
?>
<script type="application/ld+json"><?= json_encode($__breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($__itemList, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
