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
            <div class="calc-result-value" id="marginVal">—</div>
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
    <a href="<?= url('advertise') ?>" class="advertise-here-sm" data-track="cta_click" data-track-label="advertise_margin_bottom">
        <div class="adv-inner">
            <div><div class="adv-tag">Advertisement</div><div class="adv-title">Advertise Here</div><div class="adv-sub">Reach active forex traders — contact fshehadeh@gmail.com</div></div>
            <div class="adv-btn">Get In Touch →</div>
        </div>
    </a>
</div>
