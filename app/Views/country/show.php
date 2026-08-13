<?php
/** @var array $country  — country config array from CountryController */
/** @var array $brokers  — all active brokers */
$slug     = $country['slug'];
$name     = $country['name'];
$fullName = $country['full_name'];
?>

<!-- Hero -->
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <a href="<?= url('brokers') ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Brokers</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)"><?= e($name) ?></span>
        </nav>

        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.75rem">
            <span style="font-size:2.5rem;line-height:1"><?= $country['flag'] ?></span>
            <h1 style="font-size:clamp(1.5rem,3vw,2.2rem);color:#fff;margin:0">
                Best Forex Brokers in <?= e($fullName) ?> 2025
            </h1>
        </div>
        <div style="color:rgba(255,255,255,.72);max-width:680px;font-size:.95rem;line-height:1.65">
            <?= e($country['intro']) ?>
        </div>

        <!-- Quick facts -->
        <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-top:1.5rem">
            <div style="background:rgba(255,255,255,.07);border-radius:8px;padding:.5rem .9rem;font-size:.78rem;color:rgba(255,255,255,.75)">
                <strong style="color:#fff">Currency:</strong> <?= e($country['currency']) ?>
            </div>
            <div style="background:rgba(255,255,255,.07);border-radius:8px;padding:.5rem .9rem;font-size:.78rem;color:rgba(255,255,255,.75)">
                <strong style="color:#fff">Regulator:</strong> <?= e($country['regulators']) ?>
            </div>
            <div style="background:rgba(255,255,255,.07);border-radius:8px;padding:.5rem .9rem;font-size:.78rem;color:rgba(255,255,255,.75)">
                <strong style="color:#fff">Population:</strong> <?= e($country['population']) ?>
            </div>
        </div>
    </div>
</section>

<!-- Broker list -->
<section style="padding:2.5rem 0">
    <div class="container">

        <?= ad_zone('broker_listing_top') ?>

        <h2 style="font-size:1.2rem;margin-bottom:1.25rem">Top Forex Brokers for <?= e($name) ?> Traders</h2>

        <?php foreach ($brokers as $i => $b): ?>
        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1rem;display:flex;align-items:center;gap:1.25rem;flex-wrap:wrap">

            <!-- Rank -->
            <div style="font-size:.75rem;font-weight:800;color:var(--text-muted);width:24px;text-align:center;flex-shrink:0">#<?= $i + 1 ?></div>

            <!-- Logo -->
            <?php if (!empty($b['logo'])): ?>
            <img src="<?= e($b['logo']) ?>" alt="<?= e($b['name']) ?> logo" loading="lazy"
                 style="width:80px;height:52px;object-fit:contain;flex-shrink:0">
            <?php else: ?>
            <div style="width:80px;height:52px;background:var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.7rem;color:var(--text-muted);flex-shrink:0"><?= e($b['name']) ?></div>
            <?php endif; ?>

            <!-- Info -->
            <div style="flex:1;min-width:180px">
                <div style="font-size:1rem;font-weight:700;margin-bottom:.3rem">
                    <?= e($b['name']) ?>
                    <?php if (!empty($b['has_islamic'])): ?>
                    <span style="font-size:.7rem;background:rgba(52,211,153,.12);color:#34d399;padding:.15rem .4rem;border-radius:4px;font-weight:600;margin-left:.4rem">☪ Islamic</span>
                    <?php endif; ?>
                </div>
                <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.4rem">
                    Min deposit: $<?= e($b['min_deposit'] ?? '—') ?> &nbsp;·&nbsp;
                    Leverage: <?= e($b['max_leverage'] ?? '—') ?> &nbsp;·&nbsp;
                    <?= e($b['regulation'] ?? '') ?>
                </div>
                <?php if (!empty($b['tagline'])): ?>
                <div style="font-size:.82rem;color:var(--text-muted)"><?= e($b['tagline']) ?></div>
                <?php endif; ?>
            </div>

            <!-- Rating + CTA -->
            <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.5rem;flex-shrink:0">
                <?php if (!empty($b['overall_rating'])): ?>
                <div style="font-size:1.1rem;font-weight:800;color:var(--accent)"><?= number_format((float)$b['overall_rating'], 1) ?><span style="font-size:.7rem;color:var(--text-muted);font-weight:400">/5</span></div>
                <?php endif; ?>
                <div style="display:flex;gap:.5rem">
                    <a href="<?= url('brokers/' . e($b['slug'])) ?>"
                       style="padding:.45rem .9rem;border:1px solid var(--border);border-radius:7px;font-size:.8rem;font-weight:600;color:var(--text-main);text-decoration:none;white-space:nowrap">
                        Read Review
                    </a>
                    <?php if (!empty($b['affiliate_url'])): ?>
                    <a href="<?= url('go/' . $b['slug']) ?>" target="_blank" rel="noopener sponsored"
                       style="padding:.45rem 1rem;background:var(--accent);border:none;border-radius:7px;font-size:.8rem;font-weight:700;color:var(--navy-dark);text-decoration:none;white-space:nowrap">
                        Open Account
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (($i + 1) % 3 === 0): ?>
        <?= ad_zone('between_listings') ?>
        <?php endif; ?>

        <?php endforeach; ?>
    </div>
