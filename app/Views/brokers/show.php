<?php
$sections = [
    'overview'      => 'Overview',
    'pros-cons'     => 'Pros & Cons',
    'regulation'    => 'Regulation',
    'account-types' => 'Account Types',
    'platforms'     => 'Platforms',
    'spreads'       => 'Spreads & Fees',
    'deposits'      => 'Deposits & Withdrawals',
    'support'       => 'Customer Support',
    'verdict'       => 'Verdict',
];

$sectionIcons = [
    'overview'      => '📋',
    'pros-cons'     => '⚖️',
    'regulation'    => '🛡️',
    'account-types' => '👤',
    'platforms'     => '🖥️',
    'spreads'       => '💰',
    'deposits'      => '🏦',
    'support'       => '💬',
    'verdict'       => '🏆',
];
?>

<!-- ── Review Hero ─────────────────────────────────── -->
<section class="rv-hero">
    <div class="container">
        <nav class="rv-breadcrumbs">
            <a href="<?= url() ?>">Home</a>
            <span>›</span>
            <a href="<?= url('brokers') ?>">Brokers</a>
            <span>›</span>
            <span><?= e($broker['name']) ?> Review</span>
        </nav>

        <div class="rv-hero-inner">
            <div class="rv-hero-brand">
                <?php if (!empty($broker['logo'])): ?>
                <img src="<?= url('assets/img/brokers/' . e($broker['logo'])) ?>"
                     alt="<?= e($broker['name']) ?> logo"
                     class="rv-hero-logo"
                     loading="eager" decoding="async">
                <?php else: ?>
                <div class="rv-hero-logo-placeholder"><?= e(strtoupper(substr($broker['name'], 0, 2))) ?></div>
                <?php endif; ?>
                <div class="rv-hero-title-wrap">
                    <h1 class="rv-hero-title"><?= e($broker['name']) ?> Review <?= date('Y') ?></h1>
                    <p class="rv-hero-meta">
                        Updated <?= $broker['last_updated'] ? date('M j, Y', strtotime($broker['last_updated'])) : date('M Y') ?>
                        <?php if (!empty($broker['regulation'])): ?>&nbsp;&middot;&nbsp;<?= e($broker['regulation']) ?><?php endif; ?>
                    </p>
                </div>
            </div>

            <div class="rv-hero-stats">
                <div class="rv-stat">
                    <div class="rv-stat-val">$<?= e(number_format((float)$broker['min_deposit'])) ?></div>
                    <div class="rv-stat-lbl">Min Deposit</div>
                </div>
                <div class="rv-stat-sep"></div>
                <div class="rv-stat">
                    <div class="rv-stat-val"><?= e($broker['max_leverage']) ?></div>
                    <div class="rv-stat-lbl">Max Leverage</div>
                </div>
                <div class="rv-stat-sep"></div>
                <div class="rv-stat">
                    <div class="rv-stat-val"><?= e($broker['spread_eurusd']) ?> pips</div>
                    <div class="rv-stat-lbl">EUR/USD Spread</div>
                </div>
                <div class="rv-stat-sep"></div>
                <div class="rv-stat">
                    <div class="rv-stat-val <?= !empty($broker['has_islamic']) ? 'rv-stat-yes' : 'rv-stat-no' ?>"><?= !empty($broker['has_islamic']) ? '✓ Yes' : '✗ No' ?></div>
                    <div class="rv-stat-lbl">Islamic Account</div>
                </div>
            </div>

            <?php if (!empty($broker['affiliate_url'])): ?>
            <div class="rv-hero-cta">
                <a href="<?= url('go/' . $broker['slug']) ?>"
                   class="btn btn-primary"
                   target="_blank" rel="nofollow noopener"
                   data-track="affiliate_click"
                   data-track-label="<?= e($broker['name']) ?>_hero">
                    Visit <?= e($broker['name']) ?> &rarr;
                </a>
                <p class="rv-hero-disclaimer">Capital at risk.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__reviewTopAd = ad_zone('broker_review_top'); if ($__reviewTopAd): ?>
<div class="container" style="padding-top:1rem;padding-bottom:.25rem"><?= $__reviewTopAd ?></div>
<?php endif; ?>

<!-- ── Sticky Tab Bar ────────────────────────────────── -->
<div class="rv-tabs-wrap" id="rvTabsWrap">
    <div class="container">
        <nav class="rv-tabs" role="tablist" id="rvTabs">
            <?php $first = true; foreach ($sections as $id => $label): ?>
            <button class="rv-tab<?= $first ? ' is-active' : '' ?>"
                    data-tab="<?= $id ?>"
                    role="tab"
                    aria-selected="<?= $first ? 'true' : 'false' ?>"
                    aria-controls="rvPanel-<?= $id ?>">
                <span class="rv-tab-icon"><?= $sectionIcons[$id] ?? '' ?></span>
                <span class="rv-tab-label"><?= $label ?></span>
            </button>
            <?php $first = false; endforeach; ?>
        </nav>
    </div>
