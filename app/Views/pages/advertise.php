<?php
$bCrumb = json_encode([
    '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>url()],
        ['@type'=>'ListItem','position'=>2,'name'=>'Advertise','item'=>url('advertise')],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
$headSchemas = ($headSchemas ?? '') . "<script type=\"application/ld+json\">$bCrumb</script>";
?>

<!-- Hero -->
<section class="adv-hero">
    <div class="container">
        <nav class="adv-breadcrumb">
            <a href="<?= url() ?>">Home</a>
            <span>/</span>
            <span>Advertise</span>
        </nav>
        <h1>Advertise With Trader Gulf</h1>
        <p class="adv-hero-sub">Put your broker or fintech product in front of Gulf-region traders who are actively comparing brokers, running calculators, and researching where to open an account.</p>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1.75rem">
            <a href="<?= url('contact') ?>" class="btn btn-primary btn-lg" data-track="cta_click" data-track-label="advertise_hero_contact">Get In Touch</a>
        </div>
    </div>
</section>

<!-- Who we serve -->
<section class="adv-section">
    <div class="container" style="max-width:900px">
        <h2 class="adv-h2">Who We Serve</h2>
        <p class="adv-lead">Trader Gulf is a forex broker comparison and education hub focused on the Gulf region and MENA. Our visitors come to compare brokers, read independent reviews, use trading calculators, and follow market news - a high-intent audience concentrated in the GCC.</p>

        <div class="adv-grid adv-grid-3">
            <?php $audiences = [
                ['🎯', 'Broker Researchers', 'Traders actively comparing brokers, reading reviews, and evaluating where to open or fund an account - maximum commercial intent.'],
                ['🧮', 'Calculator Users', 'Hands-on traders using our pip, margin, and position-size calculators while sizing real trades.'],
                ['📚', 'Education Seekers', 'Beginner and intermediate traders reading forex guides to improve their understanding before they commit capital.'],
                ['🌍', 'Gulf-Region Traders', 'Audience concentrated in the GCC and wider MENA - underserved by global forex media.'],
                ['🕌', 'Islamic Finance Traders', 'Traders specifically looking for Shariah-compliant, swap-free accounts - a major segment unique to the Gulf.'],
                ['📱', 'Mobile-First Traders', 'Majority of traffic arrives on mobile, where our responsive, fast-loading pages keep engagement high.'],
            ]; foreach ($audiences as [$icon, $title, $desc]): ?>
            <div class="adv-card">
                <div class="adv-card-icon"><?= $icon ?></div>
                <strong><?= $title ?></strong>
                <p><?= $desc ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Placements -->
<section class="adv-section adv-section-alt">
    <div class="container" style="max-width:900px">
        <h2 class="adv-h2">Placements Available</h2>
        <p class="adv-lead">We can place your brand across the surfaces where traders make decisions. Every placement is clearly labelled per our disclosure policy.</p>

        <div class="adv-grid adv-grid-2">
            <?php $placements = [
                ['📣', 'Homepage Banner', 'Full-width banner directly below the hero - maximum visibility on the most-visited page.'],
                ['📋', 'Broker Directory', 'Featured or sponsored slot within the main broker listing - seen by traders actively comparing.'],
                ['🔍', 'Broker Review Pages', 'Banner or sidebar ad on individual broker review pages, next to trading decision content.'],
                ['📚', 'Guides & News', 'Rectangle sidebar ad across all trading guides and news articles - research-mode readers.'],
                ['🧮', 'Calculators', 'Banner on pip, position-size, margin, and profit calculator pages - highest commercial intent.'],
                ['✍️', 'Sponsored Content', 'SEO-optimised article or broker spotlight clearly labelled as sponsored. Stays live permanently.'],
            ]; foreach ($placements as [$icon, $title, $desc]): ?>
            <div class="adv-card adv-card-inline">
                <div class="adv-card-icon-sm"><?= $icon ?></div>
                <div>
                    <strong><?= $title ?></strong>
                    <p><?= $desc ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Tracking + Compliance -->
<section class="adv-section">
    <div class="container" style="max-width:900px">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2.5rem">
            <div>
                <h2 class="adv-h2" style="font-size:1.2rem">Reporting & Tracking</h2>
                <p style="color:var(--muted);font-size:.88rem;line-height:1.7;margin-bottom:.75rem">Every broker link on Trader Gulf runs through our <code>/go</code> redirect, attaching placement and UTM parameters to each click so both parties can see exactly what drove a visit or lead.</p>
                <ul class="adv-check-list">
                    <li>Click attribution by placement, page and campaign</li>
                    <li>Monthly reports covering clicks and conversions</li>
                    <li>UTM-tagged links flowing into your own analytics</li>
                    <li>Transparent performance data - no inflated numbers</li>
                </ul>
            </div>
            <div>
                <h2 class="adv-h2" style="font-size:1.2rem">Compliance & Disclosure</h2>
                <p style="color:var(--muted);font-size:.88rem;line-height:1.7;margin-bottom:.75rem">We protect reader trust because it is what makes placements valuable. Our rules are simple and non-negotiable.</p>
                <ul class="adv-check-list">
                    <li>Sponsored content is always clearly labelled</li>
                    <li>Ratings stay independent - payment never affects scores</li>
                    <li>Affiliate links use <code>rel="sponsored nofollow"</code></li>
                    <li>Full affiliate disclosure published on site</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="adv-section adv-section-dark">
    <div class="container" style="max-width:620px;text-align:center">
        <h2 style="color:#fff;margin-bottom:.75rem;font-size:1.4rem">Interested in Advertising?</h2>
        <p style="color:rgba(255,255,255,.7);margin-bottom:1.75rem;font-size:.93rem;line-height:1.65">
            Send us a message using the contact form and we'll get back to you within 24 hours.
        </p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
            <a href="<?= url('contact') ?>" class="btn btn-primary btn-lg" data-track="cta_click" data-track-label="advertise_contact">
                Send Us a Message →
            </a>
        </div>
    </div>
</section>

<style>
.adv-hero {
    background: linear-gradient(135deg, var(--navy-dark) 0%, var(--navy) 100%);
    padding: 4rem 0 3.5rem;
}
.adv-hero h1 { color: #fff; font-size: clamp(1.6rem, 3vw, 2.5rem); max-width: 640px; margin-bottom: .75rem; }
.adv-hero-sub { color: rgba(255,255,255,.75); max-width: 580px; font-size: .98rem; line-height: 1.7; }
.adv-breadcrumb { font-size: .8rem; color: rgba(255,255,255,.5); margin-bottom: 1rem; display: flex; gap: .4rem; align-items: center; }
.adv-breadcrumb a { color: rgba(255,255,255,.5); text-decoration: none; }

.adv-section { padding: 3.5rem 0; }
.adv-section-alt { background: #f8fafc; }
.adv-section-dark { background: var(--navy-dark); padding: 4rem 0; }

.adv-h2 { font-size: 1.4rem; margin-bottom: .5rem; }
.adv-lead { color: var(--muted); max-width: 700px; margin-bottom: 2rem; line-height: 1.7; font-size: .93rem; }

.adv-grid { display: grid; gap: 1.1rem; }
.adv-grid-3 { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); }
.adv-grid-2 { grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); }

.adv-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.4rem;
}
.adv-card strong { display: block; margin-bottom: .35rem; font-size: .92rem; }
.adv-card p { color: var(--muted); font-size: .82rem; margin: 0; line-height: 1.55; }
.adv-card-icon { font-size: 1.5rem; margin-bottom: .5rem; }

.adv-card-inline {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}
.adv-card-icon-sm { font-size: 1.4rem; flex-shrink: 0; margin-top: .1rem; }

/* Checklist */
.adv-check-list { list-style: none; padding: 0; margin: 0; }
.adv-check-list li { font-size: .86rem; color: var(--muted); padding: .3rem 0 .3rem 1.4rem; position: relative; line-height: 1.55; }
.adv-check-list li::before { content: '✓'; position: absolute; left: 0; color: var(--accent); font-weight: 700; }

@media (max-width: 700px) {
    .adv-section .container > div[style*="grid-template-columns:1fr 1fr"] { display: block !important; }
    .adv-section .container > div[style*="grid-template-columns:1fr 1fr"] > div:first-child { margin-bottom: 2rem; }
}
</style>
