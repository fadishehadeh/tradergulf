<?php
function renderStars(float $rating): string {
    $full  = floor($rating);
    $half  = ($rating - $full) >= 0.5 ? 1 : 0;
    $empty = 5 - $full - $half;
    return str_repeat('★', (int)$full) . ($half ? '½' : '') . str_repeat('☆', (int)$empty);
}
?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1><?= t('Find the Best Forex Broker') ?><br><span><?= t('Independent. Transparent. Global.') ?></span></h1>
        <p><?= t("We review and compare the world's top forex brokers so you can trade with confidence.") ?></p>
        <div class="hero-actions">
            <a href="<?= url('brokers') ?>" class="btn btn-primary btn-lg"><?= t('View All Brokers') ?></a>
            <a href="<?= url('compare') ?>" class="btn btn-outline btn-lg" style="color:#fff;border-color:#fff"><?= t('Compare Brokers') ?></a>
        </div>
    </div>
</section>

<!-- BANNER 1 – Landscape -->
<?php if (!empty($banners['home_landscape_1'])): $bn = $banners['home_landscape_1']; ?>
<div class="banner-section">
    <div class="container">
        <div class="banner-label"><?= t('Sponsored') ?></div>
        <div class="banner-wrap">
            <?php if (!empty($bn['image_url'])): ?>
            <a href="<?= e($bn['link_url'] ?: '#') ?>" class="banner-image-link" rel="nofollow noopener sponsored" target="_blank"
               data-track="banner_click" data-track-label="<?= e($bn['bname'] ?: 'banner') ?>">
                <img src="<?= e($bn['image_url']) ?>" alt="<?= e($bn['bname'] ?: 'Sponsored') ?>" class="banner-img-full">
            </a>
            <?php else: ?>
            <a href="<?= e($bn['link_url'] ?: '#') ?>" class="banner-landscape" rel="nofollow noopener" target="_blank"
               <?= !empty($bn['bg_style']) ? 'style="' . e($bn['bg_style']) . '"' : '' ?>
               data-track="banner_click" data-track-label="<?= e($bn['bname'] ?: 'banner') ?>">
                <div class="b-logo"><?= e($bn['bname'] ?: $bn['headline']) ?></div>
                <div class="b-copy">
                    <strong><?= e($bn['headline']) ?></strong>
                    <?= e($bn['sub_text']) ?>
                </div>
                <div class="b-cta"><?= e($bn['cta_text'] ?: t('Open Account')) ?> &rarr;</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

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
                    <img src="<?= asset('img/brokers/' . $broker['logo']) ?>"
                         alt="<?= e($broker['name']) ?> logo"
                         style="max-height:36px;max-width:130px;object-fit:contain">
                    <?php else: ?>
                    <div class="broker-logo-placeholder"><?= e($broker['name']) ?></div>
                    <?php endif; ?>
                    <div class="rating-badge">
                        <span class="stars"><?= renderStars((float)$broker['overall_rating']) ?></span>
                        <?= e($broker['overall_rating']) ?>
                    </div>
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