</div>

<!-- ── Tab Panels ────────────────────────────────────── -->
<div class="rv-panels">
<div class="container">

    <!-- Overview -->
    <div class="rv-panel is-active" id="rvPanel-overview" role="tabpanel">
        <?php if (!empty($broker['intro_html'])): ?>
        <div class="rv-intro-card"><?= $broker['intro_html'] ?></div>
        <?php endif; ?>

        <a href="<?= url('advertise') ?>" class="advertise-here-slot rv-ad-slot" data-track="cta_click" data-track-label="advertise_broker_review">
            <div class="adv-inner">
                <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Researching Brokers</div><div class="adv-sub">Gulf traders reading in-depth reviews - UAE, KSA, Kuwait &amp; Qatar. High intent, low drop-off.</div></div>
                <div class="adv-btn">Get a Quote &rarr;</div>
            </div>
        </a>

        <h2>Overview</h2>
        <?php if (!empty($broker['overview_html'])): ?>
            <?= $broker['overview_html'] ?>
        <?php else: ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:1rem">
            <div class="stat-box"><div class="stat-box-value"><?= e($broker['founded_year'] ?: '-') ?></div><div class="stat-box-label">Founded</div></div>
            <div class="stat-box"><div class="stat-box-value" style="font-size:1rem"><?= e($broker['headquarters'] ?: '-') ?></div><div class="stat-box-label">Headquarters</div></div>
            <div class="stat-box"><div class="stat-box-value" style="font-size:1rem"><?= e($broker['platforms'] ?: '-') ?></div><div class="stat-box-label">Platforms</div></div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pros & Cons -->
    <div class="rv-panel" id="rvPanel-pros-cons" role="tabpanel">
        <h2>Pros &amp; Cons</h2>
        <div class="pros-cons">
            <div>
                <div class="pros-cons-header pros-header">&#10003; Pros</div>
                <ul class="pros-list">
                    <?php foreach ($broker['pros'] as $pro): ?>
                    <li><?= e($pro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <div class="pros-cons-header cons-header">&#10007; Cons</div>
                <ul class="cons-list">
                    <?php foreach ($broker['cons'] as $con): ?>
                    <li><?= e($con) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Regulation -->
    <div class="rv-panel" id="rvPanel-regulation" role="tabpanel">
        <h2>Regulation &amp; Safety</h2>
        <?php if (!empty($broker['regulation_html'])): ?>
            <?= $broker['regulation_html'] ?>
        <?php else: ?>
        <p><?= e($broker['name']) ?> is regulated by: <strong><?= e($broker['regulation']) ?></strong>.</p>
        <p>Regulation provides a layer of protection for traders. Always verify a broker's regulatory status directly with the relevant authority before depositing funds.</p>
        <?php endif; ?>
    </div>

    <!-- Account Types -->
    <div class="rv-panel" id="rvPanel-account-types" role="tabpanel">
        <h2>Account Types</h2>
        <?php if (!empty($broker['account_types_html'])): ?>
            <?= $broker['account_types_html'] ?>
        <?php else: ?>
        <p><?= e($broker['name']) ?> offers a range of account types to suit different trading styles and experience levels. <?= !empty($broker['has_islamic']) ? 'Islamic swap-free accounts are available.' : '' ?> A demo account is <?= !empty($broker['has_demo']) ? 'available' : 'not available' ?> for practice.</p>
        <?php endif; ?>
    </div>

    <!-- Platforms -->
    <div class="rv-panel" id="rvPanel-platforms" role="tabpanel">
        <h2>Trading Platforms</h2>
        <?php if (!empty($broker['platforms_html'])): ?>
            <?= $broker['platforms_html'] ?>
        <?php else: ?>
        <p><?= e($broker['name']) ?> supports the following platforms: <strong><?= e($broker['platforms']) ?></strong>.</p>
        <?php endif; ?>
    </div>

    <!-- Spreads & Fees -->
    <div class="rv-panel" id="rvPanel-spreads" role="tabpanel">
        <h2>Spreads &amp; Fees</h2>
        <?php if (!empty($broker['spreads_html'])): ?>
            <?= $broker['spreads_html'] ?>
        <?php else: ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:1rem;margin-bottom:1rem">
            <div class="stat-box"><div class="stat-box-value"><?= e($broker['spread_eurusd']) ?> pips</div><div class="stat-box-label">EUR/USD Spread</div></div>
            <div class="stat-box"><div class="stat-box-value"><?= ucfirst($broker['spread_type'] ?? 'variable') ?></div><div class="stat-box-label">Spread Type</div></div>
            <div class="stat-box"><div class="stat-box-value">$<?= e(number_format((float)$broker['commission_per_lot'], 2)) ?></div><div class="stat-box-label">Commission/Lot</div></div>
        </div>
        <?php endif; ?>

        <a href="<?= url('advertise') ?>" class="advertise-here-slot rv-ad-slot" data-track="cta_click" data-track-label="advertise_broker_mid">
            <div class="adv-inner">
                <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Your Brand Mid-Review</div><div class="adv-sub">Traders deep in a broker review - maximum engagement, high conversion intent in UAE, KSA &amp; GCC.</div></div>
                <div class="adv-btn">Get a Quote &rarr;</div>
            </div>
        </a>
    </div>

    <!-- Deposits & Withdrawals -->
    <div class="rv-panel" id="rvPanel-deposits" role="tabpanel">
        <h2>Deposits &amp; Withdrawals</h2>
        <?php if (!empty($broker['deposits_html'])): ?>
            <?= $broker['deposits_html'] ?>
        <?php else: ?>
        <p>Minimum deposit: <strong>$<?= e(number_format((float)$broker['min_deposit'])) ?></strong></p>
        <?php if (!empty($broker['deposit_methods'])): ?>
        <p>Accepted deposit methods: <strong><?= e($broker['deposit_methods']) ?></strong></p>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Customer Support -->
    <div class="rv-panel" id="rvPanel-support" role="tabpanel">
        <h2>Customer Support</h2>
        <?php if (!empty($broker['support_html'])): ?>
            <?= $broker['support_html'] ?>
        <?php else: ?>
        <p><?= e($broker['name']) ?> offers customer support via live chat, email, and telephone. Support availability and quality may vary by region.</p>
        <?php endif; ?>
    </div>

    <!-- Verdict -->
    <div class="rv-panel" id="rvPanel-verdict" role="tabpanel">
        <div class="rv-verdict-block">
            <h2>Our Verdict</h2>
            <?php if (!empty($broker['verdict_html'])): ?>
                <?= $broker['verdict_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> is a solid broker with competitive trading conditions. We recommend verifying all terms directly with the broker before opening an account.</p>
            <?php endif; ?>

            <?php if (!empty($broker['affiliate_url'])): ?>
            <div class="rv-verdict-cta">
                <a href="<?= url('go/' . $broker['slug']) ?>"
                   class="btn btn-primary"
                   target="_blank" rel="nofollow noopener"
                   data-track="affiliate_click"
                   data-track-label="<?= e($broker['name']) ?>_review_cta">
                    Open Account with <?= e($broker['name']) ?>
                </a>
                <p style="font-size:.75rem;color:var(--muted);margin-top:.5rem">Capital at risk. <?= (int)round((1/($broker['max_leverage'] ? (int)explode(':', $broker['max_leverage'])[1] : 500))*100) ?>% of retail CFD accounts lose money.</p>
            </div>
            <?php endif; ?>
        </div>

        <?php
        $shareUrl   = urlencode(url('brokers/' . $broker['slug']));
        $shareTitle = urlencode($broker['name'] . ' Review - Is it Safe? Spreads, Regulation & More');
        ?>
        <div class="rv-share">
            <span>Share this review:</span>
            <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>&amp;text=<?= $shareTitle ?>" target="_blank" rel="noopener" class="rv-share-btn" style="background:#1da1f2">Twitter</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $shareUrl ?>" target="_blank" rel="noopener" class="rv-share-btn" style="background:#0077b5">LinkedIn</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank" rel="noopener" class="rv-share-btn" style="background:#1877f2">Facebook</a>
            <a href="https://wa.me/?text=<?= $shareTitle ?>+<?= $shareUrl ?>" target="_blank" rel="noopener" class="rv-share-btn" style="background:#25d366">WhatsApp</a>
        </div>

        <a href="<?= url('advertise') ?>" class="advertise-here-hero" style="display:block" data-track="cta_click" data-track-label="advertise_broker_compare">
            <div class="adv-inner" style="padding:2.5rem 3rem">
                <div>
                    <div class="adv-tag">Advertise With Us</div>
                    <div class="adv-title">Reach Active Gulf Forex Traders</div>
                    <div class="adv-sub">The GCC's dedicated forex comparison platform - traders in UAE, Saudi Arabia, Kuwait &amp; Qatar comparing brokers every day. Premium placements available.</div>
                </div>
                <div class="adv-btn">Get a Quote &rarr;</div>
            </div>
        </a>
    </div>

</div><!-- .container -->
</div><!-- .rv-panels -->

<script>
(function () {
    var tabs   = Array.from(document.querySelectorAll('.rv-tab'));
    var panels = Array.from(document.querySelectorAll('.rv-panel'));

    function activate(id) {
        tabs.forEach(function (t) {
            var on = t.dataset.tab === id;
            t.classList.toggle('is-active', on);
            t.setAttribute('aria-selected', on ? 'true' : 'false');
        });
        panels.forEach(function (p) {
            p.classList.toggle('is-active', p.id === 'rvPanel-' + id);
        });
        history.replaceState(null, '', '#' + id);
        var activeTab = document.querySelector('.rv-tab.is-active');
        if (activeTab) activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activate(this.dataset.tab);
            var panelsEl = document.querySelector('.rv-panels');
            if (panelsEl) {
                var top = panelsEl.getBoundingClientRect().top + window.pageYOffset - 130;
                window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
            }
        });
    });

    function fromHash() {
        var h = window.location.hash.slice(1);
        if (h && document.getElementById('rvPanel-' + h)) activate(h);
    }
    fromHash();
    window.addEventListener('hashchange', fromHash);
}());
</script>

