<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'            => 'https://schema.org',
    '@type'               => 'WebApplication',
    'name'                => 'Forex Economic Calendar',
    'description'         => 'Live economic events calendar with high-impact data releases, central bank decisions, and market-moving announcements. Track NFP, FOMC, CPI, and more.',
    'url'                 => url('economic-calendar'),
    'applicationCategory' => 'FinanceApplication',
    'operatingSystem'     => 'Web',
    'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
    'featureList'         => 'Live economic events, NFP FOMC CPI releases, central bank decisions, high-impact forex calendar',
    'provider'            => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',               'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Economic Calendar',  'item' => url('economic-calendar')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<!-- Economic Calendar -->
<section class="tool-hero">
    <div class="container">
        <h1>Economic Calendar — Forex Market Events</h1>
        <p>Live economic events calendar with high-impact data releases, central bank decisions, and market-moving announcements.</p>
    </div>
</section>

<div class="page-hero-banner">
    <div class="container">
        <img src="<?= url('assets/img/banners/sub-economic-calendar.svg') ?>" alt="Economic Calendar" width="800" height="200" loading="lazy" decoding="async">
    </div>
</div>

<div class="container" style="padding:.75rem 0 0">
    <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_calendar_top">
        <div class="adv-inner">
            <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Traders Tracking Market Events</div><div class="adv-sub">Active traders in UAE, KSA &amp; GCC monitoring economic data and planning their next trade.</div></div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>

<section style="padding:1.5rem 0 3rem">
    <div class="container">

        <!-- Filters -->
        <div style="display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1rem;align-items:center">
            <span style="font-size:.82rem;font-weight:600;color:var(--text-muted)">Impact:</span>
            <button class="ec-filter-btn ec-active" data-impact="all">All</button>
            <button class="ec-filter-btn" data-impact="High">🔴 High</button>
            <button class="ec-filter-btn" data-impact="Medium">🟡 Medium</button>
            <button class="ec-filter-btn" data-impact="Low">⚪ Low</button>
        </div>

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;overflow:hidden;margin-bottom:1.5rem">
            <div id="ecLoading" style="padding:3rem;text-align:center;color:var(--text-muted);font-size:.9rem">Loading economic events…</div>
            <div id="ecError"   style="display:none;padding:3rem;text-align:center;color:var(--text-muted);font-size:.9rem">Unable to load calendar. Please try again later.</div>
            <div id="ecTable"   style="display:none;overflow-x:auto">
                <table style="width:100%;border-collapse:collapse;font-size:.85rem">
                    <thead>
                        <tr style="background:var(--navy);color:#fff;text-align:left">
                            <th style="padding:.75rem 1rem;font-weight:600;white-space:nowrap">Date / Time</th>
                            <th style="padding:.75rem .75rem;font-weight:600">Currency</th>
                            <th style="padding:.75rem .75rem;font-weight:600">Impact</th>
                            <th style="padding:.75rem .75rem;font-weight:600">Event</th>
                            <th style="padding:.75rem .75rem;font-weight:600;text-align:right">Forecast</th>
                            <th style="padding:.75rem 1rem;font-weight:600;text-align:right">Previous</th>
                        </tr>
                    </thead>
                    <tbody id="ecBody"></tbody>
                </table>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1rem;margin-bottom:2rem">
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem">
                <h3 style="font-size:.92rem;margin-bottom:.5rem">🔴 High Impact Events</h3>
                <p style="font-size:.82rem;color:var(--text-muted);line-height:1.55">Non-Farm Payrolls (NFP), FOMC Rate Decisions, CPI reports, and central bank speeches. These cause the most volatility.</p>
            </div>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem">
                <h3 style="font-size:.92rem;margin-bottom:.5rem">🟡 Medium Impact Events</h3>
                <p style="font-size:.82rem;color:var(--text-muted);line-height:1.55">GDP releases, trade balance data, employment change. Can cause notable moves, especially if data surprises.</p>
            </div>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem">
                <h3 style="font-size:.92rem;margin-bottom:.5rem">⚪ Low Impact Events</h3>
                <p style="font-size:.82rem;color:var(--text-muted);line-height:1.55">Minor data releases and speeches. Usually limited market impact unless data significantly beats or misses expectations.</p>
            </div>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem">
                <h3 style="font-size:.92rem;margin-bottom:.5rem">💡 Trading the News</h3>
                <p style="font-size:.82rem;color:var(--text-muted);line-height:1.55">Many brokers widen spreads around high-impact events. Check your broker's policy before trading economic releases.</p>
            </div>
        </div>
    </div>
