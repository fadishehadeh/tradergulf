<div class="page-header">
    <div class="container">
        <div class="breadcrumbs">
            <?php if (($guide['category'] ?? '') === 'news'): ?>
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('news') ?>">News</a><span class="sep">›</span>
            <?php else: ?>
            <a href="<?= url() ?>">Home</a><span class="sep">›</span>
            <a href="<?= url('guides') ?>">Guides</a><span class="sep">›</span>
            <?php endif; ?>
            <span><?= e($guide['title']) ?></span>
        </div>
        <h1><?= e($guide['title']) ?></h1>
        <div style="color:var(--muted);font-size:.88rem;margin-top:.4rem">
            Published: <?= date('F j, Y', strtotime($guide['published_at'])) ?>
        </div>
    </div>
</div>

<div class="container">
<div style="display:grid;grid-template-columns:1fr 280px;gap:2rem;align-items:start">

    <article class="card card-body" style="line-height:1.9;font-size:1rem">
        <?php if ($guide['excerpt']): ?>
        <p style="font-size:1.1rem;color:var(--muted);border-left:3px solid var(--accent);padding-left:1rem;margin-bottom:1.75rem">
            <?= e($guide['excerpt']) ?>
        </p>
        <?php endif; ?>
        <?= $guide['content_html'] ?: '<p style="color:var(--muted)">Content coming soon.</p>' ?>

        <!-- Social share -->
        <?php
        $shareUrl   = urlencode(url(($guide['category']==='news'?'news':'guides').'/'.$guide['slug']));
        $shareTitle = urlencode($guide['title']);
        ?>
        <div style="margin-top:2rem;padding-top:1.25rem;border-top:1px solid var(--border);display:flex;align-items:center;gap:.65rem;flex-wrap:wrap">
            <span style="font-size:.82rem;color:var(--muted);font-weight:600">Share:</span>
            <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>&text=<?= $shareTitle ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#1da1f2;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">Twitter</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $shareUrl ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#0077b5;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">LinkedIn</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#1877f2;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">Facebook</a>
            <a href="https://wa.me/?text=<?= $shareTitle ?>+<?= $shareUrl ?>" target="_blank" rel="noopener"
               style="padding:.3rem .75rem;background:#25d366;color:#fff;border-radius:5px;font-size:.8rem;font-weight:600;text-decoration:none">WhatsApp</a>
        </div>
    </article>

    <aside>
        <div class="card card-body" style="margin-bottom:1rem">
            <h4 style="margin-bottom:.75rem">Compare Brokers</h4>
            <p style="font-size:.85rem;color:var(--muted);margin-bottom:.75rem">Compare the top forex brokers side by side.</p>
            <a href="<?= url('compare') ?>" class="btn btn-primary btn-sm btn-block">Compare Now</a>
        </div>
        <div class="card card-body" style="margin-bottom:1rem">
            <h4 style="margin-bottom:.75rem">Trading Tools</h4>
            <a href="<?= url('calculators/pip') ?>"           class="btn btn-ghost btn-sm btn-block" style="margin-bottom:.4rem">Pip Calculator</a>
            <a href="<?= url('calculators/position-size') ?>" class="btn btn-ghost btn-sm btn-block" style="margin-bottom:.4rem">Position Size</a>
            <a href="<?= url('calculators/margin') ?>"        class="btn btn-ghost btn-sm btn-block">Margin Calculator</a>
        </div>
        <?php if (!empty($related)): ?>
        <div class="card card-body">
            <h4 style="margin-bottom:.75rem">Related Articles</h4>
            <?php foreach ($related as $rel): ?>
            <div style="margin-bottom:.85rem;padding-bottom:.85rem;border-bottom:1px solid var(--border);last-child:border-bottom:none">
                <a href="<?= url(($guide['category']==='news'?'news':'guides').'/'.$rel['slug']) ?>"
                   style="font-size:.88rem;font-weight:600;color:var(--text-main);text-decoration:none;line-height:1.4;display:block;margin-bottom:.2rem"><?= e($rel['title']) ?></a>
                <span style="font-size:.75rem;color:var(--muted)"><?= date('d M Y', strtotime($rel['published_at'])) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </aside>

</div>
</div>

<?php
$isNews    = ($guide['category'] ?? '') === 'news';
$section   = $isNews ? 'news' : 'guides';
$pubDate   = date('Y-m-d', strtotime($guide['published_at'] ?? 'now'));
$modDate   = isset($guide['updated_at']) && $guide['updated_at'] ? date('Y-m-d', strtotime($guide['updated_at'])) : $pubDate;
$orgName   = setting('site_name', 'Trader Gulf');
$logoUrl   = setting('og_image', url('assets/img/favicon.svg'));

// BreadcrumbList
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',                        'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => $isNews ? 'News' : 'Guides',   'item' => url($section)],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $guide['title']],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

// Article schema (E-E-A-T + AIO signals)
echo '<script type="application/ld+json">' . json_encode([
    '@context'       => 'https://schema.org',
    '@type'          => $isNews ? 'NewsArticle' : 'Article',
    'headline'       => $guide['title'],
    'description'    => $guide['excerpt'] ?? '',
    'datePublished'  => $pubDate,
    'dateModified'   => $modDate,
    'inLanguage'     => 'en',
    'url'            => url($section . '/' . $guide['slug']),
    'author'         => ['@type' => 'Organization', 'name' => $orgName, 'url' => url()],
    'publisher'      => [
        '@type' => 'Organization',
        'name'  => $orgName,
        'url'   => url(),
        'logo'  => ['@type' => 'ImageObject', 'url' => $logoUrl],
    ],
    'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url($section . '/' . $guide['slug'])],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
