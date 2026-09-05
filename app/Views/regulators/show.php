<?php
/** @var array $reg     - regulator config from RegulatorController */
/** @var array $brokers - brokers filtered by regulation field */
$tierColors = [
    1 => ['bg' => 'rgba(16,185,129,.12)', 'text' => '#10b981', 'label' => 'Tier 1 - Top Rated'],
    2 => ['bg' => 'rgba(245,158,11,.12)',  'text' => '#f59e0b', 'label' => 'Tier 2 - Well Regulated'],
    3 => ['bg' => 'rgba(156,163,175,.12)', 'text' => '#9ca3af', 'label' => 'Tier 3 - Offshore'],
];
$tc = $tierColors[$reg['tier']] ?? $tierColors[3];
?>

<!-- Hero -->
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <a href="<?= url('regulators') ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Regulators</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)"><?= e($reg['name']) ?></span>
        </nav>

        <div style="display:flex;align-items:center;gap:.9rem;margin-bottom:.85rem;flex-wrap:wrap">
            <span style="font-size:2.8rem;line-height:1"><?= $reg['flag'] ?></span>
            <div>
                <div style="display:flex;align-items:center;gap:.7rem;flex-wrap:wrap">
                    <h1 style="font-size:clamp(1.5rem,3vw,2.1rem);color:#fff;margin:0">
                        <?= e($reg['name']) ?> Regulated Forex Brokers <?= date('Y') ?>
                    </h1>
                    <span style="font-size:.72rem;font-weight:700;padding:.25rem .6rem;border-radius:20px;background:<?= $tc['bg'] ?>;color:<?= $tc['text'] ?>;white-space:nowrap">
                        <?= $tc['label'] ?>
                    </span>
                </div>
                <div style="color:rgba(255,255,255,.6);font-size:.85rem;margin-top:.3rem">
                    <?= e($reg['full_name']) ?> &nbsp;&middot;&nbsp; <?= e($reg['country']) ?> &nbsp;&middot;&nbsp; Est. <?= e($reg['established']) ?>
                </div>
            </div>
        </div>

        <p style="color:rgba(255,255,255,.72);max-width:700px;font-size:.92rem;line-height:1.7;margin:0">
            <?= e($reg['intro']) ?>
        </p>
    </div>
</section>

<!-- Key facts + broker count pills -->
<section style="background:var(--card-bg);border-bottom:1px solid var(--border);padding:1.5rem 0">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:.75rem">
            <?php foreach ($reg['key_facts'] as $label => $value): ?>
            <div style="background:var(--bg);border:1px solid var(--border);border-radius:9px;padding:.85rem 1rem;display:flex;flex-direction:column;gap:.2rem">
                <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);font-weight:600"><?= e($label) ?></div>
                <div style="font-size:.88rem;color:var(--text-main);font-weight:600;line-height:1.45"><?= e($value) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Broker list -->
<section style="padding:2.5rem 0">
    <div class="container">
        <h2 style="font-size:1.2rem;margin-bottom:1.25rem">
            Forex Brokers Regulated by <?= e($reg['name']) ?>
            <?php if ($brokers): ?>
            <span style="font-size:.8rem;font-weight:400;color:var(--text-muted);margin-left:.5rem">(<?= count($brokers) ?> found)</span>
            <?php endif; ?>
        </h2>

        <?php if (empty($brokers)): ?>
        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem;text-align:center;color:var(--text-muted);font-size:.9rem">
            No brokers currently listed with <?= e($reg['name']) ?> regulation. <a href="<?= url('brokers') ?>" style="color:var(--accent)">Browse all brokers</a>.
        </div>
        <?php endif; ?>

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
                <div style="font-size:1rem;font-weight:700;margin-bottom:.25rem">
                    <?= e($b['name']) ?>
                    <?php if (!empty($b['has_islamic'])): ?>
                    <span style="font-size:.7rem;background:rgba(52,211,153,.12);color:#34d399;padding:.15rem .4rem;border-radius:4px;font-weight:600;margin-left:.4rem">&#9755; Islamic</span>
                    <?php endif; ?>
                </div>
                <div style="font-size:.78rem;color:var(--text-muted)">
                    <?php if (!empty($b['min_deposit'])): ?>Min deposit: $<?= e($b['min_deposit']) ?>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<?php endif; ?>
                    <?php if (!empty($b['max_leverage'])): ?>Leverage: <?= e($b['max_leverage']) ?>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<?php endif; ?>
                    <?php if (!empty($b['spread_eurusd'])): ?>EUR/USD: <?= e($b['spread_eurusd']) ?> pips<?php endif; ?>
                </div>
                <?php if (!empty($b['regulation'])): ?>
                <div style="font-size:.73rem;color:var(--text-muted);margin-top:.2rem">
                    Regulated by: <?= e($b['regulation']) ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- CTAs -->
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

<!-- About the regulator -->
<section style="padding:0 0 2.5rem">
    <div class="container" style="max-width:800px">
        <h2 style="font-size:1.2rem;font-weight:800;margin-bottom:1rem">What Is the <?= e($reg['full_name']) ?>?</h2>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">
            <?= e($reg['intro']) ?>
        </p>

        <h2 style="font-size:1.2rem;font-weight:800;margin:1.75rem 0 1rem">How to Verify <?= e($reg['name']) ?> Regulation</h2>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">
            Before depositing funds with any broker, verify their regulatory status directly on the <?= e($reg['name']) ?> official register. Do not rely solely on licence numbers displayed on a broker's website - always cross-check the number against the public register. The official website is listed in the key facts above. Be wary of clone firms that use the names and registration numbers of legitimate brokers to deceive traders.
        </p>

        <h2 style="font-size:1.2rem;font-weight:800;margin:1.75rem 0 1rem">Frequently Asked Questions</h2>
        <?php foreach ($reg['faqs'] as $faq): ?>
        <details class="faq-item">
            <summary class="faq-q"><?= e($faq['q']) ?></summary>
            <div class="faq-a"><?= e($faq['a']) ?></div>
        </details>
        <?php endforeach; ?>

        <!-- Other regulators -->
        <div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--border)">
            <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;color:var(--text-muted);text-transform:uppercase;letter-spacing:.04em;font-size:.78rem">Other Regulators</h3>
            <div style="display:flex;flex-wrap:wrap;gap:.5rem">
                <a href="<?= url('regulators') ?>" style="padding:.4rem .85rem;border:1px solid var(--border);border-radius:20px;font-size:.8rem;font-weight:600;color:var(--text-main);text-decoration:none;background:var(--card-bg)">
                    &larr; All Regulators
                </a>
                <?php
                $allRegs = [
                    'fca' => 'FCA (UK)', 'asic' => 'ASIC (AU)', 'cysec' => 'CySEC (EU)',
                    'dfsa' => 'DFSA (UAE)', 'sca' => 'SCA (UAE)', 'cma-saudi' => 'CMA (SA)',
                    'fsca' => 'FSCA (ZA)', 'fsa-seychelles' => 'FSA (SC)', 'cma-kuwait' => 'CMA (KW)',
                ];
                foreach ($allRegs as $slug => $label):
                    if ($slug === $reg['slug']) continue; ?>
                <a href="<?= url('regulators/' . $slug) ?>"
                   style="padding:.4rem .85rem;border:1px solid var(--border);border-radius:20px;font-size:.8rem;font-weight:600;color:var(--accent);text-decoration:none;background:var(--card-bg)">
                    <?= e($label) ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
