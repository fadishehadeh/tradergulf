<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Forex Margin Calculator',
    'description'         => 'Free forex margin calculator. Calculate the margin required to open a leveraged position on any currency pair. Supports 1:30 to 1:2000 leverage.',
    'url'                 => url('calculators/margin'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Margin calculation, all leverage levels, all currency pairs, real-time results',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',              'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Calculators',       'item' => url('calculators')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Margin Calculator', 'item' => url('calculators/margin')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('calculators') ?>">Calculators</a><span class="sep">›</span>
            <span><?= t('Margin Calculator') ?></span>
        </div>
        <h1><?= t('Margin Calculator') ?></h1>
        <p><?= t('Calculate the margin required to open a leveraged position.') ?></p>
    </div>
</div>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-margin-calculator.svg') ?>" alt="Margin Calculator" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('calculators/margin') ?>" class="banner-btn-link" aria-label="Open Margin Calculator"></a>
        </div>
    </div>
</div>

<div class="container">
<div class="calc-grid">

    <div class="calc-form">
        <div class="form-group">
            <label class="form-label"><?= t('Currency Pair') ?></label>
            <select class="form-control form-select" id="pair">
                <option value="EURUSD">EUR/USD</option>
                <option value="GBPUSD">GBP/USD</option>
                <option value="USDJPY">USD/JPY</option>
                <option value="AUDUSD">AUD/USD</option>
                <option value="USDCAD">USD/CAD</option>
                <option value="XAUUSD">XAU/USD (Gold)</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Lot Size') ?></label>
            <input type="number" class="form-control" id="lots" value="1" min="0.01" step="0.01">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Leverage') ?></label>
            <select class="form-control form-select" id="leverage">
                <option value="500">1:500</option>
                <option value="400">1:400</option>
                <option value="200">1:200</option>
                <option value="100" selected>1:100</option>
                <option value="50">1:50</option>
                <option value="30">1:30</option>
                <option value="10">1:10</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Exchange Rate') ?></label>
            <input type="number" class="form-control" id="rate" value="1.09" min="0.001" step="0.0001">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Contract Size') ?></label>
            <select class="form-control form-select" id="contractSize">
                <option value="100000">Standard (100,000)</option>
                <option value="10000">Mini (10,000)</option>
                <option value="1000">Micro (1,000)</option>
            </select>
        </div>
        <button class="btn btn-primary btn-block" id="calcBtn"><?= t('Calculate') ?></button>
    </div>

    <div>
        <div class="calc-result">
            <div class="calc-result-label"><?= t('Required Margin') ?></div>
            <div class="calc-result-value" id="marginVal">-</div>
            <div class="calc-result-sub" id="marginSub">USD</div>
        </div>
        <div class="card card-body" style="margin-top:1.5rem;font-size:.88rem;color:var(--muted);line-height:1.8">
            <h4 style="color:var(--navy);margin-bottom:.75rem">Formula</h4>
            <p>Margin = (Lots × Contract Size × Exchange Rate) ÷ Leverage</p>
            <p>Higher leverage = lower margin required, but higher risk per pip.</p>
        </div>
    </div>

</div>
</div>

<?php $pageScripts = <<<'SCRIPT'
<script>
function calc() {
    const lots         = parseFloat(document.getElementById('lots').value) || 0;
    const leverage     = parseFloat(document.getElementById('leverage').value) || 100;
    const rate         = parseFloat(document.getElementById('rate').value) || 1;
    const contractSize = parseInt(document.getElementById('contractSize').value) || 100000;

    const margin = (lots * contractSize * rate) / leverage;
    document.getElementById('marginVal').textContent = '$' + margin.toFixed(2);
}

document.getElementById('calcBtn').addEventListener('click', calc);
['lots','leverage','rate','contractSize'].forEach(id => {
    document.getElementById(id).addEventListener('input', calc);
    document.getElementById(id).addEventListener('change', calc);
});
calc();
</script>
SCRIPT;
?>

<!-- Educational content — SEO body for "forex margin calculator" queries -->
<div class="container" style="padding:0 0 2rem">
<div style="max-width:820px;margin:0 auto">

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">What Is Forex Margin?</h2>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem"><strong>Margin</strong> is the amount of money your broker holds as collateral to keep a leveraged position open. It is not a fee — it is a deposit that is returned when you close the trade. The higher your leverage, the less margin you need to control a large position.</p>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">For example, trading 1 standard lot of EUR/USD (100,000 units) at 1:100 leverage requires just <strong>$1,090 in margin</strong> (at a rate of 1.09), instead of the full $109,000 notional value. Leverage amplifies both profits and losses equally.</p>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Margin Formula Explained</h2>
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:1rem 0;font-size:.9rem">
    <strong>Formula:</strong><br>
    <code style="font-size:.95rem;color:var(--accent)">Required Margin = (Lots × Contract Size × Exchange Rate) ÷ Leverage</code><br><br>
    <strong>Example:</strong><br>
    1 lot EUR/USD &nbsp;·&nbsp; Rate: 1.0900 &nbsp;·&nbsp; Leverage: 1:100 &nbsp;·&nbsp; Contract: 100,000<br>
    Margin = (1 × 100,000 × 1.09) ÷ 100 = <strong>$1,090.00</strong>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Required Margin by Leverage Level (1 lot EUR/USD at 1.09)</h2>
<div style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:.875rem;margin-bottom:1rem">
    <thead>
        <tr style="background:var(--card);font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Leverage</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Margin Required</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Margin %</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Typical Broker</th>
        </tr>
    </thead>
    <tbody>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">1:30</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$3,633</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">3.33%</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">FCA / CySEC retail</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">1:100</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$1,090</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">1.00%</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">Most offshore brokers</td></tr>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">1:200</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$545</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">0.50%</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">Exness, XM offshore</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem">1:500</td><td style="padding:.65rem 1rem;font-weight:600">$218</td><td style="padding:.65rem 1rem">0.20%</td><td style="padding:.65rem 1rem">IC Markets, Pepperstone</td></tr>
    </tbody>
</table>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Frequently Asked Questions</h2>
<details class="faq-item"><summary class="faq-q">What happens if my margin runs out?</summary><div class="faq-a">When your account equity falls below the broker's margin call level (typically 50–100% of required margin), your broker issues a margin call warning. If equity falls below the stop-out level (usually 20–50%), the broker automatically closes your positions starting with the largest losing trade. To avoid margin calls, never use more than 20–30% of your available margin at one time.</div></details>
<details class="faq-item"><summary class="faq-q">What is the difference between margin and leverage?</summary><div class="faq-a">Leverage is the ratio between your deposit and the position size you can control (e.g. 1:100 means $1 controls $100). Margin is the actual dollar amount your broker requires as collateral to open that position. Higher leverage means lower margin requirement — they are two sides of the same relationship.</div></details>
<details class="faq-item"><summary class="faq-q">How much margin do I need to trade 0.1 lots EUR/USD at 1:100?</summary><div class="faq-a">At 1:100 leverage and an exchange rate of 1.09, trading 0.1 lots (10,000 units) of EUR/USD requires $109 in margin. The formula is: (0.1 × 100,000 × 1.09) ÷ 100 = $109. Always check your broker's specific margin requirements, as they may differ for exotic pairs or during volatile market conditions.</div></details>

<?php
$faqMargin = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'What happens if my margin runs out?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'When your equity falls below the margin call level, your broker issues a warning. Below the stop-out level, they close your positions automatically starting with the largest losing trade. Never use more than 20–30% of your available margin at one time.']],
        ['@type' => 'Question', 'name' => 'What is the difference between margin and leverage?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Leverage is the ratio between your deposit and the position size you control (e.g. 1:100). Margin is the actual dollar amount your broker holds as collateral to open that position. Higher leverage means lower margin requirement.']],
        ['@type' => 'Question', 'name' => 'How much margin do I need to trade 0.1 lots EUR/USD at 1:100?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'At 1:100 leverage and an exchange rate of 1.09, trading 0.1 lots of EUR/USD requires $109 in margin. Formula: (0.1 × 100,000 × 1.09) ÷ 100 = $109.']],
    ],
];
echo '<script type="application/ld+json">' . json_encode($faqMargin, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

</div>
</div>

<div class="container" style="padding:1.5rem 0 2.5rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_margin_bottom">
        <div class="adv-inner" style="padding:2rem 2.5rem">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Calculating Their Margin</div><div class="adv-sub">Active Gulf traders managing leverage &amp; risk - UAE, KSA, Kuwait &amp; Qatar. High-intent, premium audience.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>