<?php
// ── BreadcrumbList ──────────────────────────────────────────────────
$breadcrumbSchema = [
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',    'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Brokers', 'item' => url('brokers')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $broker['name'] . ' Review', 'item' => url('brokers/' . $broker['slug'])],
    ],
];

// ── Review + FinancialService (drives AI Overview eligibility) ──────
$reviewSchema = [
    '@context'     => 'https://schema.org',
    '@type'        => 'Review',
    'datePublished'=> $broker['last_updated'] ? date('Y-m-d', strtotime($broker['last_updated'])) : date('Y-m-d'),
    'reviewRating' => [
        '@type'       => 'Rating',
        'ratingValue' => (string)$broker['overall_rating'],
        'bestRating'  => '5',
        'worstRating' => '1',
    ],
    'author' => [
        '@type' => 'Organization',
        'name'  => setting('site_name', 'Trader Gulf'),
        'url'   => url(),
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name'  => setting('site_name', 'Trader Gulf'),
        'url'   => url(),
    ],
    'itemReviewed' => [
        '@type'       => 'FinancialService',
        'name'        => $broker['name'],
        'description' => $broker['tagline'] ?? ($broker['name'] . ' forex broker review - spreads, regulation, platforms, and fees.'),
        'url'         => $broker['affiliate_url'] ?: url('brokers/' . $broker['slug']),
        'areaServed'  => 'Worldwide',
        'currenciesAccepted' => 'USD, EUR, GBP',
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => (string)$broker['overall_rating'],
            'bestRating'  => '5',
            'worstRating' => '1',
            'reviewCount' => '1',
        ],
    ],
];

