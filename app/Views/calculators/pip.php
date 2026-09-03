<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Pip Value Calculator',
    'description'         => 'Free forex pip calculator. Calculate the value of one pip for any currency pair and lot size instantly. Supports all major and minor pairs.',
    'url'                 => url('calculators/pip'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Pip value calculation, all currency pairs, standard/mini/micro lot support',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',           'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Calculators',    'item' => url('calculators')],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Pip Calculator', 'item' => url('calculators/pip')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('calculators') ?>">Calculators</a><span class="sep">›</span>
            <span><?= t('Pip Calculator') ?></span>
        </div>
        <h1><?= t('Pip Calculator') ?></h1>
        <p><?= t('Calculate the value of one pip for any currency pair and lot size.') ?></p>
    </div>
</div>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-pip-calculator.svg') ?>" alt="Pip Calculator" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('calculators/pip') ?>" class="banner-btn-link" aria-label="Open Pip Calculator"></a>
        </div>
    </div>
</div>

<div class="container">
<div class="calc-grid">

    <div class="calc-form">
        <div class="form-group">
            <label class="form-label"><?= t('Currency Pair') ?></label>
            <select class="form-control form-select" id="pair">
                <optgroup label="Majors">
                    <option value="EURUSD" data-pip="0.0001" data-quote="USD" selected>EUR/USD</option>
                    <option value="GBPUSD" data-pip="0.0001" data-quote="USD">GBP/USD</option>
                    <option value="AUDUSD" data-pip="0.0001" data-quote="USD">AUD/USD</option>
                    <option value="NZDUSD" data-pip="0.0001" data-quote="USD">NZD/USD</option>
                    <option value="USDCHF" data-pip="0.0001" data-quote="CHF">USD/CHF</option>
                    <option value="USDCAD" data-pip="0.0001" data-quote="CAD">USD/CAD</option>
                    <option value="USDJPY" data-pip="0.01"   data-quote="JPY">USD/JPY</option>
                </optgroup>
                <optgroup label="Crosses">
                    <option value="EURJPY" data-pip="0.01"   data-quote="JPY">EUR/JPY</option>
                    <option value="GBPJPY" data-pip="0.01"   data-quote="JPY">GBP/JPY</option>
                    <option value="EURGBP" data-pip="0.0001" data-quote="GBP">EUR/GBP</option>
                    <option value="AUDCAD" data-pip="0.0001" data-quote="CAD">AUD/CAD</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label"><?= t('Lot Size') ?></label>
            <select class="form-control form-select" id="lotType">
                <option value="100000">Standard Lot (1.0)</option>
                <option value="10000">Mini Lot (0.1)</option>
                <option value="1000">Micro Lot (0.01)</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label"><?= t('Number of Lots') ?></label>
            <input type="number" class="form-control" id="lots" value="1" min="0.01" step="0.01">
        </div>

        <div class="form-group">
            <label class="form-label"><?= t('Exchange Rate (Quote/USD)') ?></label>
            <input type="number" class="form-control" id="exchangeRate" value="1.0" min="0.001" step="0.0001" placeholder="e.g. 1.0 for USD pairs">
        </div>

        <button class="btn btn-primary btn-block" id="calcBtn"><?= t('Calculate') ?></button>
    </div>

    <div>
        <div class="calc-result" id="result">
            <div class="calc-result-label"><?= t('Pip Value') ?></div>
            <div class="calc-result-value" id="pipValue">-</div>
            <div class="calc-result-sub" id="pipSub">per pip</div>
        </div>

        <div class="card card-body" style="margin-top:1.5rem;font-size:.88rem;color:var(--muted);line-height:1.8">
            <h4 style="color:var(--navy);margin-bottom:.75rem"><?= t('How it works') ?></h4>
            <p>Pip Value = (Pip Size × Lot Units) ÷ Exchange Rate</p>
            <p>For USD-quoted pairs (EUR/USD, GBP/USD), the pip value in USD is straightforward. For non-USD quote currencies (e.g. USD/JPY), divide by the current exchange rate.</p>
            <p>A standard lot on EUR/USD at 1.0000 = <strong>$10 per pip</strong>.</p>
        </div>
    </div>

