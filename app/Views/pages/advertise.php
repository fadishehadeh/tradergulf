<?php
// BreadcrumbList
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
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)">Advertise</span>
        </nav>
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.75rem">Advertise With Trader Gulf</h1>
        <p style="color:rgba(255,255,255,.75);max-width:640px;font-size:.95rem;line-height:1.65">
            Reach thousands of active forex traders across the Gulf region and MENA. Our audience consists of experienced retail traders actively comparing brokers — high intent, high conversion.
        </p>
    </div>
</section>

<!-- Stats bar -->
<section style="background:var(--accent);padding:1.5rem 0">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:1.5rem;text-align:center">
            <div>
                <div style="font-size:1.8rem;font-weight:800;color:var(--navy-dark)">10K+</div>
                <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Monthly Readers</div>
            </div>
            <div>
                <div style="font-size:1.8rem;font-weight:800;color:var(--navy-dark)">UAE, KSA, KW</div>
                <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Primary Markets</div>
            </div>
            <div>
                <div style="font-size:1.8rem;font-weight:800;color:var(--navy-dark)">60%+</div>
                <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Intent-Stage Visitors</div>
            </div>
            <div>
                <div style="font-size:1.8rem;font-weight:800;color:var(--navy-dark)">English & Arabic</div>
                <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Content Languages</div>
            </div>
        </div>
    </div>
</section>

<!-- Ad formats -->
<section style="padding:3rem 0">
    <div class="container">
        <h2 style="font-size:1.5rem;margin-bottom:.5rem">Ad Formats &amp; Pricing</h2>
        <p style="color:var(--text-muted);margin-bottom:2.5rem">All placements are reviewed for quality. Broker partners receive preferred placement.</p>

        <?php
        $placements = [
            ['tag'=>'Homepage','name'=>'Homepage Leaderboard','size'=>'728×90','price'=>'$299','unit'=>'/month','popular'=>false,
             'desc'=>'Full-width image banner displayed directly below the hero section on the homepage. Maximum visibility for every new visitor.'],
            ['tag'=>'Broker Reviews','name'=>'Broker Review Page Top','size'=>'970×90','price'=>'$349','unit'=>'/month','popular'=>true,
             'desc'=>'Wide banner below the page header on every individual broker review page — seen by high-intent visitors actively evaluating brokers.'],
            ['tag'=>'Broker Listings','name'=>'Broker Listings Top','size'=>'728×90','price'=>'$249','unit'=>'/month','popular'=>false,
             'desc'=>'Banner at the very top of the /brokers comparison page, above all broker rows. Seen by every visitor browsing the full broker list.'],
            ['tag'=>'Broker Listings','name'=>'Between Broker Listings','size'=>'728×90','price'=>'$199','unit'=>'/month','popular'=>false,
             'desc'=>'Your banner injected naturally after every 4th broker row as visitors scroll through listings. High scroll-depth, high engagement.'],
            ['tag'=>'Broker Reviews','name'=>'Broker Review Sidebar','size'=>'300×250','price'=>'$199','unit'=>'/month','popular'=>false,
             'desc'=>'Sticky rectangle ad in the sidebar of all individual broker review pages. Visible throughout the full read — high dwell time.'],
            ['tag'=>'Guides & News','name'=>'Guide / Article Sidebar','size'=>'300×250','price'=>'$149','unit'=>'/month','popular'=>false,
             'desc'=>'Rectangle ad in the sidebar of all trading guides and news articles. Targets education-stage traders who are researching before committing.'],
            ['tag'=>'Email','name'=>'Newsletter Sponsorship','size'=>'600×100','price'=>'$149','unit'=>'/send','popular'=>false,
             'desc'=>'Featured placement in our subscriber email digest. Your logo, headline, and CTA sent directly to verified opt-in MENA traders.'],
            ['tag'=>'Content','name'=>'Sponsored Review / Article','size'=>'—','price'=>'$799','unit'=>'one-time','popular'=>false,
             'desc'=>'In-depth SEO-optimised article or broker review featuring your brand. Permanent placement with schema markup and sponsored disclosure.'],
        ];
        ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem">
        <?php foreach ($placements as $p): ?>
            <div style="background:var(--card-bg);border:<?= $p['popular'] ? '2px solid var(--accent)' : '1px solid var(--border)' ?>;border-radius:12px;padding:1.75rem;position:relative">
                <?php if ($p['popular']): ?>
                <div style="position:absolute;top:-1px;right:1.25rem;background:var(--accent);color:var(--navy-dark);font-size:.68rem;font-weight:700;padding:.2rem .65rem;border-radius:0 0 6px 6px">MOST POPULAR</div>
                <?php endif; ?>
                <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--accent);font-weight:700;margin-bottom:.5rem"><?= $p['tag'] ?></div>
                <h3 style="font-size:1.05rem;margin-bottom:.35rem"><?= $p['name'] ?></h3>
                <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:.75rem;font-family:monospace"><?= $p['size'] ?>px</div>
                <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:1rem;line-height:1.55"><?= $p['desc'] ?></p>
                <div style="font-size:1.4rem;font-weight:800;color:var(--text-main);margin-bottom:.25rem">
                    <?= $p['price'] ?> <span style="font-size:.85rem;font-weight:400;color:var(--text-muted)"><?= $p['unit'] ?></span>
                </div>
                <a href="<?= url('contact') ?>" class="btn btn-outline btn-sm" style="margin-top:.75rem"
                   data-track="cta_click" data-track-label="advertise_<?= strtolower(str_replace(' ','_',$p['name'])) ?>">
                    Book This Spot →
                </a>
            </div>
        <?php endforeach; ?>

            <div style="background:var(--card-bg);border:1px dashed var(--border);border-radius:12px;padding:1.75rem;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;min-height:200px">
                <div style="font-size:1.75rem;margin-bottom:.5rem">🤝</div>
                <h3 style="font-size:1.05rem;margin-bottom:.5rem">Custom Package</h3>
                <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:1rem">IB partnerships, geo-targeted placements, run-of-site packages, and bespoke integrations. Let's talk.</p>
                <a href="<?= url('contact') ?>" class="btn btn-outline btn-sm">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

