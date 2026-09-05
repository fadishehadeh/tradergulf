<!-- Hero market banner -->
<div class="page-hero-banner page-hero-banner--hero">
    <div class="banner-wrap">
        <img src="<?= url('assets/img/banners/hero-1-market-charts.svg') ?>" alt="Best Forex Brokers in UAE &amp; Gulf" width="1400" height="720" loading="eager" decoding="async">
        <a href="<?= url('brokers') ?>" class="hero-banner-btn-1" aria-label="View All Brokers"></a>
        <a href="<?= url('compare') ?>" class="hero-banner-btn-2" aria-label="Compare Brokers"></a>
    </div>
</div>

<!-- ADVERTISE HERE – hero slot -->
<div class="container" style="padding:.75rem 1.25rem">
    <a href="<?= url('advertise') ?>" class="advertise-here-hero" data-track="cta_click" data-track-label="advertise_hero_slot">
        <div class="adv-inner" style="padding:1.75rem 2.5rem">
            <div>
                <div class="adv-tag">Advertise With Us</div>
                <div class="adv-title">Reach Active Gulf Forex Traders</div>
                <div class="adv-sub">The GCC &amp; MENA's dedicated forex comparison platform - UAE, Saudi Arabia, Kuwait &amp; Qatar. Premium placements available now.</div>
            </div>
            <div class="adv-btn">Get a Quote →</div>
        </div>
    </a>
</div>

<!-- FEATURED BROKERS -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><?= t('Top Rated Forex Brokers') ?></h2>
            <p><?= t('Reviewed and ranked based on regulation, spreads, platforms, and overall trading conditions.') ?></p>
        </div>

        <div class="broker-grid">
        <?php foreach ($featuredBrokers as $broker): ?>
            <div class="broker-card">
                <div class="broker-card-header">
                    <?php if (!empty($broker['logo'])): ?>
                    <a href="<?= url('brokers/' . $broker['slug']) ?>">
                        <img src="<?= url('assets/img/brokers/' . e($broker['logo'])) ?>"
                             alt="<?= e($broker['name']) ?> logo"
                             class="broker-logo"
                             loading="lazy" decoding="async">
                    </a>
                    <?php else: ?>
                    <a href="<?= url('brokers/' . $broker['slug']) ?>" class="broker-name-text" style="text-decoration:none;color:inherit"><?= e($broker['name']) ?></a>
                    <?php endif; ?>
                </div>

                <div class="broker-card-stats">
                    <div class="broker-stat">
                        <div class="broker-stat-label"><?= t('Min Deposit') ?></div>
                        <div class="broker-stat-value">$<?= e(number_format((float)$broker['min_deposit'])) ?></div>
                    </div>
                    <div class="broker-stat">
                        <div class="broker-stat-label"><?= t('EUR/USD Spread') ?></div>
                        <div class="broker-stat-value"><?= e($broker['spread_eurusd']) ?> <?= t('pips') ?></div>
                    </div>
                    <div class="broker-stat">
                        <div class="broker-stat-label"><?= t('Max Leverage') ?></div>
                        <div class="broker-stat-value"><?= e($broker['max_leverage']) ?></div>
                    </div>
                </div>

                <div class="broker-card-footer">
                    <a href="<?= url('brokers/' . $broker['slug']) ?>" class="btn btn-ghost btn-sm" style="flex:1"
                       data-track="broker_review" data-track-label="<?= e($broker['name']) ?>"><?= t('Read Review') ?></a>
                    <?php if ($broker['affiliate_url']): ?>
                    <a href="<?= url('go/' . $broker['slug']) ?>" class="btn btn-primary btn-sm" style="flex:1"
                       target="_blank" rel="nofollow noopener"
                       data-track="affiliate_click" data-track-label="<?= e($broker['name']) ?>"><?= t('Visit Broker') ?></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>

        <div class="section-footer">
            <a href="<?= url('brokers') ?>" class="btn btn-outline"><?= t('View All Broker Reviews') ?></a>
        </div>
    </div>
</section>