</div>
</div>

<!-- Educational content — SEO body for "forex pip calculator" queries -->
<div class="container" style="padding:0 0 2.5rem">
<div style="max-width:820px;margin:0 auto">

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">What Is a Pip in Forex?</h2>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">A <strong>pip</strong> (percentage in point) is the smallest standardised price move in a currency pair. For most pairs, one pip equals <strong>0.0001</strong> — the fourth decimal place. For JPY pairs (USD/JPY, EUR/JPY), one pip equals <strong>0.01</strong>, the second decimal place, because the Japanese yen trades at a fundamentally different scale.</p>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Many brokers now quote prices to a fifth decimal place (0.00001) — this fractional unit is called a <strong>pipette</strong> or point, and equals one-tenth of a pip. Your broker's platform may display both.</p>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">How to Calculate Pip Value</h2>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Pip value depends on three things: the pip size for the pair, the lot size you are trading, and the current exchange rate if your account currency differs from the pair's quote currency.</p>
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:1.25rem 1.5rem;margin:1rem 0;font-size:.9rem">
    <strong>Formula:</strong><br>
    <code style="font-size:.95rem;color:var(--accent)">Pip Value = (Pip Size × Lot Size in Units) ÷ Exchange Rate</code><br><br>
    <strong>Example — EUR/USD standard lot (100,000 units):</strong><br>
    Pip Value = (0.0001 × 100,000) ÷ 1 = <strong>$10 per pip</strong><br><br>
    <strong>Example — USD/JPY standard lot at 150.00:</strong><br>
    Pip Value = (0.01 × 100,000) ÷ 150.00 = <strong>$6.67 per pip</strong>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Pip Value by Lot Size</h2>
<div style="overflow-x:auto">
<table style="width:100%;border-collapse:collapse;font-size:.875rem;margin-bottom:1rem">
    <thead>
        <tr style="background:var(--card);font-size:.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em">
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Lot Type</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Units</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">EUR/USD pip value</th>
            <th style="padding:.65rem 1rem;text-align:left;border-bottom:1px solid var(--border)">GBP/USD pip value</th>
        </tr>
    </thead>
    <tbody>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">Standard</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">100,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$10.00</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$10.00</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">Mini</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">10,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$1.00</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$1.00</td></tr>
        <tr><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">Micro</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border)">1,000</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$0.10</td><td style="padding:.65rem 1rem;border-bottom:1px solid var(--border);font-weight:600">$0.10</td></tr>
        <tr style="background:var(--card)"><td style="padding:.65rem 1rem">Nano</td><td style="padding:.65rem 1rem">100</td><td style="padding:.65rem 1rem;font-weight:600">$0.01</td><td style="padding:.65rem 1rem;font-weight:600">$0.01</td></tr>
    </tbody>
</table>
</div>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Why Pip Value Matters for Risk Management</h2>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Knowing your pip value before entering a trade is the foundation of position sizing. If you are risking 1% of a $10,000 account ($100) and your stop-loss is 50 pips on EUR/USD, you need a pip value of $100 ÷ 50 = $2 per pip — which means trading 0.2 standard lots (20,000 units).</p>
<p style="line-height:1.75;color:var(--text-muted);margin-bottom:.9rem">Without calculating pip value, traders in the UAE and Gulf region often over-leverage — risking far more capital per pip than their account can withstand. Use this calculator before every trade to confirm your exposure.</p>

