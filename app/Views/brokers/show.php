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

        <!-- Row 1: logo + title + CTA -->
        <div class="rv-hero-top">
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
                    <?php if (!empty($broker['regulation'])): ?>
                    <div class="rv-reg-chips">
                        <?php foreach (array_slice(array_map('trim', preg_split('/[,\/]+/', $broker['regulation'])), 0, 5) as $reg): if (!$reg) continue; ?>
                        <span class="rv-reg-chip"><?= e($reg) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <p class="rv-hero-meta">
                        Updated <?= $broker['last_updated'] ? date('M j, Y', strtotime($broker['last_updated'])) : date('M Y') ?>
                        &nbsp;&middot;&nbsp;
                        Reviewed by <a href="<?= url('about') ?>" style="color:inherit;text-decoration:underline;text-underline-offset:2px">Trader Gulf Editorial Team</a>
                    </p>
                </div>
            </div>

            <?php if (!empty($broker['affiliate_url'])): ?>
            <div class="rv-hero-cta">
                <a href="<?= url('go/' . $broker['slug']) ?>"
                   class="btn btn-primary rv-cta-btn"
                   target="_blank" rel="nofollow noopener"
                   data-track="affiliate_click"
                   data-track-label="<?= e($broker['name']) ?>_hero">
                    Visit <?= e($broker['name']) ?> &rarr;
                </a>
                <p class="rv-hero-disclaimer">Capital at risk. Trading involves risk.</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Row 2: 4 prominent stat cards -->
        <div class="rv-stat-bar">
            <div class="rv-stat-card">
                <span class="rv-stat-card-icon">💵</span>
                <span class="rv-stat-card-val">$<?= e(number_format((float)$broker['min_deposit'])) ?></span>
                <span class="rv-stat-card-lbl">Min Deposit</span>
            </div>
            <div class="rv-stat-card">
                <span class="rv-stat-card-icon">📊</span>
                <span class="rv-stat-card-val"><?= e($broker['max_leverage']) ?></span>
                <span class="rv-stat-card-lbl">Max Leverage</span>
            </div>
            <div class="rv-stat-card">
                <span class="rv-stat-card-icon">📉</span>
                <span class="rv-stat-card-val"><?= e($broker['spread_eurusd']) ?> pips</span>
                <span class="rv-stat-card-lbl">EUR/USD Spread</span>
            </div>
            <div class="rv-stat-card <?= !empty($broker['has_islamic']) ? 'rv-stat-card--yes' : '' ?>">
                <span class="rv-stat-card-icon">🕌</span>
                <span class="rv-stat-card-val <?= !empty($broker['has_islamic']) ? 'rv-stat-yes' : 'rv-stat-no' ?>"><?= !empty($broker['has_islamic']) ? '✓ Yes' : '✗ No' ?></span>
                <span class="rv-stat-card-lbl">Islamic Account</span>
            </div>
        </div>
    </div>
</section>

<?php $__reviewTopAd = ad_zone('broker_review_top'); if ($__reviewTopAd): ?>
<div class="container" style="padding-top:1rem;padding-bottom:.25rem"><?= $__reviewTopAd ?></div>
<?php endif; ?>

