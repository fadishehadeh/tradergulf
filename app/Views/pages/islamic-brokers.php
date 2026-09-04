<?php
$introHtml = $seoPage['intro_html'] ?? '';
$bodyHtml  = $seoPage['body_html'] ?? '';
?>

<?php
// BreadcrumbList schema
$bSchema = json_encode([
    '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>url()],
        ['@type'=>'ListItem','position'=>2,'name'=>'Islamic Forex Brokers','item'=>url('islamic-forex-brokers')],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
$headSchemas = ($headSchemas ?? '') . "<script type=\"application/ld+json\">$bSchema</script>";
?>

<!-- Hero -->
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)">Islamic Forex Brokers</span>
        </nav>
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.75rem;max-width:700px">
            <?= e($seoPage['h1'] ?? 'Best Islamic Forex Brokers 2025') ?>
        </h1>
        <?php if ($introHtml): ?>
        <div style="color:rgba(255,255,255,.75);max-width:680px;font-size:.95rem;line-height:1.65">
            <?= $introHtml ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-islamic-forex.svg') ?>" alt="Islamic Forex Brokers" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('islamic-forex-brokers') ?>" class="banner-btn-link" aria-label="View Islamic Forex Brokers"></a>
        </div>
    </div>
</div>

<!-- Advertise here slot -->
<div class="container" style="padding:.75rem 0">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_islamic_top">
        <div class="adv-inner">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Islamic Forex Traders in the GCC</div><div class="adv-sub">Traders seeking halal, swap-free accounts across UAE, Saudi Arabia, Kuwait &amp; Qatar. Niche, high-value audience.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>

<!-- Broker list -->
<section style="padding:2.5rem 0">
    <div class="container">
        <h2 style="font-size:1.2rem;margin-bottom:1.25rem">Top Islamic Forex Brokers</h2>

        <?php if (empty($brokers)): ?>
        <p style="color:var(--text-muted)">No Islamic brokers found. Check back soon.</p>
        <?php endif; ?>

        <?php foreach ($brokers as $b): ?>
        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1rem;display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap">

            <div style="flex:1;min-width:180px">
                <div style="font-size:1rem;font-weight:700;margin-bottom:.25rem">
                    <?= e($b['name']) ?>
                    <span style="font-size:.7rem;background:rgba(52,211,153,.12);color:var(--accent);padding:.15rem .45rem;border-radius:4px;font-weight:600;margin-left:.4rem">☪ Islamic</span>
                </div>
                <div style="font-size:.8rem;color:var(--text-muted)">
                    Min deposit: $<?= e($b['min_deposit'] ?? '-') ?> &nbsp;·&nbsp;
                    Leverage: <?= e($b['max_leverage'] ?? '-') ?> &nbsp;·&nbsp;
                    <?= e($b['regulation'] ?? '') ?>
                </div>
            </div>

            <div style="display:flex;gap:.6rem;flex-wrap:wrap;justify-content:flex-end">
                <a href="<?= url('brokers/' . e($b['slug'])) ?>"
                   style="padding:.5rem 1rem;border:1px solid var(--border);border-radius:7px;font-size:.82rem;font-weight:600;color:var(--text-main);text-decoration:none">
                    Read Review
                </a>
                <?php if (!empty($b['affiliate_url'])): ?>
                <a href="<?= url('go/' . $b['slug']) ?>" target="_blank" rel="noopener sponsored"
                   style="padding:.5rem 1.1rem;background:var(--accent);border:none;border-radius:7px;font-size:.82rem;font-weight:700;color:var(--navy-dark);text-decoration:none">
                    Open Account
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Body content -->
<section style="padding:0 0 2rem">
    <div class="container" style="max-width:800px">
        <?php if ($bodyHtml): ?>
        <div style="line-height:1.75;color:var(--text-muted);font-size:.92rem">
            <?= $bodyHtml ?>
        </div>
        <?php else: ?>
        <h2 style="font-size:1.2rem;font-weight:800;margin:0 0 1rem">What Is an Islamic Forex Account?</h2>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">An <strong>Islamic forex account</strong>, also called a swap-free account, is a trading account that complies with Sharia law by eliminating overnight interest (swap) charges. In conventional forex trading, holding a position overnight incurs a rollover fee — this constitutes <em>riba</em> (interest), which is prohibited in Islam. Islamic accounts remove this charge entirely, making forex trading accessible to Muslim traders across the UAE, Saudi Arabia, Kuwait, Qatar, and the wider GCC.</p>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">All brokers listed on this page have been verified to offer genuine Islamic swap-free accounts. Trader Gulf reviews each broker's Islamic account terms independently — some brokers charge alternative "administration fees" in place of swaps, which effectively recreates the interest charge. We only list brokers whose Islamic accounts are genuinely swap-free and Sharia-compliant.</p>

        <h2 style="font-size:1.2rem;font-weight:800;margin:1.5rem 0 1rem">How to Choose the Best Islamic Forex Broker</h2>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">When comparing Islamic forex brokers, look beyond just the swap-free label. Key criteria include:</p>
        <ul style="line-height:1.9;color:var(--text-muted);font-size:.92rem;margin:.5rem 0 1rem 1.25rem">
            <li><strong>No hidden administration fees</strong> — some brokers charge daily admin fees on Islamic accounts that replicate the swap charge</li>
            <li><strong>Strong regulation</strong> — FCA, ASIC, and CySEC-regulated brokers provide the strongest client protection</li>
            <li><strong>Arabic-language support</strong> — essential for Gulf traders who need customer service in their language</li>
            <li><strong>Local payment methods</strong> — AED, SAR, KWD bank wire and local Visa/Mastercard support</li>
            <li><strong>Low minimum deposit</strong> — accessible starting amounts ($1–$200) are important for newer traders</li>
        </ul>

        <h2 style="font-size:1.2rem;font-weight:800;margin:1.5rem 0 1rem">Frequently Asked Questions</h2>
        <details class="faq-item"><summary class="faq-q">Are Islamic forex accounts truly halal?</summary><div class="faq-a">Genuine Islamic swap-free accounts — where overnight interest is eliminated with no replacement fee — are considered permissible by most Islamic finance scholars. However, some brokers charge "administration fees" that effectively recreate the swap charge. Always verify with the broker that their Islamic account has no hidden overnight charges, and consult your own Islamic finance advisor for a ruling on your specific situation.</div></details>
        <details class="faq-item"><summary class="faq-q">Which broker has the best Islamic account for Gulf traders?</summary><div class="faq-a">Exness and XM are widely regarded as offering the best Islamic swap-free accounts for Gulf traders. Both provide genuinely swap-free trading with no administration fees replacing the swap, across all major currency pairs. IC Markets and Pepperstone also offer competitive Islamic accounts. All are reviewed in full on Trader Gulf.</div></details>
        <details class="faq-item"><summary class="faq-q">Is there a difference in spreads on Islamic accounts?</summary><div class="faq-a">Most brokers maintain the same spreads on Islamic accounts as on standard accounts. A small number of brokers widen spreads slightly on Islamic accounts to offset the loss of swap revenue — this is disclosed in their account terms. Always compare the spread schedule for Islamic vs standard accounts before opening.</div></details>
        <details class="faq-item"><summary class="faq-q">Can expats in the UAE or Saudi Arabia open Islamic accounts?</summary><div class="faq-a">Yes. Islamic swap-free accounts are available to any trader who requests them — they are not restricted to Muslim traders or residents of Muslim-majority countries. Any trader in the UAE, Saudi Arabia, Kuwait, or anywhere globally can request an Islamic account from the brokers listed on this page.</div></details>

        <?php
        $islamicFaqSchema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Are Islamic forex accounts truly halal?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Genuine Islamic swap-free accounts where overnight interest is eliminated with no replacement fee are considered permissible by most Islamic finance scholars. Always verify the broker charges no hidden administration fees in place of swaps.']],
                ['@type' => 'Question', 'name' => 'Which broker has the best Islamic account for Gulf traders?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Exness and XM are widely regarded as offering the best Islamic swap-free accounts for Gulf traders, with genuinely swap-free trading and no administration fees. IC Markets and Pepperstone also offer competitive Islamic accounts.']],
                ['@type' => 'Question', 'name' => 'Is there a difference in spreads on Islamic accounts?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Most brokers maintain the same spreads on Islamic accounts as on standard accounts. A small number widen spreads slightly — check the spread schedule for Islamic vs standard accounts before opening.']],
                ['@type' => 'Question', 'name' => 'Can expats in the UAE or Saudi Arabia open Islamic accounts?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. Islamic swap-free accounts are available to any trader who requests them and are not restricted to Muslim traders or specific countries. Any trader in the UAE, Saudi Arabia, Kuwait, or anywhere globally can request one.']],
            ],
        ];
        $headSchemas = ($headSchemas ?? '') . '<script type="application/ld+json">' . json_encode($islamicFaqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
        ?>
        <?php endif; ?>
    </div>
</section>

<!-- FAQ -->
<?php if (!empty($faqs)): ?>
<section style="padding:0 0 3rem">
    <div class="container" style="max-width:800px">
        <h2 style="font-size:1.25rem;margin-bottom:1.25rem">Frequently Asked Questions</h2>
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
<?php endif; ?>
