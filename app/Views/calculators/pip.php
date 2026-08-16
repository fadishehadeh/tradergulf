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
            <div class="calc-result-value" id="pipValue">—</div>
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
    <a href="<?= url('advertise') ?>" class="advertise-here-sm" data-track="cta_click" data-track-label="advertise_pip_bottom">
        <div class="adv-inner">
            <div><div class="adv-tag">Advertisement</div><div class="adv-title">Advertise Here</div><div class="adv-sub">Reach active forex traders</div></div>
            <div class="adv-btn">Get In Touch →</div>
        </div>
    </a>
</div>
