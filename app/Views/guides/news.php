<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',         'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Forex News',   'item' => url('news')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'WebPage',
    'name'       => 'Forex Market News',
    'description'=> 'Live market news, analysis, and updates from the global forex markets. Covering GCC, MENA, and international currency markets.',
    'url'        => url('news'),
    'provider'   => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <h1>Forex Market News</h1>
        <p>Live market news, analysis, and updates from the global forex markets.</p>
    </div>
</div>

<div class="container" style="padding-bottom:3rem">

    <!-- TradingView News Widget -->
    <div style="margin-bottom:2rem">
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-timeline.js" async>
            {
                "feedMode": "all_symbols",
                "isTransparent": false,
                "displayMode": "regular",
                "width": "100%",
                "height": 600,
                "colorTheme": "dark",
                "locale": "en"
            }
            </script>
        </div>
    </div>

    <!-- Also show internal news articles if any -->
    <?php if (!empty($news)): ?>
    <h2 style="font-size:1.2rem;margin-bottom:1.25rem">Recent Analysis</h2>
    <div class="article-grid">
    <?php foreach ($news as $n): ?>
        <div class="article-card">
            <div class="article-card-body">
                <div class="article-meta"><?= date('M j, Y', strtotime($n['published_at'])) ?></div>
                <h3><a href="<?= url('news/' . $n['slug']) ?>"><?= e($n['title']) ?></a></h3>
                <?php if ($n['excerpt']): ?>
                <p><?= e($n['excerpt']) ?></p>
                <?php endif; ?>
                <a href="<?= url('news/' . $n['slug']) ?>" class="btn btn-ghost btn-sm" style="margin-top:.75rem">Read More →</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
