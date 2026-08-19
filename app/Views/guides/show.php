<?php
/* ── helpers ────────────────────────────────────────────────────────────── */
$isNews  = ($guide['category'] ?? '') === 'news';
$section = $isNews ? 'news' : 'guides';
$html    = $guide['content_html'] ?? '';

/* reading time */
$wordCount   = str_word_count(strip_tags($html));
$readingMins = max(1, (int)round($wordCount / 220));

/* extract H2s → TOC, inject IDs into content */
$tocItems = [];
$headingIdx = 0;
$html = preg_replace_callback('/<h2([^>]*)>(.*?)<\/h2>/is', function($m) use (&$tocItems, &$headingIdx) {
    $text = strip_tags($m[2]);
    $id   = 'sec-' . $headingIdx++ . '-' . substr(preg_replace('/[^a-z0-9]+/', '-', strtolower($text)), 0, 40);
    $tocItems[] = ['id' => $id, 'text' => $text];
    return '<h2' . $m[1] . ' id="' . htmlspecialchars($id) . '">' . $m[2] . '</h2>';
}, $html);

/* extract FAQ blocks (h3 ending in ? followed by <p>) for schema */
$faqSchema = [];
if (preg_match_all('/<h3[^>]*>([^<]*\?[^<]*)<\/h3>\s*<p[^>]*>(.*?)<\/p>/is', $html, $fm)) {
    foreach ($fm[1] as $i => $q) {
        $faqSchema[] = [
            '@type'          => 'Question',
            'name'           => trim(strip_tags($q)),
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => trim(strip_tags($fm[2][$i]))],
        ];
    }
}

/* published / modified dates */
$pubDate = date('Y-m-d', strtotime($guide['published_at'] ?? 'now'));
$modDate = !empty($guide['updated_at']) ? date('Y-m-d', strtotime($guide['updated_at'])) : $pubDate;
$orgName = setting('site_name', 'Trader Gulf');
$logoUrl = setting('og_image', url('assets/img/favicon.svg'));
$artUrl  = url($section . '/' . $guide['slug']);

/* ── schemas into <head> ─────────────────────────────────────────────────── */
$_articleSchema = [
    '@context'         => 'https://schema.org',
    '@type'            => $isNews ? 'NewsArticle' : 'Article',
    'headline'         => $guide['title'],
    'description'      => $guide['excerpt'] ?? '',
    'datePublished'    => $pubDate,
    'dateModified'     => $modDate,
    'wordCount'        => $wordCount,
    'timeRequired'     => 'PT' . $readingMins . 'M',
    'inLanguage'       => 'en',
    'url'              => $artUrl,
    'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $artUrl],
    'author'           => ['@type' => 'Organization', 'name' => $orgName, 'url' => url()],
    'publisher'        => ['@type' => 'Organization', 'name' => $orgName, 'url' => url(),
                           'logo' => ['@type' => 'ImageObject', 'url' => $logoUrl]],
    'speakable'        => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1','.guide-excerpt','.key-takeaways']],
];
$_bCrumb = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',                        'item' => url()],
    ['@type' => 'ListItem', 'position' => 2, 'name' => $isNews ? 'News' : 'Guides',   'item' => url($section)],
    ['@type' => 'ListItem', 'position' => 3, 'name' => $guide['title'],               'item' => $artUrl],
]];

