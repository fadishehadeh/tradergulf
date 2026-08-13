<?php
$introHtml = $seoPage['intro_html'] ?? '';
$bodyHtml  = $seoPage['body_html'] ?? '';
?>

<?php
// BreadcrumbList schema
$bSchema = json_encode([
    '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>url()],
        ['@type'=>'ListItem','position'=>2,'name'=>'Islamic Forex Brokers','item'=>url('islamic-forex-brokers')],
    ],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
$headSchemas = ($headSchemas ?? '') . "<script type=\"application/ld+json\">$bSchema</script>";
?>

<!-- Hero -->
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)">Islamic Forex Brokers</span>
        </nav>
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.75rem;max-width:700px">
            <?= e($seoPage['h1'] ?? 'Best Islamic Forex Brokers 2025') ?>
        </h1>
        <?php if ($introHtml): ?>
        <div style="color:rgba(255,255,255,.75);max-width:680px;font-size:.95rem;line-height:1.65">
            <?= $introHtml ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- PipAffiliates banner -->
<div style="text-align:center;padding:.75rem 0">
    <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:.3rem">Advertisement</div>
    <a href="https://clicks.pipaffiliates.com/c?m=150553&c=1236678" referrerpolicy="no-referrer-when-downgrade" target="_blank" rel="nofollow noopener sponsored" data-track="banner_click" data-track-label="pip_islamic">
        <img src="https://ads.pipaffiliates.com/i/150553?c=1236678" width="600" height="90" referrerpolicy="no-referrer-when-downgrade" alt="Sponsored" style="max-width:100%;height:auto;border-radius:6px;display:inline-block" loading="lazy">
    </a>
</div>

<!-- Broker list -->
<section style="padding:2.5rem 0">
    <div class="container">
        <h2 style="font-size:1.2rem;margin-bottom:1.25rem">Top Islamic Forex Brokers</h2>

        <?php if (empty($brokers)): ?>
        <p style="color:var(--text-muted)">No Islamic brokers found. Check back soon.</p>
        <?php endif; ?>

        <?php foreach ($brokers as $b): ?>
        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1rem;display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap">
            <?php if (!empty($b['logo'])): ?>
            <img src="<?= e($b['logo']) ?>" alt="<?= e($b['name']) ?> logo" loading="lazy" style="width:80px;height:52px;object-fit:contain;flex-shrink:0">
            <?php else: ?>
            <div style="width:80px;height:52px;background:var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.7rem;color:var(--text-muted);flex-shrink:0"><?= e($b['name']) ?></div>
            <?php endif; ?>

            <div style="flex:1;min-width:180px">
                <div style="font-size:1rem;font-weight:700;margin-bottom:.25rem">
                    <?= e($b['name']) ?>
                    <span style="font-size:.7rem;background:rgba(52,211,153,.12);color:var(--accent);padding:.15rem .45rem;border-radius:4px;font-weight:600;margin-left:.4rem">☪ Islamic</span>
                </div>
                <div style="font-size:.8rem;color:var(--text-muted)">
                    Min deposit: $<?= e($b['min_deposit'] ?? '—') ?> &nbsp;·&nbsp;
                    Leverage: <?= e($b['max_leverage'] ?? '—') ?> &nbsp;·&nbsp;
                    <?= e($b['regulation'] ?? '') ?>
                </div>
            </div>

            <div style="display:flex;gap:.6rem;flex-wrap:wrap;justify-content:flex-end">
                <a href="<?= url('brokers/' . e($b['slug'])) ?>"
                   style="padding:.5rem 1rem;border:1px solid var(--border);border-radius:7px;font-size:.82rem;font-weight:600;color:var(--text-main);text-decoration:none">
                    Read Review
                </a>
                <?php if (!empty($b['affiliate_url'])): ?>
                <a href="<?= url('go/' . $b['slug']) ?>" target="_blank" rel="noopener sponsored"
                   style="padding:.5rem 1.1rem;background:var(--accent);border:none;border-radius:7px;font-size:.82rem;font-weight:700;color:var(--navy-dark);text-decoration:none">
                    Open Account
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Body content -->
<?php if ($bodyHtml): ?>
<section style="padding:0 0 2rem">
    <div class="container" style="max-width:800px">
        <div style="line-height:1.75;color:var(--text-muted);font-size:.92rem">
            <?= $bodyHtml ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FAQ -->
<?php if (!empty($faqs)): ?>
<section style="padding:0 0 3rem">
    <div class="container" style="max-width:800px">
        <h2 style="font-size:1.25rem;margin-bottom:1.25rem">Frequently Asked Questions</h2>
        <div class="faq-list">
        <?php foreach ($faqs as $faq): ?>
            <details class="faq-item">
                <summary class="faq-q"><?= e($faq['q']) ?></summary>
                <div class="faq-a"><?= e($faq['a']) ?></div>
            </details>
        <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
