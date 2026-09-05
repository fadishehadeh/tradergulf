<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Forex Profit & Loss Calculator',
    'description'         => 'Free forex profit and loss calculator. Estimate your potential profit or loss before entering a trade on any currency pair.',
    'url'                 => url('calculators/profit'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Profit and loss calculation, entry/exit price, lot size, all currency pairs',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',               'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Calculators',        'item' => url('calculators')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Profit Calculator',  'item' => url('calculators/profit')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('calculators') ?>">Calculators</a><span class="sep">›</span>
            <span><?= t('Profit Calculator') ?></span>
        </div>
        <h1><?= t('Profit & Loss Calculator') ?></h1>
        <p><?= t('Estimate your profit or loss before entering a trade.') ?></p>
    </div>
</div>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-profit-calculator.svg') ?>" alt="Profit Calculator" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('calculators/profit') ?>" class="banner-btn-link" aria-label="Open Profit Calculator"></a>
        </div>
    </div>
</div>

<div class="container">
<div class="calc-grid">

    <div class="calc-form">
        <div class="form-group">
            <label class="form-label"><?= t('Trade Direction') ?></label>
            <select class="form-control form-select" id="direction">
                <option value="buy">Buy (Long)</option>
                <option value="sell">Sell (Short)</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Lot Size') ?></label>
            <input type="number" class="form-control" id="lots" value="1" min="0.01" step="0.01">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Entry Price') ?></label>
            <input type="number" class="form-control" id="entry" value="1.0900" step="0.0001">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Exit Price') ?></label>
            <input type="number" class="form-control" id="exit" value="1.0950" step="0.0001">
        </div>
        <div class="form-group">
            <label class="form-label"><?= t('Pip Value (USD per standard lot)') ?></label>
            <input type="number" class="form-control" id="pipValue" value="10" step="0.01">
        </div>
        <button class="btn btn-primary btn-block" id="calcBtn"><?= t('Calculate') ?></button>
    </div>

    <div>
        <div class="calc-result" id="resultBox">
            <div class="calc-result-label"><?= t('Profit / Loss') ?></div>
            <div class="calc-result-value" id="plValue">-</div>
            <div class="calc-result-sub" id="plPips">-</div>
        </div>
        <div class="card card-body" style="margin-top:1.5rem;font-size:.88rem;color:var(--muted);line-height:1.8">
            <h4 style="color:var(--navy);margin-bottom:.75rem">Formula</h4>
            <p>Pips = |Exit − Entry| ÷ Pip Size</p>
            <p>P&L = Pips × Pip Value × Lots</p>
            <p>Direction determines profit vs loss: a Buy profits when exit &gt; entry.</p>
        </div>
    </div>

</div>
</div>

<?php $pageScripts = <<<'SCRIPT'
<script>
function calc() {
    const dir      = document.getElementById('direction').value;
    const lots     = parseFloat(document.getElementById('lots').value)    || 0;
    const entry    = parseFloat(document.getElementById('entry').value)   || 0;
    const exit     = parseFloat(document.getElementById('exit').value)    || 0;
    const pipValue = parseFloat(document.getElementById('pipValue').value)|| 10;

    const pipSize = (entry < 10) ? 0.0001 : 0.01;
    const rawDiff = (dir === 'buy') ? (exit - entry) : (entry - exit);
    const pips    = rawDiff / pipSize;
    const pl      = pips * pipValue * lots;

    const box = document.getElementById('resultBox');
    box.style.background = pl >= 0 ? 'var(--green)' : 'var(--red)';

    document.getElementById('plValue').textContent = (pl >= 0 ? '+' : '') + '$' + pl.toFixed(2);
    document.getElementById('plPips').textContent  = (pips >= 0 ? '+' : '') + pips.toFixed(1) + ' pips';
}

document.getElementById('calcBtn').addEventListener('click', calc);
['direction','lots','entry','exit','pipValue'].forEach(id => {
    document.getElementById(id).addEventListener('input', calc);
    document.getElementById(id).addEventListener('change', calc);
});
calc();
</script>
SCRIPT;
?>

<!-- Educational content - SEO body for "forex profit calculator" queries -->
<div class="container" style="padding:0 0 2rem">
<div style="max-width:820px;margin:0 auto">

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">How to Calculate Forex Profit and Loss</h2>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Your <strong>profit or loss</strong> on a forex trade is determined by three factors: the number of pips you captured, the pip value for the currency pair you traded, and how many lots you traded. Knowing your potential P&amp;L before entering a trade is essential for setting realistic take-profit levels and evaluating your risk-to-reward ratio.</p>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Professional Gulf traders target a minimum <strong>1:2 risk-to-reward ratio</strong> - meaning for every pip they risk (stop-loss), they aim to capture at least 2 pips of profit (take-profit). This ensures profitability even with a 40% win rate.</p>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Profit & Loss Formula</h2>
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:1rem 0;font-size:.9rem">
    <strong>Formula:</strong><br>
    <code style="font-size:.95rem;color:var(--accent)">P&amp;L = (Exit − Entry) ÷ Pip Size × Pip Value × Lots</code><br><br>
    <strong>Buy Example:</strong><br>
    Buy 1 lot EUR/USD &nbsp;·&nbsp; Entry: 1.0900 &nbsp;·&nbsp; Exit: 1.0950 &nbsp;·&nbsp; Pip value: $10<br>
    Pips gained = (1.0950 − 1.0900) ÷ 0.0001 = <strong>50 pips</strong><br>
    Profit = 50 × $10 × 1 = <strong>+$500</strong>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">P&L Examples by Lot Size (EUR/USD, 50-pip move)</h2>
<div style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:.875rem;margin-bottom:1rem">
    <thead>
        <tr style="background:var(--card);font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Lot Size</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Units</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Pip Value</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">50-pip Profit</th>
        </tr>
    </thead>
    <tbody>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">0.01 lots</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">1,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$0.10</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$5.00</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">0.10 lots</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">10,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$1.00</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$50.00</td></tr>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">0.50 lots</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">50,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">$5.00</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$250.00</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem">1.00 lot</td><td style="padding:.65rem 1rem">100,000</td><td style="padding:.65rem 1rem">$10.00</td><td style="padding:.65rem 1rem;font-weight:600">$500.00</td></tr>
    </tbody>
</table>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Frequently Asked Questions</h2>
<details class="faq-item"><summary class="faq-q">How is forex profit calculated?</summary><div class="faq-a">Forex profit is calculated by multiplying the number of pips gained by the pip value and lot size. For EUR/USD (pip value $10 per standard lot): if you buy 1 lot at 1.0900 and close at 1.0950, that is 50 pips profit = $500. For a sell trade, profit comes when the price moves down from your entry.</div></details>
<details class="faq-item"><summary class="faq-q">Does profit calculation differ for JPY pairs?</summary><div class="faq-a">Yes. For JPY pairs (USD/JPY, EUR/JPY, etc.), a pip is 0.01 instead of 0.0001, and the pip value in USD depends on the current exchange rate. The profit calculator automatically handles JPY pairs differently from standard major pairs.</div></details>
<details class="faq-item"><summary class="faq-q">What is a good risk-to-reward ratio in forex?</summary><div class="faq-a">A risk-to-reward ratio of 1:2 or better is considered professional. This means for every 20 pips you risk (stop-loss), you target at least 40 pips of profit (take-profit). At a 1:2 ratio, you only need to win 34% of your trades to break even - making consistent profitability achievable even without a high win rate.</div></details>

<?php
$faqProfit = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'How is forex profit calculated?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Forex profit is calculated by multiplying the number of pips gained by the pip value and lot size. For EUR/USD (pip value $10 per standard lot): buying 1 lot at 1.0900 and closing at 1.0950 gives 50 pips profit = $500.']],
        ['@type' => 'Question', 'name' => 'Does profit calculation differ for JPY pairs?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. For JPY pairs, a pip is 0.01 instead of 0.0001, and the pip value in USD depends on the current exchange rate. Always use the correct pip size for JPY pairs in your calculations.']],
        ['@type' => 'Question', 'name' => 'What is a good risk-to-reward ratio in forex?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'A risk-to-reward ratio of 1:2 or better is considered professional. At 1:2, you need to win only 34% of trades to break even - making consistent profitability achievable even without a high win rate.']],
    ],
];
echo '<script type="application/ld+json">' . json_encode($faqProfit, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

</div>
</div>

<div class="container" style="padding:1.5rem 0 2.5rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_profit_bottom">
        <div class="adv-inner" style="padding:2rem 2.5rem">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Estimating Their Profits</div><div class="adv-sub">Gulf traders actively planning trades across UAE, KSA &amp; GCC. Get your brand in front of them.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>
