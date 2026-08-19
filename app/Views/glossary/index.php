<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',          'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Forex Glossary','item' => url('glossary')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'DefinedTermSet',
    'name'        => 'Forex Glossary',
    'description' => 'Plain-English definitions of key forex and CFD trading terms every trader needs to know.',
    'url'         => url('glossary'),
    'provider'    => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<div class="page-header">
    <div class="container">
        <h1>Forex Glossary</h1>
        <p>Plain-English definitions of key trading terms every forex trader needs to know.</p>
    </div>
</div>

<div class="page-hero-banner">
    <div class="container">
        <div class="banner-wrap">
            <img src="<?= url('assets/img/banners/sub-forex-glossary.svg') ?>" alt="Forex Glossary" width="800" height="200" loading="lazy" decoding="async">
            <a href="<?= url('glossary') ?>" class="banner-btn-link" aria-label="Browse Forex Glossary"></a>
        </div>
    </div>
</div>

<div class="container">

    <div style="padding:.5rem 0 1.25rem">
        <a href="<?= url('advertise') ?>" class="advertise-here-slot" data-track="cta_click" data-track-label="advertise_glossary_top">
            <div class="adv-inner">
                <div><div class="adv-tag">Advertise With Us</div><div class="adv-title">Reach Gulf Traders Learning the Market</div><div class="adv-sub">Active traders in UAE, KSA &amp; GCC building their knowledge. Get your brand in front of them.</div></div>
                <div class="adv-btn">Get a Quote →</div>
            </div>
        </a>
    </div>

    <nav class="glossary-nav" aria-label="Glossary alphabet">
        <?php
        $alphabet = range('A', 'Z');
        foreach ($alphabet as $letter):
            $hasTerms = isset($grouped[$letter]);
        ?>
        <?php if ($hasTerms): ?>
        <a href="#letter-<?= $letter ?>" class="<?= $hasTerms ? '' : 'disabled' ?>"><?= $letter ?></a>
        <?php else: ?>
        <span style="display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:4px;background:var(--bg);color:var(--border);font-size:.9rem;font-weight:700"><?= $letter ?></span>
        <?php endif; ?>
        <?php endforeach; ?>
    </nav>

    <?php foreach ($grouped as $letter => $terms): ?>
    <div class="glossary-section" id="letter-<?= $letter ?>">
        <div class="glossary-letter"><?= $letter ?></div>
        <ul class="glossary-list">
            <?php foreach ($terms as $term): ?>
            <li>
                <a href="<?= url('glossary/' . $term['slug']) ?>"><?= e($term['term']) ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endforeach; ?>

    <?php if (empty($grouped)): ?>
    <p style="color:var(--muted);text-align:center;padding:3rem 0">No glossary terms yet. Check back soon.</p>
    <?php endif; ?>

</div>
