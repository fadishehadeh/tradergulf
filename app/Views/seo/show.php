<?php
function seoStars(float $r): string {
    $f = (int)floor($r); $h = ($r - $f) >= 0.5 ? 1 : 0; $e = 5 - $f - $h;
    return str_repeat('★', $f) . ($h ? '½' : '') . str_repeat('☆', $e);
}
?>

<!-- Breadcrumb -->
<div style="background:#f8fafc;border-bottom:1px solid var(--border);padding:.65rem 0">
    <div class="container" style="font-size:.82rem;color:var(--muted)">
        <a href="<?= url('/') ?>" style="color:var(--muted)">Home</a> ›
        <a href="<?= url('brokers') ?>" style="color:var(--muted)">Brokers</a> ›
        <span style="color:var(--text)"><?= e($page['h1']) ?></span>
    </div>
</div>

<!-- Hero -->
<div style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:2.5rem 0 2rem">
    <div class="container">
        <div style="display:inline-block;background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.3);
                    color:var(--accent);font-size:.72rem;font-weight:700;letter-spacing:.06em;
                    text-transform:uppercase;padding:.25rem .75rem;border-radius:50px;margin-bottom:.75rem">
            <?= ucfirst($page['page_type']) ?> Guide
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,4vw,2.2rem);font-weight:800;line-height:1.2;margin-bottom:.75rem">
            <?= e($page['h1']) ?>
        </h1>
        <?php if (!empty($page['intro_html'])): ?>
        <div style="color:rgba(255,255,255,.75);font-size:1rem;max-width:680px;line-height:1.65">
            <?= $page['intro_html'] ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="container" style="padding:2rem 1rem">

    <!-- Broker comparison table -->
    <?php if (!empty($brokers)): ?>
    <div class="a-card" style="margin-bottom:2rem">
        <div class="a-card-header">
            <h2 style="font-size:1rem">Recommended Brokers</h2>
            <span class="badge badge-gray"><?= count($brokers) ?> brokers</span>
        </div>
        <div style="overflow-x:auto">
            <table style="width:100%;border-collapse:collapse;font-size:.88rem">
                <thead>
                    <tr style="background:#f8fafc;font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.05em">
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Broker</th>
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Rating</th>
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Min Deposit</th>
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">EUR/USD</th>
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Leverage</th>
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Islamic</th>
                        <th style="padding:.7rem 1rem;text-align:left;border-bottom:1px solid var(--border)">Regulation</th>
                        <th style="padding:.7rem 1rem;border-bottom:1px solid var(--border)"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($brokers as $i => $br): ?>
                <tr style="<?= $i % 2 === 0 ? '' : 'background:#fafafa' ?>">
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border)">
                        <?php if (!empty($br['logo'])): ?>
                        <img src="<?= asset('img/brokers/' . $br['logo']) ?>"
                             alt="<?= e($br['name']) ?>"
                             style="max-height:28px;max-width:100px;object-fit:contain;display:block">
                        <?php else: ?>
                        <strong><?= e($br['name']) ?></strong>
                        <?php endif; ?>
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border)">
                        <span style="color:#f59e0b"><?= seoStars((float)$br['overall_rating']) ?></span>
                        <span style="font-weight:700;margin-left:.25rem"><?= e($br['overall_rating']) ?></span>
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border);font-weight:600">
                        $<?= number_format((float)$br['min_deposit']) ?>
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border)">
                        <?= e($br['spread_eurusd']) ?> pips
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border)">
                        <?= e($br['max_leverage']) ?>
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border)">
                        <?php if ($br['has_islamic']): ?>
                        <span style="color:#059669;font-weight:700">✓ Yes</span>
                        <?php else: ?>
                        <span style="color:var(--muted)">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border);font-size:.8rem;color:var(--muted)">
                        <?= e($br['regulation']) ?>
                    </td>
                    <td style="padding:.85rem 1rem;border-bottom:1px solid var(--border)">
                        <div style="display:flex;gap:.4rem;flex-wrap:wrap">
                            <a href="<?= url('brokers/' . $br['slug']) ?>"
                               style="display:inline-flex;align-items:center;padding:.35rem .75rem;background:#f1f5f9;border:1px solid var(--border);border-radius:5px;font-size:.78rem;font-weight:600;color:var(--text);text-decoration:none;white-space:nowrap">
                                Review
                            </a>
                            <?php if (!empty($br['affiliate_url'])): ?>
                            <a href="<?= url('go/' . $br['slug']) ?>" target="_blank" rel="nofollow noopener"
                               style="display:inline-flex;align-items:center;padding:.35rem .75rem;background:var(--navy);border-radius:5px;font-size:.78rem;font-weight:600;color:#fff;text-decoration:none;white-space:nowrap">
                                Visit →
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div style="padding:.75rem 1rem;font-size:.75rem;color:var(--muted);border-top:1px solid var(--border)">
            74–89% of retail CFD accounts lose money. Ensure you understand the risks before trading.
        </div>
    </div>
    <?php endif; ?>

    <!-- Body content -->
    <?php if (!empty($page['body_html'])): ?>
    <div class="page-body" style="max-width:820px;line-height:1.75;color:var(--text)">
        <?= $page['body_html'] ?>
    </div>
    <?php endif; ?>

    <!-- FAQ accordion -->
    <?php if (!empty($faqs)): ?>
    <div style="max-width:820px;margin-top:2.5rem">
        <h2 style="font-size:1.3rem;font-weight:800;margin-bottom:1.25rem">Frequently Asked Questions</h2>
        <?php foreach ($faqs as $faq): ?>
        <?php if (empty($faq['q'])) continue; ?>
        <details class="faq-item" style="border:1px solid var(--border);border-radius:8px;margin-bottom:.6rem;overflow:hidden">
            <summary style="padding:1rem 1.25rem;font-weight:600;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:1rem">
                <?= e($faq['q']) ?>
                <span class="faq-arrow" style="flex-shrink:0;transition:transform .2s;font-size:.9rem">▼</span>
            </summary>
            <div style="padding:.75rem 1.25rem 1rem;border-top:1px solid var(--border);color:var(--muted);line-height:1.7;font-size:.93rem">
                <?= e($faq['a']) ?>
            </div>
        </details>
        <?php endforeach; ?>
    </div>

    <!-- FAQ JSON-LD schema for Google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
        <?php foreach ($faqs as $i => $faq): if (empty($faq['q'])) continue; ?>
        <?= $i > 0 ? ',' : '' ?>
        {
            "@type": "Question",
            "name": <?= json_encode($faq['q']) ?>,
            "acceptedAnswer": {
                "@type": "Answer",
                "text": <?= json_encode($faq['a'] ?? '') ?>
            }
        }
        <?php endforeach; ?>
        ]
    }
    </script>
    <?php endif; ?>

</div>

<style>
details.faq-item[open] .faq-arrow { transform: rotate(180deg); }
details.faq-item summary::-webkit-details-marker { display: none; }
.page-body h2 { font-size:1.15rem;font-weight:700;margin:1.75rem 0 .65rem; }
.page-body p  { margin-bottom:.9rem; }
.page-body ul,.page-body ol { margin:.5rem 0 1rem 1.5rem; }
.page-body li { margin-bottom:.35rem; }
.page-body strong { font-weight:700; }
</style>
