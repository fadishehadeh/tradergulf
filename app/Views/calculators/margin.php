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

<div class="container" style="padding:1.5rem 0 2.5rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_margin_bottom">
        <div class="adv-inner" style="padding:2rem 2.5rem">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Calculating Their Margin</div><div class="adv-sub">Active Gulf traders managing leverage &amp; risk - UAE, KSA, Kuwait &amp; Qatar. High-intent, premium audience.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>