<!-- CALCULATORS -->
<section class="section section-alt">
    <div class="container" style="display:flex;align-items:stretch;gap:1.25rem">

        <!-- Left vertical ad -->
        <div class="calc-side-ad">
            <a href="<?= url('advertise') ?>" class="calc-side-ad-inner" data-track="cta_click" data-track-label="advertise_calc_left">
                <div class="adv-tag" style="font-size:.8rem;letter-spacing:.12em">Advertisement</div>
                <div style="font-weight:900;font-size:1.75rem;color:#fff;line-height:1.2">Advertise<br>With Us</div>
                <div style="font-size:1rem;color:rgba(255,255,255,.65);line-height:1.6;max-width:220px">Reach active Gulf &amp; MENA forex traders</div>
                <div style="margin-top:.75rem;background:#f59e0b;color:#0a1628;font-weight:900;font-size:1rem;padding:.8rem 1.75rem;border-radius:8px;letter-spacing:.02em">Get In Touch →</div>
            </a>
        </div>

        <!-- Calculators -->
        <div style="flex:1;min-width:0">
            <div class="section-header">
                <h2><?= t('Trading Calculators') ?></h2>
                <p><?= t('Free tools to help you manage risk and calculate trade parameters before you enter the market.') ?></p>
            </div>
            <div class="tools-grid">
                <a href="<?= url('calculators/pip') ?>" class="tool-card">
                    <div class="tool-card-icon">📐</div>
                    <h3><?= t('Pip Calculator') ?></h3>
                    <p><?= t('Calculate the pip value for any currency pair and lot size.') ?></p>
                </a>
                <a href="<?= url('calculators/position-size') ?>" class="tool-card">
                    <div class="tool-card-icon">⚖️</div>
                    <h3><?= t('Position Size') ?></h3>
                    <p><?= t('Find the right lot size based on your risk % and stop loss.') ?></p>
                </a>
                <a href="<?= url('calculators/margin') ?>" class="tool-card">
                    <div class="tool-card-icon">💰</div>
                    <h3><?= t('Margin Calculator') ?></h3>
                    <p><?= t('Calculate the margin required to open any position.') ?></p>
                </a>
                <a href="<?= url('calculators/profit') ?>" class="tool-card">
                    <div class="tool-card-icon">📈</div>
                    <h3><?= t('Profit Calculator') ?></h3>
                    <p><?= t('Estimate profit or loss before entering a trade.') ?></p>
                </a>
            </div>
        </div>

        <!-- Right vertical ad -->
        <div class="calc-side-ad">
            <a href="<?= url('advertise') ?>" class="calc-side-ad-inner" data-track="cta_click" data-track-label="advertise_calc_right">
                <div class="adv-tag" style="font-size:.8rem;letter-spacing:.12em">Advertisement</div>
                <div style="font-weight:900;font-size:1.75rem;color:#fff;line-height:1.2">Advertise<br>With Us</div>
                <div style="font-size:1rem;color:rgba(255,255,255,.65);line-height:1.6;max-width:220px">Reach active Gulf &amp; MENA forex traders</div>
                <div style="margin-top:.75rem;background:#f59e0b;color:#0a1628;font-weight:900;font-size:1rem;padding:.8rem 1.75rem;border-radius:8px;letter-spacing:.02em">Get In Touch →</div>
            </a>
        </div>

    </div>
</section>

<!-- MARKET NEWS – self-hosted feed -->
<section class="section" id="newsWidgetSection">
    <div class="container">
        <div class="section-header">
            <h2><?= t('Market News') ?></h2>
            <p><?= t('Live financial news and market updates from global sources.') ?></p>
        </div>
        <div class="news-widget-grid" id="newsWidgetGrid">
            <div class="news-widget-loading"><?= t('Loading news…') ?></div>
        </div>
        <div style="margin-top:1.5rem;text-align:center">
            <a href="<?= url('news') ?>" class="btn btn-ghost btn-sm"><?= t('All Market News') ?> &rarr;</a>
        </div>
    </div>
</section>

<!-- ADVERTISE HERE – mid-page slot -->
<div class="banner-section">
    <div class="container">
        <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_mid_slot">
            <div class="adv-inner">
                <div>
                    <div class="adv-tag">Advertise With Us</div>
                    <div class="adv-title">Your Brand in Front of Gulf Traders</div>
                    <div class="adv-sub">Traders actively comparing brokers in UAE, KSA, Kuwait &amp; Qatar. Limited placements - get in early.</div>
                </div>
                <div class="adv-btn">Get a Quote →</div>
            </div>
        </a>
    </div>
</div>


<!-- GUIDES -->
<?php if (!empty($latestGuides)): ?>
<section class="section">
    <div class="container">
        <h2 style="margin-bottom:1.5rem"><?= t('Trading Guides') ?></h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1rem">
        <?php foreach ($latestGuides as $g): ?>
            <div class="article-card">
                <div class="article-card-body">
                    <div class="article-meta"><?= date('M j, Y', strtotime($g['published_at'])) ?></div>
                    <h3><a href="<?= url('guides/' . $g['slug']) ?>"><?= e($g['title']) ?></a></h3>
                    <?php if ($g['excerpt']): ?>
                    <p><?= e($g['excerpt']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <div style="margin-top:1.5rem">
            <a href="<?= url('guides') ?>" class="btn btn-ghost btn-sm"><?= t('All Guides') ?> &rarr;</a>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
/* Reposition hero-banner button overlays to match SVG button rects,
   accounting for object-fit:cover scaling and any crop offset */
(function () {
    var SVG_W = 1400, SVG_H = 720;
    var BTNS = [
        { sel: '.hero-banner-btn-1', x: 524, y: 417, w: 170, h: 40 },
        { sel: '.hero-banner-btn-2', x: 706, y: 417, w: 170, h: 40 },
    ];

    function pos() {
        var img = document.querySelector('.page-hero-banner--hero img');
        if (!img) return;
        var boxW = img.offsetWidth, boxH = img.offsetHeight;
        if (!boxW || !boxH) return;
        var scale = Math.max(boxW / SVG_W, boxH / SVG_H);
        var offX  = (boxW - SVG_W * scale) / 2;
        var offY  = (boxH - SVG_H * scale) / 2;
        BTNS.forEach(function (b) {
            var el = document.querySelector(b.sel);
            if (!el) return;
            el.style.left   = ((b.x * scale + offX) / boxW * 100).toFixed(3) + '%';
            el.style.top    = ((b.y * scale + offY) / boxH * 100).toFixed(3) + '%';
            el.style.width  = (b.w * scale / boxW * 100).toFixed(3) + '%';
            el.style.height = (b.h * scale / boxH * 100).toFixed(3) + '%';
        });
    }

    if (document.readyState === 'complete') { pos(); }
    else { window.addEventListener('load', pos); }
    window.addEventListener('resize', pos);
}());
</script>
