<?php
function renderStars(float $rating): string {
    $full  = floor($rating);
    $half  = ($rating - $full) >= 0.5 ? 1 : 0;
    $empty = 5 - $full - $half;
    return str_repeat('★', (int)$full) . ($half ? '½' : '') . str_repeat('☆', (int)$empty);
}

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
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a>
            <span class="sep">›</span>
            <a href="<?= url('brokers') ?>">Brokers</a>
            <span class="sep">›</span>
            <span><?= e($broker['name']) ?> Review</span>
        </div>
        <h1><?= e($broker['name']) ?> Review <?= date('Y') ?></h1>
        <p>Last updated: <?= $broker['last_updated'] ? date('F j, Y', strtotime($broker['last_updated'])) : date('F Y') ?></p>
    </div>
</div>

<?php $__reviewTopAd = ad_zone('broker_review_top'); if ($__reviewTopAd): ?>
<div class="container" style="padding-top:1rem"><?= $__reviewTopAd ?></div>
<?php endif; ?>

<div class="container">
<div class="review-layout">

    <!-- SIDEBAR -->
    <aside class="review-sidebar">
        <div class="review-broker-card">
            <div class="broker-logo-placeholder" style="margin:0 auto .75rem;width:130px;height:50px"><?= e($broker['name']) ?></div>
            <div class="review-score"><?= e($broker['overall_rating']) ?></div>
            <div class="review-stars"><?= renderStars((float)$broker['overall_rating']) ?></div>
            <p style="font-size:.8rem;color:var(--muted);margin-bottom:1.25rem">Overall Rating</p>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;text-align:center;margin-bottom:1.25rem">
                <div class="stat-box"><div class="stat-box-value">$<?= e(number_format((float)$broker['min_deposit'])) ?></div><div class="stat-box-label">Min Deposit</div></div>
                <div class="stat-box"><div class="stat-box-value"><?= e($broker['max_leverage']) ?></div><div class="stat-box-label">Max Leverage</div></div>
                <div class="stat-box"><div class="stat-box-value"><?= e($broker['spread_eurusd']) ?></div><div class="stat-box-label">EUR/USD Pips</div></div>
                <div class="stat-box"><div class="stat-box-value"><?= $broker['has_islamic'] ? '✓' : '✗' ?></div><div class="stat-box-label">Islamic Acct</div></div>
            </div>

            <?php if ($broker['affiliate_url']): ?>
            <a href="<?= url('go/' . $broker['slug']) ?>" class="btn btn-primary btn-block" target="_blank" rel="nofollow noopener"
               data-track="affiliate_click" data-track-label="<?= e($broker['name']) ?>_sidebar">
                Visit <?= e($broker['name']) ?>
            </a>
            <?php endif; ?>
            <p style="font-size:.72rem;color:var(--muted);margin-top:.5rem">Capital at risk. Trading involves risk.</p>
        </div>

        <nav class="review-toc">
            <h4>Jump to section</h4>
            <?php foreach ($sections as $id => $label): ?>
            <a href="#<?= $id ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </nav>

        <?php $__sidebarAd = ad_zone('broker_review_sidebar'); if ($__sidebarAd) echo $__sidebarAd; ?>
    </aside>

    <!-- REVIEW CONTENT -->
    <div class="review-content">

        <!-- Intro -->
        <?php if ($broker['intro_html']): ?>
        <div class="card card-body" style="margin-bottom:1.5rem;font-size:1.05rem;line-height:1.8">
            <?= $broker['intro_html'] ?>
        </div>
        <?php endif; ?>

        <!-- Overview -->
        <section id="overview">
            <h2>Overview</h2>
            <?php if ($broker['overview_html']): ?>
                <?= $broker['overview_html'] ?>
            <?php else: ?>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem">
                <div class="stat-box"><div class="stat-box-value"><?= e($broker['founded_year'] ?: '—') ?></div><div class="stat-box-label">Founded</div></div>
                <div class="stat-box"><div class="stat-box-value" style="font-size:1rem"><?= e($broker['headquarters'] ?: '—') ?></div><div class="stat-box-label">Headquarters</div></div>
                <div class="stat-box"><div class="stat-box-value" style="font-size:1rem"><?= e($broker['platforms'] ?: '—') ?></div><div class="stat-box-label">Platforms</div></div>
            </div>
            <?php endif; ?>
        </section>

        <!-- Pros & Cons -->
        <section id="pros-cons">
            <h2>Pros &amp; Cons</h2>
            <div class="pros-cons">
                <div>
                    <div class="pros-cons-header pros-header">✓ Pros</div>
                    <ul class="pros-list">
                        <?php foreach ($broker['pros'] as $pro): ?>
                        <li><?= e($pro) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <div class="pros-cons-header cons-header">✗ Cons</div>
                    <ul class="cons-list">
                        <?php foreach ($broker['cons'] as $con): ?>
                        <li><?= e($con) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Regulation -->
        <section id="regulation">
            <h2>Regulation &amp; Safety</h2>
            <?php if ($broker['regulation_html']): ?>
                <?= $broker['regulation_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> is regulated by: <strong><?= e($broker['regulation']) ?></strong>.</p>
            <p>Regulation provides a layer of protection for traders. Always verify a broker's regulatory status directly with the relevant authority before depositing funds.</p>
            <?php endif; ?>
        </section>

        <!-- Account Types -->
        <section id="account-types">
            <h2>Account Types</h2>
            <?php if ($broker['account_types_html']): ?>
                <?= $broker['account_types_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> offers a range of account types to suit different trading styles and experience levels. <?= $broker['has_islamic'] ? 'Islamic swap-free accounts are available.' : '' ?> A demo account is <?= $broker['has_demo'] ? 'available' : 'not available' ?> for practice.</p>
            <?php endif; ?>
        </section>

        <!-- Platforms -->
        <section id="platforms">
            <h2>Trading Platforms</h2>
            <?php if ($broker['platforms_html']): ?>
                <?= $broker['platforms_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> supports the following platforms: <strong><?= e($broker['platforms']) ?></strong>.</p>
            <?php endif; ?>
        </section>

        <!-- Spreads -->
        <section id="spreads">
            <h2>Spreads &amp; Fees</h2>
            <?php if ($broker['spreads_html']): ?>
                <?= $broker['spreads_html'] ?>
            <?php else: ?>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1rem">
                <div class="stat-box"><div class="stat-box-value"><?= e($broker['spread_eurusd']) ?> pips</div><div class="stat-box-label">EUR/USD Spread</div></div>
                <div class="stat-box"><div class="stat-box-value"><?= ucfirst($broker['spread_type'] ?? 'variable') ?></div><div class="stat-box-label">Spread Type</div></div>
                <div class="stat-box"><div class="stat-box-value">$<?= e(number_format((float)$broker['commission_per_lot'], 2)) ?></div><div class="stat-box-label">Commission/Lot</div></div>
            </div>
            <?php endif; ?>
        </section>

        <!-- Deposits -->
        <section id="deposits">
            <h2>Deposits &amp; Withdrawals</h2>
            <?php if ($broker['deposits_html']): ?>
                <?= $broker['deposits_html'] ?>
            <?php else: ?>
            <p>Minimum deposit: <strong>$<?= e(number_format((float)$broker['min_deposit'])) ?></strong></p>
            <?php if ($broker['deposit_methods']): ?>
            <p>Accepted deposit methods: <strong><?= e($broker['deposit_methods']) ?></strong></p>
            <?php endif; ?>
            <?php endif; ?>
        </section>

        <!-- Support -->
        <section id="support">
            <h2>Customer Support</h2>
            <?php if ($broker['support_html']): ?>
                <?= $broker['support_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> offers customer support via live chat, email, and telephone. Support availability and quality may vary by region.</p>
            <?php endif; ?>
        </section>

        <!-- Verdict -->
        <section id="verdict" style="border-left:4px solid var(--accent)">
            <h2>Our Verdict</h2>
            <?php if ($broker['verdict_html']): ?>
                <?= $broker['verdict_html'] ?>
            <?php else: ?>
            <p><?= e($broker['name']) ?> is a solid broker with competitive trading conditions. We recommend verifying all terms directly with the broker before opening an account.</p>
            <?php endif; ?>

            <?php if ($broker['affiliate_url']): ?>
            <div style="margin-top:1.5rem">
                <a href="<?= url('go/' . $broker['slug']) ?>" class="btn btn-primary" target="_blank" rel="nofollow noopener"
                   data-track="affiliate_click" data-track-label="<?= e($broker['name']) ?>_review_cta">
                    Open Account with <?= e($broker['name']) ?>
                </a>
                <p style="font-size:.75rem;color:var(--muted);margin-top:.5rem">Capital at risk. <?= (int)round((1/($broker['max_leverage'] ? (int)explode(':', $broker['max_leverage'])[1] : 500))*100) ?>% of retail CFD accounts lose money.</p>
            </div>
            <?php endif; ?>
        </section>

        <!-- Social Share -->
        <?php
        $shareUrl   = urlencode(url('brokers/' . $broker['slug']));
        $shareTitle = urlencode($broker['name'] . ' Review — Is it Safe? Spreads, Regulation & More');
        ?>
        <div style="margin-top:1.5rem;padding:1rem;background:var(--card-bg);border:1px solid var(--border);border-radius:10px;display:flex;align-items:center;gap:.65rem;flex-wrap:wrap">
            <span style="font-size:.82rem;color:var(--muted);font-weight:600">Share this review:</span>
            <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>&text=<?= $shareTitle ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#1da1f2;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">Twitter</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $shareUrl ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#0077b5;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">LinkedIn</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#1877f2;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">Facebook</a>
            <a href="https://wa.me/?text=<?= $shareTitle ?>+<?= $shareUrl ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#25d366;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">WhatsApp</a>
        </div>

        <!-- Related Brokers -->
        <?php if (!empty($relatedBrokers)): ?>
        <div style="margin-top:2rem">
            <h3 style="margin-bottom:1rem">Compare with Other Brokers</h3>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem">
            <?php foreach ($relatedBrokers as $rb): ?>
                <a href="<?= url('brokers/' . $rb['slug']) ?>" class="card card-body" style="text-align:center;text-decoration:none;color:var(--text)">
                    <div class="broker-logo-placeholder" style="margin:0 auto .5rem;width:90px;height:34px;font-size:.7rem"><?= e($rb['name']) ?></div>
                    <div style="font-weight:700;font-size:.9rem"><?= e($rb['name']) ?></div>
                    <div style="color:var(--accent);font-size:.85rem"><?= e($rb['overall_rating']) ?> / 5</div>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- .review-content -->
</div><!-- .review-layout -->
</div><!-- .container -->

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
        'description' => $broker['tagline'] ?? ($broker['name'] . ' forex broker review — spreads, regulation, platforms, and fees.'),
        'url'         => $broker['affiliate_url'] ?: url('brokers/' . $broker['slug']),
        'areaServed'  => 'Worldwide',
        'currenciesAccepted' => 'USD, EUR, GBP',
    ],
];

// ── FAQPage — common questions AI Overviews love ───────────────────
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