</section>

<style>
.ec-filter-btn {
    padding: .3rem .85rem;
    font-size: .8rem;
    font-weight: 600;
    border: 1px solid var(--border);
    border-radius: 20px;
    background: var(--card-bg);
    color: var(--text-muted);
    cursor: pointer;
    transition: background .12s, color .12s;
}
.ec-filter-btn.ec-active, .ec-filter-btn:hover {
    background: var(--navy);
    color: #fff;
    border-color: var(--navy);
}
#ecBody tr { border-bottom: 1px solid var(--border); }
#ecBody tr:last-child { border-bottom: none; }
#ecBody tr:hover { background: rgba(245,158,11,.04); }
#ecBody td { padding: .65rem .75rem; vertical-align: middle; }
#ecBody td:first-child { padding-left: 1rem; white-space: nowrap; }
#ecBody td:last-child  { padding-right: 1rem; }
.ec-impact-high   { color: #ef4444; font-weight: 700; }
.ec-impact-medium { color: #f59e0b; font-weight: 600; }
.ec-impact-low    { color: var(--text-muted); }
</style>
<script>
(function() {
    var allEvents = [], activeImpact = 'all';

    function impactIcon(imp) {
        if (imp === 'High')   return '<span class="ec-impact-high">🔴 High</span>';
        if (imp === 'Medium') return '<span class="ec-impact-medium">🟡 Medium</span>';
        return '<span class="ec-impact-low">⚪ Low</span>';
    }

    function formatDT(dateStr) {
        if (!dateStr) return '—';
        var d = new Date(dateStr);
        if (isNaN(d)) return dateStr;
        return d.toLocaleDateString('en-GB', {day:'2-digit',month:'short'})
               + ' ' + d.toLocaleTimeString('en-GB', {hour:'2-digit',minute:'2-digit'});
    }

    function render(events) {
        var tbody = document.getElementById('ecBody');
        if (!events.length) {
            tbody.innerHTML = '<tr><td colspan="6" style="padding:2rem;text-align:center;color:var(--text-muted)">No events found for this filter.</td></tr>';
        } else {
            tbody.innerHTML = events.map(function(e) {
                return '<tr>'
                    + '<td style="font-size:.78rem;color:var(--text-muted)">' + formatDT(e.date) + '</td>'
                    + '<td><span style="font-weight:700;font-size:.88rem">' + (e.currency || '—') + '</span></td>'
                    + '<td>' + impactIcon(e.impact) + '</td>'
                    + '<td style="font-weight:500">' + (e.title || '—') + '</td>'
                    + '<td style="text-align:right;color:var(--text-muted)">' + (e.forecast || '—') + '</td>'
                    + '<td style="text-align:right;color:var(--text-muted)">' + (e.previous || '—') + '</td>'
                    + '</tr>';
            }).join('');
        }
        document.getElementById('ecLoading').style.display = 'none';
        document.getElementById('ecTable').style.display   = 'block';
    }

    function applyFilter() {
        var filtered = activeImpact === 'all'
            ? allEvents
            : allEvents.filter(function(e) { return e.impact === activeImpact; });
        render(filtered);
    }

    document.querySelectorAll('.ec-filter-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.ec-filter-btn').forEach(function(b) { b.classList.remove('ec-active'); });
            btn.classList.add('ec-active');
            activeImpact = btn.dataset.impact;
            applyFilter();
        });
    });

    fetch('/api/economic-calendar')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.error) throw new Error(data.error);
            allEvents = data;
            applyFilter();
        })
        .catch(function() {
            document.getElementById('ecLoading').style.display = 'none';
            document.getElementById('ecError').style.display   = 'block';
        });
})();
</script>