<h2 style="font-size:1.25rem;font-weight:800;margin:2rem 0 1rem">Frequently Asked Questions</h2>
<details class="faq-item"><summary class="faq-q">How much is one pip in USD for EUR/USD?</summary><div class="faq-a">One pip on EUR/USD equals $10 for a standard lot (100,000 units), $1 for a mini lot (10,000 units), and $0.10 for a micro lot (1,000 units). These values assume a USD account and an EUR/USD rate close to 1.0000.</div></details>
<details class="faq-item"><summary class="faq-q">How do I calculate pip value for JPY pairs?</summary><div class="faq-a">For JPY pairs such as USD/JPY, one pip is 0.01 (not 0.0001). Use the formula: Pip Value = (0.01 × lot units) ÷ current USD/JPY rate. At 150.00, a standard lot gives a pip value of approximately $6.67.</div></details>
<details class="faq-item"><summary class="faq-q">What is a pipette?</summary><div class="faq-a">A pipette is one-tenth of a pip — the fifth decimal place on standard pairs (0.00001) or the third decimal place on JPY pairs. Many brokers quote prices at this level of precision. Ten pipettes equal one pip.</div></details>
<details class="faq-item"><summary class="faq-q">Does pip value change when the exchange rate changes?</summary><div class="faq-a">For pairs where the quote currency is not USD (e.g. EUR/GBP, USD/JPY), pip value changes as the exchange rate moves, because you are dividing by a changing rate. For USD-quoted pairs like EUR/USD and GBP/USD, the pip value is fixed in USD terms regardless of the rate.</div></details>

<?php
$faqSchema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'How much is one pip in USD for EUR/USD?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'One pip on EUR/USD equals $10 for a standard lot (100,000 units), $1 for a mini lot (10,000 units), and $0.10 for a micro lot (1,000 units).']],
        ['@type' => 'Question', 'name' => 'How do I calculate pip value for JPY pairs?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'For JPY pairs such as USD/JPY, one pip is 0.01. Use: Pip Value = (0.01 × lot units) ÷ current USD/JPY rate. At 150.00, a standard lot gives $6.67 per pip.']],
        ['@type' => 'Question', 'name' => 'What is a pipette?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'A pipette is one-tenth of a pip — the fifth decimal place on standard pairs. Ten pipettes equal one pip.']],
        ['@type' => 'Question', 'name' => 'Does pip value change when the exchange rate changes?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'For pairs where the quote currency is not USD (e.g. EUR/GBP, USD/JPY), pip value changes as the rate moves. For USD-quoted pairs like EUR/USD, the pip value is fixed in USD terms.']],
    ],
];
echo '<script type="application/ld+json">' . json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

</div>
</div>

<?php $pageScripts = <<<'SCRIPT'
<script>
document.getElementById('calcBtn').addEventListener('click', function() {
    const opt    = document.getElementById('pair').options[document.getElementById('pair').selectedIndex];
    const pip    = parseFloat(opt.dataset.pip);
    const units  = parseInt(document.getElementById('lotType').value);
    const lots   = parseFloat(document.getElementById('lots').value) || 1;
    const exRate = parseFloat(document.getElementById('exchangeRate').value) || 1;

    const pipValue = (pip * units * lots) / exRate;

    document.getElementById('pipValue').textContent = '$' + pipValue.toFixed(4);
    document.getElementById('pipSub').textContent   = 'per pip (' + (lots * units).toLocaleString() + ' units)';
});

// Auto-calculate on change
['pair','lotType','lots','exchangeRate'].forEach(id => {
    document.getElementById(id).addEventListener('change', () => document.getElementById('calcBtn').click());
    document.getElementById(id).addEventListener('input',  () => document.getElementById('calcBtn').click());
});

document.getElementById('calcBtn').click();
</script>
SCRIPT;
?>

<div class="container" style="padding:1.5rem 0 2.5rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_pip_bottom">
        <div class="adv-inner" style="padding:2rem 2.5rem">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Running Pip Calculations</div><div class="adv-sub">High-intent Gulf traders sizing trades in UAE, KSA &amp; GCC. They're ready to open - get in front of them.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>