<!-- ── Sidebar + Content ──────────────────────────────── -->
<div class="rv-body">
<div class="container rv-body-inner">

    <!-- Sticky vertical sidebar -->
    <aside class="rv-sidebar">
        <p class="rv-nav-label">In this review</p>
        <nav class="rv-nav" id="rvNav">
            <?php $first = true; foreach ($sections as $id => $label): ?>
            <a class="rv-nav-link<?= $first ? ' is-active' : '' ?>"
               href="#rv-<?= $id ?>"
               data-section="rv-<?= $id ?>">
                <span class="rv-nav-icon"><?= $sectionIcons[$id] ?? '' ?></span>
                <?= $label ?>
            </a>
            <?php $first = false; endforeach; ?>
        </nav>
    </aside>

    <!-- Stacked content -->
    <div class="rv-content">

        <!-- Overview -->
        <section class="rv-section" id="rv-overview">
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
        </section>

        <!-- Pros & Cons -->
        <section class="rv-section" id="rv-pros-cons">
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
        </section>

        <!-- Regulation -->
        <section class="rv-section" id="rv-regulation">
            <h2>Regulation &amp; Safety</h2>
            <?php if (!empty($broker['regulation_html'])): ?>
                <?= $broker['regulation_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> is regulated by: <strong><?= e($broker['regulation']) ?></strong>.</p>
            <p>Regulation provides a layer of protection for traders. Always verify a broker's regulatory status directly with the relevant authority before depositing funds.</p>
            <?php endif; ?>
        </section>

        <!-- Account Types -->
        <section class="rv-section" id="rv-account-types">
            <h2>Account Types</h2>
            <?php if (!empty($broker['account_types_html'])): ?>
                <?= $broker['account_types_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> offers a range of account types to suit different trading styles and experience levels. <?= !empty($broker['has_islamic']) ? 'Islamic swap-free accounts are available.' : '' ?> A demo account is <?= !empty($broker['has_demo']) ? 'available' : 'not available' ?> for practice.</p>
            <?php endif; ?>
        </section>

        <!-- Platforms -->
        <section class="rv-section" id="rv-platforms">
            <h2>Trading Platforms</h2>
            <?php if (!empty($broker['platforms_html'])): ?>
                <?= $broker['platforms_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> supports the following platforms: <strong><?= e($broker['platforms']) ?></strong>.</p>
            <?php endif; ?>
        </section>

        <!-- Spreads & Fees -->
        <section class="rv-section" id="rv-spreads">
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
        </section>

        <!-- Deposits & Withdrawals -->
        <section class="rv-section" id="rv-deposits">
            <h2>Deposits &amp; Withdrawals</h2>
            <?php if (!empty($broker['deposits_html'])): ?>
                <?= $broker['deposits_html'] ?>
            <?php else: ?>
            <p>Minimum deposit: <strong>$<?= e(number_format((float)$broker['min_deposit'])) ?></strong></p>
            <?php if (!empty($broker['deposit_methods'])): ?>
            <p>Accepted deposit methods: <strong><?= e($broker['deposit_methods']) ?></strong></p>
            <?php endif; ?>
            <?php endif; ?>
        </section>

        <!-- Customer Support -->
        <section class="rv-section" id="rv-support">
            <h2>Customer Support</h2>
            <?php if (!empty($broker['support_html'])): ?>
                <?= $broker['support_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> offers customer support via live chat, email, and telephone. Support availability and quality may vary by region.</p>
            <?php endif; ?>
        </section>

        <!-- Verdict -->
        <section class="rv-section" id="rv-verdict">
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
        </section>

    </div><!-- .rv-content -->
</div><!-- .rv-body-inner -->
</div><!-- .rv-body -->

<script>
(function () {
    var OFFSET = 80; /* nav 64px + 16px gap */
    var links    = Array.from(document.querySelectorAll('.rv-nav-link'));
    var sections = links.map(function (l) { return document.getElementById(l.dataset.section); }).filter(Boolean);

    /* Click: smooth scroll to section */
    links.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var el = document.getElementById(this.dataset.section);
            if (!el) return;
            var top = el.getBoundingClientRect().top + window.pageYOffset - OFFSET;
            window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
            history.replaceState(null, '', '#' + this.dataset.section.replace('rv-', ''));
        });
    });

    /* Scrollspy: highlight whichever section is at the top of the viewport */
    function setActive(id) {
        links.forEach(function (l) { l.classList.toggle('is-active', l.dataset.section === id); });
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) setActive(entry.target.id);
        });
    }, { rootMargin: '-' + OFFSET + 'px 0px -65% 0px', threshold: 0 });

    sections.forEach(function (s) { observer.observe(s); });

    /* Hash on load (support old #overview and new #rv-overview) */
    (function fromHash() {
        var h = window.location.hash.slice(1);
        if (!h) return;
        var el = document.getElementById('rv-' + h) || document.getElementById(h);
        if (el) setTimeout(function () {
            var top = el.getBoundingClientRect().top + window.pageYOffset - OFFSET;
            window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
        }, 120);
    }());
}());
</script>