// ── FAQPage - common questions AI Overviews love ───────────────────
$faqs = [
    ['q' => 'Is ' . $broker['name'] . ' regulated?',
     'a' => $broker['name'] . ' is regulated by ' . ($broker['regulation'] ?: 'multiple financial authorities') . '. Always verify regulatory status directly with the relevant authority before depositing funds.'],
    ['q' => 'What is the minimum deposit for ' . $broker['name'] . '?',
     'a' => 'The minimum deposit for ' . $broker['name'] . ' is $' . number_format((float)$broker['min_deposit']) . '.'],
    ['q' => 'What is the EUR/USD spread at ' . $broker['name'] . '?',
     'a' => $broker['name'] . ' offers a EUR/USD spread of ' . $broker['spread_eurusd'] . ' pips.'],
    ['q' => 'What is the maximum leverage at ' . $broker['name'] . '?',
     'a' => $broker['name'] . ' offers a maximum leverage of ' . ($broker['max_leverage'] ?: '1:500') . '.'],
    ['q' => 'Does ' . $broker['name'] . ' offer Islamic accounts?',
     'a' => $broker['has_islamic']
         ? $broker['name'] . ' offers Islamic (swap-free) accounts suitable for traders following Sharia law.'
         : $broker['name'] . ' does not currently offer Islamic swap-free accounts.'],
    ['q' => 'What trading platforms does ' . $broker['name'] . ' support?',
     'a' => $broker['name'] . ' supports ' . ($broker['platforms'] ?: 'MetaTrader 4, MetaTrader 5') . '.'],
];

$faqSchema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(fn($f) => [
        '@type'          => 'Question',
        'name'           => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faqs),
];
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($reviewSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<!-- FAQ accordion (visible Q&A boosts AIO/GAI signal alongside schema) -->
<section class="section" style="padding-top:0">
<div class="container">
    <h2 style="margin-bottom:1rem">Frequently Asked Questions about <?= e($broker['name']) ?></h2>
    <div class="faq-list">
    <?php foreach ($faqs as $faq): ?>
        <details class="faq-item">
            <summary class="faq-q"><?= e($faq['q']) ?></summary>
            <div class="faq-a"><?= e($faq['a']) ?></div>
        </details>
    <?php endforeach; ?>
    </div>
</div>
</section>