$headSchemas  = ($headSchemas ?? '');
$headSchemas .= '<script type="application/ld+json">' . json_encode($_articleSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
$headSchemas .= '<script type="application/ld+json">' . json_encode($_bCrumb, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
if ($faqSchema) {
    $headSchemas .= '<script type="application/ld+json">' . json_encode(
        ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faqSchema],
        JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE
    ) . '</script>';
}
?>

<!-- Page header -->
<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url($section) ?>"><?= $isNews ? 'News' : 'Guides' ?></a><span class="sep">›</span>
            <span><?= e($guide['title']) ?></span>
        </div>
        <h1><?= e($guide['title']) ?></h1>
        <div class="guide-meta-bar">
            <span title="Published date">📅 <?= date('F j, Y', strtotime($guide['published_at'])) ?></span>
            <?php if ($modDate !== $pubDate): ?>
            <span>· Updated <?= date('F j, Y', strtotime($guide['updated_at'])) ?></span>
            <?php endif; ?>
            <span>· <?= $readingMins ?> min read</span>
            <span>· <?= number_format($wordCount) ?> words</span>
        </div>
    </div>
</div>

<div class="container guide-layout">

    <!-- ── MAIN ARTICLE ───────────────────────────────────────────── -->
    <article class="guide-article" itemscope itemtype="https://schema.org/Article">

        <?php if ($guide['excerpt']): ?>
        <p class="guide-excerpt"><?= e($guide['excerpt']) ?></p>
        <?php endif; ?>

        <!-- Table of Contents -->
        <?php if (count($tocItems) >= 3): ?>
        <nav class="guide-toc" aria-label="Table of contents">
            <strong>In this guide</strong>
            <ol>
            <?php foreach ($tocItems as $item): ?>
                <li><a href="#<?= htmlspecialchars($item['id']) ?>"><?= e($item['text']) ?></a></li>
            <?php endforeach; ?>
            </ol>
        </nav>
        <?php endif; ?>

        <!-- Article body -->
        <div class="guide-body" itemprop="articleBody">
            <?= $html ?: '<p style="color:var(--muted)">Content coming soon.</p>' ?>
        </div>

        <!-- Share bar -->
        <?php
        $shareUrl   = urlencode($artUrl);
        $shareTitle = urlencode($guide['title']);
        ?>
        <div class="guide-share">
            <span>Share:</span>
            <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>&text=<?= $shareTitle ?>" target="_blank" rel="noopener" class="share-btn share-tw">Twitter / X</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $shareUrl ?>" target="_blank" rel="noopener" class="share-btn share-li">LinkedIn</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank" rel="noopener" class="share-btn share-fb">Facebook</a>
            <a href="https://wa.me/?text=<?= $shareTitle ?>+<?= $shareUrl ?>" target="_blank" rel="noopener" class="share-btn share-wa">WhatsApp</a>
        </div>

        <!-- Editorial note -->
        <div class="editorial-note">
            <strong>Editorial independence:</strong> Trader Gulf maintains strict editorial standards. Our guides are written to inform traders, not to promote specific brokers. We may earn a commission if you click on broker links, which does not influence our ratings or content.
        </div>

    </article>

    <!-- ── SIDEBAR ────────────────────────────────────────────────── -->
    <aside class="guide-sidebar">

        <!-- Sticky inner wrapper -->
        <div class="guide-sidebar-inner">

            <div class="card card-body" style="margin-bottom:1rem">
                <h4 style="margin-bottom:.75rem;font-size:.95rem">Compare Top Brokers</h4>
                <p style="font-size:.82rem;color:var(--text-muted);margin-bottom:.75rem;line-height:1.5">Compare spreads, leverage, and regulation side-by-side.</p>
                <a href="<?= url('compare') ?>" class="btn btn-primary btn-sm btn-block" data-track="cta_click" data-track-label="guide_sidebar_compare">Compare Now →</a>
            </div>

            <div class="card card-body" style="margin-bottom:1rem">
                <h4 style="margin-bottom:.75rem;font-size:.95rem">Trading Calculators</h4>
                <a href="<?= url('calculators/pip') ?>"           class="btn btn-ghost btn-sm btn-block" style="margin-bottom:.4rem">📐 Pip Calculator</a>
                <a href="<?= url('calculators/position-size') ?>" class="btn btn-ghost btn-sm btn-block" style="margin-bottom:.4rem">⚖️ Position Size</a>
                <a href="<?= url('calculators/margin') ?>"        class="btn btn-ghost btn-sm btn-block">💰 Margin Calculator</a>
            </div>

            <?php $__guideAd = ad_zone('guide_sidebar'); if ($__guideAd): echo $__guideAd; else: ?>
            <a href="<?= url('advertise') ?>" class="advertise-here-sm" style="display:block;margin-bottom:1rem" data-track="cta_click" data-track-label="advertise_guide_sidebar">
                <div class="adv-inner" style="padding:.9rem 1.25rem;flex-direction:column;align-items:flex-start;gap:.5rem">
                    <div><div class="adv-tag">Advertise With Us</div><div class="adv-title" style="font-size:.95rem">Your Brand Here</div><div class="adv-sub">Gulf forex traders — UAE, KSA &amp; GCC.</div></div>
                    <div class="adv-btn" style="font-size:.8rem;padding:.5rem 1rem">Get a Quote →</div>
                </div>
            </a>
            <?php endif; ?>

            <?php if (!empty($related)): ?>
            <div class="card card-body">
                <h4 style="margin-bottom:.75rem;font-size:.95rem">Related Guides</h4>
                <?php foreach ($related as $rel): ?>
                <div style="margin-bottom:.85rem;padding-bottom:.85rem;border-bottom:1px solid var(--border)">
                    <a href="<?= url($section . '/' . $rel['slug']) ?>"
                       style="font-size:.86rem;font-weight:600;color:var(--text-main);text-decoration:none;line-height:1.45;display:block;margin-bottom:.2rem"><?= e($rel['title']) ?></a>
                    <span style="font-size:.73rem;color:var(--text-muted)"><?= date('d M Y', strtotime($rel['published_at'])) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </aside>

</div>
