<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Forex Broker Comparison Tool',
    'description'         => 'Compare up to 4 forex brokers side-by-side. Compare spreads, leverage, regulation, minimum deposit, platforms, and more. Free broker comparison tool.',
    'url'                 => url('compare'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Side-by-side broker comparison, spreads, leverage, regulation, Islamic accounts, platforms',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',                    'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Compare Forex Brokers',   'item' => url('compare')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <h1><?= t('Compare Forex Brokers') ?></h1>
        <p><?= t('Select up to 4 brokers to compare side-by-side.') ?></p>
    </div>
</div>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-compare-brokers.svg') ?>" alt="Compare Forex Brokers" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('compare') ?>" class="banner-btn-link" aria-label="Compare Forex Brokers"></a>
        </div>
    </div>
</div>

<div class="container">

    <div style="padding:.5rem 0 1.25rem">
        <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_compare_top">
            <div class="adv-inner">
                <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders in Decision Mode</div><div class="adv-sub">These traders are actively comparing brokers side-by-side - highest buying intent in the Gulf market.</div></div>
                <div class="adv-btn">Get a Quote →</div>
            </div>
        </a>
    </div>

    <div class="card card-body" style="margin-bottom:2rem">
        <div class="compare-selectors">
            <?php for ($i = 1; $i <= 4; $i++): ?>
            <div>
                <label style="display:block;font-size:.8rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.4rem">Broker <?= $i ?></label>
                <select class="compare-select broker-selector" data-slot="<?= $i ?>">
                    <option value=""><?= t('- Select broker -') ?></option>
                    <?php foreach ($allBrokers as $b): ?>
                    <option value="<?= e($b['slug']) ?>"><?= e($b['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endfor; ?>
        </div>

        <div style="text-align:center">
            <button id="compareBtn" class="btn btn-primary"><?= t('Compare Now') ?></button>
            <button id="clearBtn" class="btn btn-ghost btn-sm" style="margin-left:.75rem"><?= t('Clear') ?></button>
        </div>
    </div>

    <div id="compare-table-wrap">
        <div class="compare-placeholder" id="comparePlaceholder">
            <div style="font-size:2rem;margin-bottom:.75rem">⚖️</div>
            <p>Select at least 2 brokers above and click <strong>Compare Now</strong>.</p>
        </div>
        <table class="compare-table" id="compareTable" style="display:none">
            <thead id="compareHead"></thead>
            <tbody id="compareBody"></tbody>
        </table>
    </div>

</div>

<?php $pageScripts = '<script>const GO_BASE=' . json_encode(url('go/')) . ';</script>'; ?>
<?php $pageScripts .= <<<'SCRIPT'
<script>
const BASE = document.querySelector('script[data-base]')?.dataset.base || window.location.origin;
const API  = document.currentScript ? '' : '';

const ROWS = [
    { key: 'overall_rating',     label: 'Overall Rating',       fmt: v => v + ' / 5' },
    { key: 'regulation',         label: 'Regulation'            },
    { key: 'founded_year',       label: 'Founded'               },
    { key: 'headquarters',       label: 'Headquarters'          },
    { key: 'min_deposit',        label: 'Min Deposit',          fmt: v => '$' + parseFloat(v).toLocaleString() },
    { key: 'max_leverage',       label: 'Max Leverage'          },
    { key: 'spread_eurusd',      label: 'EUR/USD Spread',       fmt: v => v + ' pips' },
    { key: 'spread_type',        label: 'Spread Type',          fmt: v => v.charAt(0).toUpperCase() + v.slice(1) },
    { key: 'commission_per_lot', label: 'Commission / Lot',     fmt: v => parseFloat(v) === 0 ? 'Free' : '$' + parseFloat(v).toFixed(2) },
    { key: 'platforms',          label: 'Platforms'             },
    { key: 'has_islamic',        label: 'Islamic Account',      fmt: v => v == 1 ? '<span class="tick">✓ Yes</span>' : '<span class="cross">✗ No</span>', raw: true },
    { key: 'has_copy_trading',   label: 'Copy Trading',         fmt: v => v == 1 ? '<span class="tick">✓ Yes</span>' : '<span class="cross">✗ No</span>', raw: true },
    { key: 'has_demo',           label: 'Demo Account',         fmt: v => v == 1 ? '<span class="tick">✓ Yes</span>' : '<span class="cross">✗ No</span>', raw: true },
    { key: 'deposit_methods',    label: 'Deposit Methods'       },
    { key: 'base_currencies',    label: 'Base Currencies'       },
];

function getSelectedSlugs() {
    return [...document.querySelectorAll('.broker-selector')]
        .map(s => s.value).filter(Boolean);
}

function escHtml(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function buildTable(brokers) {
    const head = document.getElementById('compareHead');
    const body = document.getElementById('compareBody');

    let th = '<tr><th class="row-label">Metric</th>';
    brokers.forEach(b => {
        th += `<th>
            <div style="font-size:.95rem;margin-bottom:.25rem">${escHtml(b.name)}</div>
            <div style="color:var(--accent);font-size:.85rem">★ ${b.overall_rating}</div>
            ${b.affiliate_url ? `<a href="${GO_BASE}${escHtml(b.slug)}" class="btn btn-primary btn-sm" style="margin-top:.5rem" target="_blank" rel="nofollow noopener">Visit</a>` : ''}
        </th>`;
    });
    th += '</tr>';
    head.innerHTML = th;

    let rows = '';
    ROWS.forEach(row => {
        rows += `<tr><td class="row-label">${row.label}</td>`;
        brokers.forEach(b => {
            let val = b[row.key];
            if (val === null || val === undefined || val === '') val = '-';
            let display = row.fmt ? row.fmt(val) : escHtml(String(val));
            rows += row.raw ? `<td>${display}</td>` : `<td>${escHtml(row.fmt ? row.fmt(val) : String(val))}</td>`;
        });
        rows += '</tr>';
    });

    // CTA row
    rows += '<tr><td class="row-label">Review</td>';
    brokers.forEach(b => {
        rows += `<td><a href="${escHtml(window.location.origin + window.location.pathname.replace('compare', 'brokers/' + b.slug))}" class="btn btn-ghost btn-sm">Read Review</a></td>`;
    });
    rows += '</tr>';

    body.innerHTML = rows;
}

document.getElementById('compareBtn').addEventListener('click', async function() {
    const slugs = getSelectedSlugs();
    if (slugs.length < 2) { alert('Please select at least 2 brokers.'); return; }

    this.textContent = 'Loading…';
    this.disabled = true;

    try {
        const url = window.location.pathname.replace(/\/?$/, '') + '/data?brokers=' + slugs.join(',');
        const resp = await fetch(url);
        const data = await resp.json();

        if (!Array.isArray(data) || data.length === 0) throw new Error('No data');

        buildTable(data);
        document.getElementById('comparePlaceholder').style.display = 'none';
        document.getElementById('compareTable').style.display = '';
    } catch(e) {
        alert('Failed to load comparison data. Please try again.');
    } finally {
        this.textContent = 'Compare Now';
        this.disabled = false;
    }
});

document.getElementById('clearBtn').addEventListener('click', function() {
    document.querySelectorAll('.broker-selector').forEach(s => s.value = '');
    document.getElementById('compareTable').style.display = 'none';
    document.getElementById('comparePlaceholder').style.display = '';
});
</script>
SCRIPT;
?>