</section>

<?php
// Lead-gen widget for the top broker in this country list
$__lcBroker = null;
foreach ($brokers as $__lb) { if (!empty($__lb['affiliate_url'])) { $__lcBroker = $__lb; break; } }
if ($__lcBroker):
?>
<section style="padding:0 0 .5rem">
    <div class="container" style="max-width:800px">
        <?= lead_capture_form($__lcBroker['slug'], $__lcBroker['name'], $__lcBroker['affiliate_url']) ?>
    </div>
</section>
<?php endif; ?>

<!-- Country trading guide section -->
<section style="padding:0 0 2.5rem">
    <div class="container" style="max-width:800px">
        <h2 style="font-size:1.3rem;margin-bottom:1.25rem">Trading Forex in <?= e($fullName) ?></h2>
        <div style="line-height:1.75;color:var(--text-muted);font-size:.92rem">
            <p>Choosing the right forex broker as a trader based in <?= e($name) ?> depends on several key factors: regulatory protection, payment method availability, platform quality, and whether Islamic (swap-free) accounts are offered.</p>
            <p>We recommend prioritising brokers with licences from major regulators such as the <strong>FCA</strong> (UK), <strong>ASIC</strong> (Australia), <strong>CySEC</strong> (EU), or — where applicable — locally recognised bodies like the <strong><?= e($country['regulators']) ?></strong>. Multi-regulated brokers offer the strongest client protection.</p>
            <p>All brokers listed above have been independently reviewed by the Trader Gulf team. We assess regulation depth, trading costs, platform quality, deposit and withdrawal reliability, and customer support responsiveness — factors that matter most to <?= e($name) ?>-based traders.</p>
        </div>

        <!-- Risk warning -->
        <div style="background:rgba(245,158,11,.06);border:1px solid rgba(245,158,11,.2);border-radius:8px;padding:1rem 1.25rem;margin-top:1.5rem;font-size:.8rem;color:var(--text-muted);line-height:1.6">
            <strong style="color:var(--accent)">Risk Warning:</strong> CFDs and forex trading involve significant risk and may not be suitable for all investors. You may lose more than your initial investment. Past performance does not guarantee future results. Trade responsibly.
        </div>
    </div>
</section>

<!-- FAQ -->
<?php if (!empty($country['faqs'])): ?>
<section style="padding:0 0 3rem">
    <div class="container" style="max-width:800px">
        <h2 style="font-size:1.25rem;margin-bottom:1.25rem">Frequently Asked Questions — Forex Trading in <?= e($name) ?></h2>
        <div class="faq-list">
        <?php foreach ($country['faqs'] as $faq): ?>
            <details class="faq-item">
                <summary class="faq-q"><?= e($faq['q']) ?></summary>
                <div class="faq-a"><?= e($faq['a']) ?></div>
            </details>
        <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
