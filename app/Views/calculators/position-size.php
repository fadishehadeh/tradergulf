<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Forex Position Size Calculator',
    'description'         => 'Free forex position size calculator. Calculate the correct lot size to risk a fixed percentage of your account on any currency pair.',
    'url'                 => url('calculators/position-size'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Position sizing, risk percentage management, lot size calculation, stop loss integration',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',                      'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Calculators',               'item' => url('calculators')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Position Size Calculator',  'item' => url('calculators/position-size')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('calculators') ?>">Calculators</a><span class="sep">›</span>
            <span><?= t('Position Size Calculator') ?></span>
        </div>
        <h1><?= t('Position Size Calculator') ?></h1>
        <p><?= t('Calculate the correct lot size to risk a fixed percentage of your account.') ?></p>
    </div>
</div>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-position-size.svg') ?>" alt="Position Size Calculator" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('calculators/position-size') ?>" class="banner-btn-link" aria-label="Open Position Size Calculator"></a>
        </div>
    </div>
</div>

<div class="container">
<div class="calc-grid">

    <div class="calc-form">
        <div class="form-group">
            <label class="form-label"><?= t('Account Balance (USD)') ?></label>
            <input type="number" class="form-control" id="balance" value="10000" min="1">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Risk Percentage (%)') ?></label>
            <input type="number" class="form-control" id="riskPct" value="1" min="0.1" max="100" step="0.1">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Stop Loss (pips)') ?></label>
            <input type="number" class="form-control" id="stopLoss" value="20" min="1">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Pip Value (USD per standard lot)') ?></label>
            <input type="number" class="form-control" id="pipValue" value="10" min="0.01" step="0.01" placeholder="e.g. 10 for EUR/USD">
        </div>
        <button class="btn btn-primary btn-block" id="calcBtn"><?= t('Calculate') ?></button>
    </div>

    <div>
        <div class="calc-result">
            <div class="calc-result-label"><?= t('Lot Size') ?></div>
            <div class="calc-result-value" id="lotSize">-</div>
            <div class="calc-result-sub" id="lotSub">standard lots</div>
        </div>
        <div class="calc-result" style="margin-top:1rem;background:var(--card);color:var(--text)">
            <div class="calc-result-label" style="color:var(--muted)">Amount at Risk</div>
            <div class="calc-result-value" id="riskAmount" style="color:var(--red)">-</div>
            <div class="calc-result-sub" style="color:var(--muted)">USD</div>
        </div>
        <div class="card card-body" style="margin-top:1.5rem;font-size:.88rem;color:var(--muted);line-height:1.8">
            <h4 style="color:var(--navy);margin-bottom:.75rem">Formula</h4>
            <p>Risk Amount = Balance × (Risk % ÷ 100)</p>
            <p>Lot Size = Risk Amount ÷ (Stop Loss × Pip Value)</p>
            <p>Risk no more than 1–2% of your account per trade.</p>
        </div>
    </div>

</div>
</div>

<?php $pageScripts = <<<'SCRIPT'
<script>
function calc() {
    const balance  = parseFloat(document.getElementById('balance').value)  || 0;
    const riskPct  = parseFloat(document.getElementById('riskPct').value)  || 0;
    const stopLoss = parseFloat(document.getElementById('stopLoss').value) || 1;
    const pipVal   = parseFloat(document.getElementById('pipValue').value) || 10;

    const riskAmt = balance * (riskPct / 100);
    const lots    = riskAmt / (stopLoss * pipVal);

    document.getElementById('lotSize').textContent   = lots.toFixed(2);
    document.getElementById('riskAmount').textContent = '$' + riskAmt.toFixed(2);
}

document.getElementById('calcBtn').addEventListener('click', calc);
['balance','riskPct','stopLoss','pipValue'].forEach(id => {
    document.getElementById(id).addEventListener('input', calc);
});
calc();
</script>
SCRIPT;
?>

<!-- Educational content - SEO body for "position size calculator" queries -->
<div class="container" style="padding:0 0 2rem">
<div style="max-width:820px;margin:0 auto">

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">What Is Position Sizing in Forex?</h2>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem"><strong>Position sizing</strong> is the process of calculating how many lots to trade so that a losing trade - stopped out at your predetermined stop-loss level - costs no more than your chosen risk amount. It is the single most important risk management discipline in forex trading.</p>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Professional traders in the UAE and Gulf region typically risk <strong>1–2% of their account</strong> per trade. This keeps any single loss small enough that a run of losing trades does not wipe the account.</p>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Position Size Formula</h2>
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:1rem 0;font-size:.9rem">
    <strong>Formula:</strong><br>
    <code style="font-size:.95rem;color:var(--accent)">Lots = Risk Amount ÷ (Stop-Loss in Pips × Pip Value per Lot)</code><br><br>
    <strong>Example:</strong><br>
    Account: $10,000 &nbsp;·&nbsp; Risk: 1% ($100) &nbsp;·&nbsp; Stop-loss: 50 pips &nbsp;·&nbsp; Pair: EUR/USD<br>
    Pip value on EUR/USD standard lot = $10<br>
    Lots = $100 ÷ (50 × $10) = <strong>0.20 lots</strong> (20,000 units)
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Position Size Examples by Account Size</h2>
<div style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:.875rem;margin-bottom:1rem">
    <thead>
        <tr style="background:var(--card);font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Account</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Risk 1%</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">50-pip SL on EUR/USD</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Position size</th>
        </tr>
    </thead>
    <tbody>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$1,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$10</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">50 pips</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">0.02 lots</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$5,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$50</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">50 pips</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">0.10 lots</td></tr>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$10,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$100</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">50 pips</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">0.20 lots</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem">$50,000</td><td style="padding:.65rem 1rem">$500</td><td style="padding:.65rem 1rem">50 pips</td><td style="padding:.65rem 1rem;font-weight:600">1.00 lot</td></tr>
    </tbody>
</table>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Frequently Asked Questions</h2>
<details class="faq-item"><summary class="faq-q">How much should I risk per forex trade?</summary><div class="faq-a">Most professional traders risk 1–2% of their account per trade. At 1% risk, you need 50 consecutive losing trades to lose half your account - which gives you enough runway to recover. Risking 5% or more per trade is considered high risk and common among traders who blow accounts.</div></details>
<details class="faq-item"><summary class="faq-q">What is a good position size for a $1,000 account?</summary><div class="faq-a">At 1% risk ($10) with a 50-pip stop-loss on EUR/USD, the correct position size is 0.02 lots (2,000 units). Many beginners trade 0.1 or 1 lot without calculating, risking 10–100 times more than they should.</div></details>
<details class="faq-item"><summary class="faq-q">Does position size change for different currency pairs?</summary><div class="faq-a">Yes. Pip value differs by pair, especially for JPY pairs where one pip = 0.01 instead of 0.0001. Always calculate using the correct pip value for the pair you are trading. Use the pip value calculator to find the right number before entering the position size formula.</div></details>

<?php
$faqSchema2 = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'How much should I risk per forex trade?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Most professional traders risk 1–2% of their account per trade. At 1% risk, you need 50 consecutive losing trades to lose half your account.']],
        ['@type' => 'Question', 'name' => 'What is a good position size for a $1,000 account?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'At 1% risk ($10) with a 50-pip stop-loss on EUR/USD, the correct position size is 0.02 lots (2,000 units).']],
        ['@type' => 'Question', 'name' => 'Does position size change for different currency pairs?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. Pip value differs by pair, especially for JPY pairs where one pip equals 0.01 instead of 0.0001. Always calculate using the correct pip value for the pair you are trading.']],
    ],
];
echo '<script type="application/ld+json">' . json_encode($faqSchema2, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

</div>
</div>

<div class="container" style="padding:1.5rem 0 2.5rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_position_bottom">
        <div class="adv-inner" style="padding:2rem 2.5rem">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Managing Their Risk</div><div class="adv-sub">Serious Gulf traders sizing positions - UAE, KSA &amp; GCC. They know their numbers. Do they know your brand?</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>