<?php if (!empty($relatedBrokers)): ?>
<section style="background:var(--card);border-top:1px solid var(--border);padding:1.75rem 0">
    <div class="container">
        <p style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text-muted);margin:0 0 .9rem">Also compare</p>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap">
            <?php foreach ($relatedBrokers as $rb): ?>
            <a href="<?= url('brokers/' . e($rb['slug'])) ?>"
               style="display:flex;align-items:center;gap:.6rem;padding:.55rem .9rem;border:1px solid var(--border);border-radius:8px;text-decoration:none;color:var(--text-main);font-size:.875rem;font-weight:600;background:var(--bg);transition:border-color .15s,box-shadow .15s"
               onmouseover="this.style.borderColor='var(--accent)';this.style.boxShadow='0 0 0 2px rgba(245,158,11,.15)'"
               onmouseout="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
                <?php if (!empty($rb['logo'])): ?>
                <img src="<?= url('assets/img/brokers/' . e($rb['logo'])) ?>" alt="<?= e($rb['name']) ?>" loading="lazy" style="height:22px;width:auto;max-width:60px;object-fit:contain">
                <?php endif; ?>
                <?= e($rb['name']) ?> Review
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

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
        '@type' => 'Person',
        'name'  => 'Trader Gulf Editorial Team',
        'url'   => url('about'),
        'worksFor' => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
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
$brokerName = $broker['name'];
$faqs = [
    ['q' => 'Is ' . $brokerName . ' regulated?',
     'a' => $brokerName . ' is regulated by ' . ($broker['regulation'] ?: 'multiple financial authorities') . '. Always verify regulatory status directly with the relevant authority before depositing funds.'],
    ['q' => 'What is the minimum deposit for ' . $brokerName . '?',
     'a' => 'The minimum deposit for ' . $brokerName . ' is $' . number_format((float)$broker['min_deposit']) . '.'],
    ['q' => 'What are ' . $brokerName . '\'s fees and charges?',
     'a' => $brokerName . ' charges a EUR/USD spread from ' . $broker['spread_eurusd'] . ' pips with maximum leverage of ' . ($broker['max_leverage'] ?: '1:500') . '. See the Spreads & Fees section above for a full breakdown of trading costs, commissions, and any non-trading fees.'],
    ['q' => 'Does ' . $brokerName . ' charge an inactivity fee?',
     'a' => 'Please refer to the Spreads & Fees section of this review for details on ' . $brokerName . '\'s inactivity fee policy, including the fee amount and the period of inactivity that triggers the charge.'],
    ['q' => 'What is the EUR/USD spread at ' . $brokerName . '?',
     'a' => $brokerName . ' offers a EUR/USD spread from ' . $broker['spread_eurusd'] . ' pips. Spreads vary by account type - see the Spreads & Fees section for a full account-by-account breakdown.'],
    ['q' => 'What is the maximum leverage at ' . $brokerName . '?',
     'a' => $brokerName . ' offers a maximum leverage of ' . ($broker['max_leverage'] ?: '1:500') . '. Leverage limits vary depending on your country of residence and the instrument traded.'],
    ['q' => 'Does ' . $brokerName . ' offer Islamic accounts?',
     'a' => $broker['has_islamic']
         ? $brokerName . ' offers Islamic (swap-free) accounts, making it suitable for traders in the UAE, Saudi Arabia, Kuwait, and other Gulf countries who follow Sharia law. Islamic accounts replace overnight swap charges with an alternative fee structure.'
         : $brokerName . ' does not currently offer Islamic swap-free accounts. Gulf traders requiring a halal account should consider brokers such as Exness, XM, or IC Markets.'],
    ['q' => 'Is ' . $brokerName . ' available for traders in the UAE?',
     'a' => $brokerName . ' accepts traders from the United Arab Emirates. ' . ($broker['has_islamic'] ? 'Islamic swap-free accounts are available. ' : '') . 'Always confirm that the broker\'s regulatory entity covers UAE residents before opening an account.'],
    ['q' => 'What trading platforms does ' . $brokerName . ' support?',
     'a' => $brokerName . ' supports ' . ($broker['platforms'] ?: 'MetaTrader 4 (MT4) and MetaTrader 5 (MT5)') . ', available on desktop, web browser, and mobile apps for Android and iOS.'],
    ['q' => 'How do I withdraw money from ' . $brokerName . '?',
     'a' => $brokerName . ' processes withdrawal requests through the same payment method used for the deposit, as required by anti-money laundering regulations. See the Deposits & Withdrawals section for processing times and any applicable fees.'],
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