<!-- Why us -->
<section style="padding:0 0 3rem">
    <div class="container" style="max-width:900px">
        <h2 style="font-size:1.25rem;margin-bottom:1.5rem">Why Advertise With Us?</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.25rem">
            <?php
            $reasons = [
                ['🎯', 'High-intent audience', 'Visitors actively comparing brokers — not casual browsers. Our readers are ready to open accounts.'],
                ['🌍', 'MENA-focused reach', 'Audience concentrated in UAE, Saudi Arabia, Kuwait, Egypt, and Jordan — underserved by global forex media.'],
                ['🌐', 'Bilingual platform', 'Full Arabic/RTL support. Reach Arabic-speaking traders in their preferred language.'],
                ['📊', 'Transparent reporting', 'Monthly click reports per placement. No black-box metrics — you see exactly what you\'re getting.'],
                ['🛡️', 'Brand-safe environment', 'Fully editorial site with strict compliance disclosures. No user-generated content risks.'],
                ['⚡', 'Fast go-live', 'New placements go live within 24 hours of receipt of creative and payment.'],
            ];
            foreach ($reasons as [$icon, $title, $body]):
            ?>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem">
                <div style="font-size:1.5rem;margin-bottom:.5rem"><?= $icon ?></div>
                <strong style="display:block;margin-bottom:.35rem;font-size:.9rem"><?= $title ?></strong>
                <p style="color:var(--text-muted);font-size:.82rem;margin:0;line-height:1.55"><?= $body ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section style="background:var(--navy-dark);padding:3rem 0;text-align:center">
    <div class="container">
        <h2 style="color:#fff;margin-bottom:.75rem">Ready to Get Started?</h2>
        <p style="color:rgba(255,255,255,.7);max-width:480px;margin:0 auto 1.75rem;font-size:.92rem">
            Fill in our contact form and mention the placement you're interested in. We'll respond with availability and a confirmed rate card within 24 hours.
        </p>
        <a href="<?= url('contact') ?>" class="btn btn-primary btn-lg"
           data-track="cta_click" data-track-label="advertise_contact">Contact Us to Advertise</a>
    </div>
</section>