<!-- BANNER 2 – Portrait pair -->
<?php
$bp1 = $banners['home_portrait_1'] ?? null;
$bp2 = $banners['home_portrait_2'] ?? null;
if ($bp1 || $bp2):
?>
<div class="banner-section" style="background:var(--navy-dark);padding:2rem 0">
    <div class="container">
        <div class="banner-label" style="color:rgba(255,255,255,.35)"><?= t('Partner Brokers') ?></div>
        <div class="banner-portrait-pair">

            <?php if ($bp1): ?>
            <a href="<?= e($bp1['link_url'] ?: '#') ?>" class="banner-portrait" rel="nofollow noopener" target="_blank"
               <?= !empty($bp1['bg_style']) ? 'style="' . e($bp1['bg_style']) . '"' : '' ?>>
                <?php if (!empty($bp1['badge_text'])): ?>
                <div class="b-tag"><?= e($bp1['badge_text']) ?></div>
                <?php endif; ?>
                <div class="b-name"><?= e($bp1['bname'] ?: $bp1['headline']) ?></div>
                <?php if (!empty($bp1['overall_rating'])): ?>
                <div class="b-rating"><?= str_repeat('★', (int)round((float)$bp1['overall_rating'])) ?> <?= e($bp1['overall_rating']) ?></div>
                <?php endif; ?>
                <?php if (!empty($bp1['spread_eurusd'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('EUR/USD Spread') ?></span><span class="b-stat-value"><?= e($bp1['spread_eurusd']) ?> <?= t('pips') ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp1['min_deposit'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Min Deposit') ?></span><span class="b-stat-value">$<?= number_format((float)$bp1['min_deposit']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp1['max_leverage'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Max Leverage') ?></span><span class="b-stat-value"><?= e($bp1['max_leverage']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp1['regulation'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Regulation') ?></span><span class="b-stat-value"><?= e($bp1['regulation']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp1['platforms'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Platforms') ?></span><span class="b-stat-value"><?= e($bp1['platforms']) ?></span></div>
                <?php endif; ?>
                <div class="b-cta"><?= e($bp1['cta_text'] ?: t('Trade Now')) ?> &rarr;</div>
                <div class="b-disclaimer">74–89% of retail CFD accounts lose money.</div>
            </a>
            <?php endif; ?>

            <?php if ($bp2): ?>
            <a href="<?= e($bp2['link_url'] ?: '#') ?>" class="banner-portrait" rel="nofollow noopener" target="_blank"
               <?= !empty($bp2['bg_style']) ? 'style="' . e($bp2['bg_style']) . '"' : '' ?>>
                <?php if (!empty($bp2['badge_text'])): ?>
                <div class="b-tag"><?= e($bp2['badge_text']) ?></div>
                <?php endif; ?>
                <div class="b-name"><?= e($bp2['bname'] ?: $bp2['headline']) ?></div>
                <?php if (!empty($bp2['overall_rating'])): ?>
                <div class="b-rating"><?= str_repeat('★', (int)round((float)$bp2['overall_rating'])) ?> <?= e($bp2['overall_rating']) ?></div>
                <?php endif; ?>
                <?php if (!empty($bp2['spread_eurusd'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('EUR/USD Spread') ?></span><span class="b-stat-value"><?= e($bp2['spread_eurusd']) ?> <?= t('pips') ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp2['min_deposit'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Min Deposit') ?></span><span class="b-stat-value">$<?= number_format((float)$bp2['min_deposit']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp2['max_leverage'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Max Leverage') ?></span><span class="b-stat-value"><?= e($bp2['max_leverage']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp2['regulation'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Regulation') ?></span><span class="b-stat-value"><?= e($bp2['regulation']) ?></span></div>
                <?php endif; ?>
                <?php if (!empty($bp2['platforms'])): ?>
                <div class="b-stat"><span class="b-stat-label"><?= t('Platforms') ?></span><span class="b-stat-value"><?= e($bp2['platforms']) ?></span></div>
                <?php endif; ?>
                <div class="b-cta"><?= e($bp2['cta_text'] ?: t('Open Account')) ?> &rarr;</div>
                <div class="b-disclaimer">74–89% of retail CFD accounts lose money.</div>
            </a>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php endif; ?>

<!-- COMPARE CTA -->
<section class="section section-alt">
    <div class="container" style="text-align:center">
        <h2><?= t('Compare Brokers Side by Side') ?></h2>
        <p style="color:var(--muted);max-width:500px;margin:.75rem auto 1.75rem"><?= t('Select up to 4 brokers and instantly compare spreads, leverage, regulation, platforms and more.') ?></p>
        <a href="<?= url('compare') ?>" class="btn btn-primary btn-lg"><?= t('Open Compare Tool') ?></a>
    </div>
</section>

<!-- CALCULATORS -->
<section class="section">
    <div class="container">
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
</section>

<!-- BANNER 3 – Landscape -->
<?php if (!empty($banners['home_landscape_2'])): $bn = $banners['home_landscape_2']; ?>
<div class="banner-section">
    <div class="container">
        <div class="banner-label"><?= t('Sponsored') ?></div>
        <div class="banner-wrap">
            <?php if (!empty($bn['image_url'])): ?>
            <a href="<?= e($bn['link_url'] ?: '#') ?>" class="banner-image-link" rel="nofollow noopener sponsored" target="_blank"
               data-track="banner_click" data-track-label="<?= e($bn['bname'] ?: 'banner') ?>">
                <img src="<?= e($bn['image_url']) ?>" alt="<?= e($bn['bname'] ?: 'Sponsored') ?>" class="banner-img-full">
            </a>
            <?php else: ?>
            <a href="<?= e($bn['link_url'] ?: '#') ?>" class="banner-landscape" rel="nofollow noopener" target="_blank"
               <?= !empty($bn['bg_style']) ? 'style="' . e($bn['bg_style']) . '"' : '' ?>
               data-track="banner_click" data-track-label="<?= e($bn['bname'] ?: 'banner') ?>">
                <div class="b-logo"><?= e($bn['bname'] ?: $bn['headline']) ?></div>
                <div class="b-copy">
                    <strong><?= e($bn['headline']) ?></strong>
                    <?= e($bn['sub_text']) ?>
                </div>
                <div class="b-cta"><?= e($bn['cta_text'] ?: t('Trade Now')) ?> &rarr;</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- GUIDES + NEWS -->
<?php if (!empty($latestGuides) || !empty($latestNews)): ?>
<section class="section section-alt">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem">

            <?php if (!empty($latestGuides)): ?>
            <div>
                <h2 style="margin-bottom:1.5rem"><?= t('Trading Guides') ?></h2>
                <div style="display:flex;flex-direction:column;gap:1rem">
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
                <div style="margin-top:1.25rem">
                    <a href="<?= url('guides') ?>" class="btn btn-ghost btn-sm"><?= t('All Guides') ?> &rarr;</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($latestNews)): ?>
            <div>
                <h2 style="margin-bottom:1.5rem"><?= t('Market News') ?></h2>
                <div style="display:flex;flex-direction:column;gap:1rem">
                <?php foreach ($latestNews as $n): ?>
                    <div class="article-card">
                        <div class="article-card-body">
                            <div class="article-meta"><?= date('M j, Y', strtotime($n['published_at'])) ?></div>
                            <h3><a href="<?= url('news/' . $n['slug']) ?>"><?= e($n['title']) ?></a></h3>
                            <?php if ($n['excerpt']): ?>
                            <p><?= e($n['excerpt']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <div style="margin-top:1.25rem">
                    <a href="<?= url('news') ?>" class="btn btn-ghost btn-sm"><?= t('All News') ?> &rarr;</a>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endif; ?>
