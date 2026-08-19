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
            <div class="calc-result-value" id="plValue">—</div>
            <div class="calc-result-sub" id="plPips">—</div>
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

<div class="container" style="padding:1.5rem 0 2.5rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_profit_bottom">
        <div class="adv-inner" style="padding:2rem 2.5rem">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Estimating Their Profits</div><div class="adv-sub">Gulf traders actively planning trades across UAE, KSA &amp; GCC. Get your brand in front of them.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>
