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
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:4rem 0 3rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)">Advertise</span>
        </nav>
        <h1 style="font-size:clamp(1.6rem,3vw,2.6rem);color:#fff;margin-bottom:1rem;max-width:640px">Advertise With Trader Gulf</h1>
        <p style="color:rgba(255,255,255,.75);max-width:600px;font-size:1rem;line-height:1.7">
            Reach active forex traders across the Gulf region and MENA. Our audience is made up of traders actively comparing brokers — high intent, high conversion.
        </p>
    </div>
</section>

<!-- Ad formats overview -->
<section style="padding:3.5rem 0">
    <div class="container" style="max-width:860px">

        <h2 style="font-size:1.4rem;margin-bottom:.5rem">Ad Placements Available</h2>
        <p style="color:var(--text-muted);margin-bottom:2.5rem">We offer homepage banners, broker listing placements, review page ads, guide sidebars, and sponsored content. All placements go live within 24 hours of receipt of creative.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.25rem;margin-bottom:3rem">
            <?php
            $formats = [
                ['📣', 'Homepage Banner', 'Full-width banner directly below the hero — maximum visibility for every new visitor.'],
                ['📋', 'Broker Listings', 'Banner above or between broker rows — seen by high-intent visitors comparing brokers.'],
                ['🔍', 'Broker Review Pages', 'Wide banner or sidebar ad on individual broker review pages.'],
                ['📚', 'Guides & News', 'Rectangle sidebar ad across all trading guides and news articles.'],
                ['🧮', 'Calculators', 'Banner on pip, position size, margin, and profit calculator pages.'],
                ['✍️', 'Sponsored Content', 'SEO-optimised review or article featuring your brand. Permanent placement with sponsored disclosure.'],
            ];
            foreach ($formats as [$icon, $title, $desc]):
            ?>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.5rem">
                <div style="font-size:1.5rem;margin-bottom:.5rem"><?= $icon ?></div>
                <h3 style="font-size:.95rem;margin-bottom:.35rem"><?= $title ?></h3>
                <p style="color:var(--text-muted);font-size:.82rem;margin:0;line-height:1.55"><?= $desc ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Why us -->
        <h2 style="font-size:1.25rem;margin-bottom:1.25rem">Why Advertise With Us?</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:1rem;margin-bottom:3rem">
            <?php
            $reasons = [
                ['🎯', 'High-intent audience', 'Visitors actively comparing brokers — ready to open accounts, not casual browsers.'],
                ['🌍', 'MENA-focused', 'Audience concentrated in Gulf and broader MENA markets — underserved by global forex media.'],
                ['🌐', 'Bilingual platform', 'Full Arabic/RTL support. Reach Arabic-speaking traders in their preferred language.'],
                ['🛡️', 'Brand-safe', 'Fully editorial site with strict compliance disclosures. No user-generated content risks.'],
            ];
            foreach ($reasons as [$icon, $title, $body]):
            ?>
            <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:10px;padding:1.25rem">
                <div style="font-size:1.4rem;margin-bottom:.4rem"><?= $icon ?></div>
                <strong style="display:block;margin-bottom:.3rem;font-size:.9rem"><?= $title ?></strong>
                <p style="color:var(--text-muted);font-size:.82rem;margin:0;line-height:1.55"><?= $body ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Contact -->
        <div style="background:var(--navy-dark);border-radius:14px;padding:2.5rem;text-align:center">
            <h2 style="color:#fff;margin-bottom:.75rem;font-size:1.35rem">Ready to Get Started?</h2>
            <p style="color:rgba(255,255,255,.7);max-width:480px;margin:0 auto 1.75rem;font-size:.93rem;line-height:1.65">
                Reach out and we'll respond with available placements and pricing within 24 hours.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
                <a href="mailto:fshehadeh@gmail.com" class="btn btn-primary btn-lg"
                   data-track="cta_click" data-track-label="advertise_email">
                    fshehadeh@gmail.com
                </a>
                <a href="<?= url('contact') ?>" class="btn btn-outline btn-lg" style="color:#fff;border-color:rgba(255,255,255,.4)"
                   data-track="cta_click" data-track-label="advertise_contact_form">
                    Send a Message
                </a>
            </div>
        </div>

    </div>
</section>
