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

<section style="padding:1.5rem 0 3rem">
    <div class="container">
        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;overflow:hidden;margin-bottom:1.5rem">
            <div class="tradingview-widget-container" style="height:700px">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-events.js" async>
                {
                    "colorTheme": "light",
                    "isTransparent": false,
                    "width": "100%",
                    "height": "700",
                    "locale": "en",
                    "importanceFilter": "-1,0,1",
                    "countryFilter": "us,eu,gb,jp,cn,au,ca,ch,nz,ae,sa"
                }
                </script>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1rem">
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
