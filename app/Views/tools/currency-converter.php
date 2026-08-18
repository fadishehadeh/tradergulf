<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Currency Converter — Live Exchange Rates',
    'description'         => 'Convert between 150+ currencies with live mid-market rates from the European Central Bank, updated daily. Free online tool for AED, SAR, USD, EUR, GBP, and more.',
    'url'                 => url('currency-converter'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Live ECB exchange rates, 150+ currency pairs, AED SAR USD EUR GBP conversion',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',               'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Currency Converter', 'item' => url('currency-converter')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<!-- Currency Converter -->
<section class="tool-hero">
    <div class="container">
        <h1>Currency Converter — Live Exchange Rates</h1>
        <p>Convert between 150+ currencies with live mid-market rates from the European Central Bank, updated daily.</p>
    </div>
</section>

<div class="container" style="padding:.75rem 0 0">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_converter_top">
        <div class="adv-inner">
            <div><div class="adv-tag">Advertisement</div><div class="adv-title">Advertise With Trader Gulf</div><div class="adv-sub">Reach active forex traders across the Gulf &amp; MENA region</div></div>
            <div class="adv-btn">Get In Touch →</div>
        </div>
    </a>
</div>

<section style="padding:0 0 3rem">
    <div class="container">
        <div class="converter-card">
            <div class="converter-row">
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.4rem;color:var(--text-muted)">Amount</label>
                    <input type="number" id="ccAmount" value="1" min="0" step="any"
                           style="width:100%;padding:.65rem .9rem;border:1px solid var(--border);border-radius:7px;font-size:1.1rem;background:var(--card-bg);color:var(--text-main);outline:none">
                </div>
                <button class="converter-swap-btn" id="ccSwap" title="Swap currencies">&#8644;</button>
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.4rem;color:var(--text-muted)">Result</label>
                    <div class="converter-result" id="ccResult">—</div>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem">
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.4rem;color:var(--text-muted)">From</label>
                    <select id="ccFrom" style="width:100%;padding:.65rem .9rem;border:1px solid var(--border);border-radius:7px;font-size:.95rem;background:var(--card-bg);color:var(--text-main)"></select>
                </div>
                <div>
                    <label style="display:block;font-size:.82rem;font-weight:600;margin-bottom:.4rem;color:var(--text-muted)">To</label>
                    <select id="ccTo" style="width:100%;padding:.65rem .9rem;border:1px solid var(--border);border-radius:7px;font-size:.95rem;background:var(--card-bg);color:var(--text-main)"></select>
                </div>
            </div>

            <div id="ccRateInfo" style="font-size:.8rem;color:var(--text-muted);text-align:center"></div>
        </div>

        <!-- Popular pairs quick-pick -->
        <div style="max-width:640px;margin:0 auto 2rem">
            <p style="font-size:.85rem;font-weight:600;color:var(--text-muted);margin-bottom:.6rem">Popular pairs:</p>
            <div style="display:flex;flex-wrap:wrap;gap:.4rem" id="ccQuickPairs"></div>
        </div>

        <!-- Info boxes -->
        <div style="max-width:640px;margin:0 auto">
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem;margin-bottom:1rem">
                <h3 style="font-size:.95rem;margin-bottom:.5rem">About This Converter</h3>
                <p style="font-size:.84rem;color:var(--text-muted);line-height:1.6">Rates are sourced from the <strong>Frankfurter.app API</strong>, which uses the European Central Bank (ECB) daily reference rates. Rates update on ECB publication days (Monday–Friday, ~16:00 CET). These are mid-market rates and do not include broker spreads or fees.</p>
            </div>
            <div style="background:rgba(255,193,7,.06);border:1px solid rgba(255,193,7,.2);border-radius:10px;padding:1rem">
                <p style="font-size:.82rem;color:var(--text-muted)"><strong>Note:</strong> For actual trading rates, check directly with your forex broker as spreads and fees apply. This tool is for informational purposes only.</p>
            </div>
        </div>
    </div>
</section>

<?php $pageScripts = <<<'JS'
<script>
(function() {
    var POPULAR = [
        ['USD','AED'],['USD','SAR'],['EUR','USD'],['GBP','USD'],
        ['USD','JPY'],['USD','KWD'],['EUR','AED'],['GBP','AED']
    ];
    var rates = {}, base = 'EUR', from = 'USD', to = 'AED';
    var amtEl = document.getElementById('ccAmount');
    var fromEl = document.getElementById('ccFrom');
    var toEl   = document.getElementById('ccTo');
    var resEl  = document.getElementById('ccResult');
    var infoEl = document.getElementById('ccRateInfo');
    var pairsEl= document.getElementById('ccQuickPairs');

    function buildOptions(sel, selected) {
        Object.keys(rates).concat(['EUR']).sort().forEach(function(c) {
            var o = document.createElement('option');
            o.value = c; o.textContent = c;
            if (c === selected) o.selected = true;
            sel.appendChild(o);
        });
    }

    function convert() {
        var amt = parseFloat(amtEl.value) || 0;
        var f = fromEl.value, t2 = toEl.value;
        var inEUR_f = f === 'EUR' ? 1 : (rates[f] ? 1/rates[f] : null);
        var inEUR_t = t2 === 'EUR' ? 1 : (rates[t2] ? 1/rates[t2] : null);
        if (!inEUR_f || !inEUR_t) { resEl.textContent = '—'; return; }
        var result = amt * inEUR_f / inEUR_t;
        resEl.textContent = result.toLocaleString(undefined, {minimumFractionDigits:2,maximumFractionDigits:6}) + ' ' + t2;
        var rate1 = 1 * inEUR_f / inEUR_t;
        infoEl.textContent = '1 ' + f + ' = ' + rate1.toFixed(6) + ' ' + t2 + ' · ECB reference rate';
    }

    function buildQuickPairs() {
        POPULAR.forEach(function(pair) {
            var btn = document.createElement('button');
            btn.textContent = pair[0]+'/'+pair[1];
            btn.style.cssText='padding:.28rem .7rem;font-size:.78rem;border:1px solid var(--border);border-radius:5px;background:var(--card-bg);color:var(--text-muted);cursor:pointer';
            btn.addEventListener('click', function() {
                fromEl.value = pair[0]; toEl.value = pair[1]; convert();
            });
            pairsEl.appendChild(btn);
        });
    }

    fetch('/api/currency-rates')
        .then(function(r){ return r.json(); })
        .then(function(d) {
            rates = d.rates;
            buildOptions(fromEl, from);
            buildOptions(toEl, to);
            buildQuickPairs();
            convert();
        })
        .catch(function() { resEl.textContent = 'API unavailable'; });

    amtEl.addEventListener('input', convert);
    fromEl.addEventListener('change', convert);
    toEl.addEventListener('change', convert);
    document.getElementById('ccSwap').addEventListener('click', function() {
        var tmp = fromEl.value; fromEl.value = toEl.value; toEl.value = tmp; convert();
    });
})();
</script>
JS;
?>
