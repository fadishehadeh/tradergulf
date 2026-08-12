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
            <div class="calc-result-value" id="lotSize">—</div>
            <div class="calc-result-sub" id="lotSub">standard lots</div>
        </div>
        <div class="calc-result" style="margin-top:1rem;background:var(--card);color:var(--text)">
            <div class="calc-result-label" style="color:var(--muted)">Amount at Risk</div>
            <div class="calc-result-value" id="riskAmount" style="color:var(--red)">—</div>
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
