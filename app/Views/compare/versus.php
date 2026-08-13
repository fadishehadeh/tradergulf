<?php
/** @var array $b1  — first broker (with review HTML) */
/** @var array $b2  — second broker (with review HTML) */

function brokerRating(array $b): string {
    $r = (float)($b['overall_rating'] ?? 0);
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $r) $stars .= '★';
        elseif ($i - 0.5 <= $r) $stars .= '½';
        else $stars .= '☆';
    }
    return $stars;
}

function vsCell(string $a, string $b, bool $lowerIsBetter = false): string {
    if (!$a || !$b) return '';
    $aVal = (float)preg_replace('/[^0-9.]/', '', $a);
    $bVal = (float)preg_replace('/[^0-9.]/', '', $b);
    if ($aVal == $bVal || !$aVal || !$bVal) return '';
    $aWins = $lowerIsBetter ? ($aVal < $bVal) : ($aVal > $bVal);
    return $aWins ? 'b1wins' : 'b2wins';
}
?>

<style>
.vs-hero {background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3rem 0 2rem}
.vs-brokers {display:grid;grid-template-columns:1fr auto 1fr;gap:1.5rem;align-items:center;max-width:700px;margin:0 auto}
.vs-broker-card {text-align:center;padding:1.25rem;background:rgba(255,255,255,.06);border-radius:12px}
.vs-broker-logo {width:100px;height:56px;object-fit:contain;margin:0 auto .75rem;display:block}
.vs-divider {font-size:1.5rem;font-weight:900;color:var(--accent);text-align:center}
.vs-table {width:100%;border-collapse:collapse;margin-bottom:1.5rem}
.vs-table th,.vs-table td {padding:.7rem 1rem;border-bottom:1px solid var(--border);font-size:.88rem}
.vs-table th {background:var(--card-bg);font-weight:600;color:var(--text-muted);text-align:left}
.vs-table td.label {color:var(--text-muted);width:34%}
.vs-table td.val {width:33%;text-align:center;font-weight:600}
.vs-table tr.b1wins td.b1 {background:rgba(52,211,153,.08);color:#34d399}
.vs-table tr.b2wins td.b2 {background:rgba(52,211,153,.08);color:#34d399}
.verdict-box {background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.5rem;margin-bottom:1.5rem}
.verdict-box h3 {font-size:1rem;margin:0 0 .75rem}
.section-tabs {display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1.5rem}
.section-tab {padding:.4rem .9rem;border-radius:6px;font-size:.8rem;font-weight:600;cursor:pointer;border:1px solid var(--border);background:var(--card-bg);color:var(--text-muted);text-decoration:none}
.section-tab.active,.section-tab:hover {background:var(--accent);color:var(--navy-dark);border-color:var(--accent)}
.detail-section {display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem}
.detail-col {background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.25rem;font-size:.88rem;line-height:1.65;color:var(--text-muted)}
.detail-col h4 {font-size:.95rem;font-weight:700;margin:0 0 .75rem;color:var(--text-main)}
@media(max-width:640px){
  .vs-brokers{grid-template-columns:1fr auto 1fr;gap:.75rem}
  .vs-broker-logo{width:70px;height:42px}
  .detail-section{grid-template-columns:1fr}
}
</style>

<!-- Hero -->
<section class="vs-hero">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1.25rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <a href="<?= url('compare') ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Compare</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)"><?= e($b1['name']) ?> vs <?= e($b2['name']) ?></span>
        </nav>

        <h1 style="font-size:clamp(1.5rem,3vw,2.2rem);color:#fff;text-align:center;margin:0 0 1.75rem">
            <?= e($b1['name']) ?> vs <?= e($b2['name']) ?> — 2025 Broker Comparison
        </h1>

        <div class="vs-brokers">
            <!-- Broker 1 -->
            <div class="vs-broker-card">
                <?php if (!empty($b1['logo'])): ?>
                <img src="<?= e($b1['logo']) ?>" alt="<?= e($b1['name']) ?> logo" class="vs-broker-logo">
                <?php else: ?>
                <div style="height:56px;display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;margin-bottom:.75rem"><?= e($b1['name']) ?></div>
                <?php endif; ?>
                <div style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.25rem"><?= e($b1['name']) ?></div>
                <div style="font-size:1rem;color:var(--accent)"><?= brokerRating($b1) ?> <?= number_format((float)($b1['overall_rating'] ?? 0), 1) ?></div>
                <?php if (!empty($b1['affiliate_url'])): ?>
                <a href="<?= url('go/' . $b1['slug']) ?>" target="_blank" rel="noopener sponsored"
                   style="display:inline-block;margin-top:.75rem;padding:.4rem .9rem;background:var(--accent);color:var(--navy-dark);border-radius:6px;font-size:.78rem;font-weight:700;text-decoration:none">
                    Open Account
                </a>
                <?php endif; ?>
            </div>

            <div class="vs-divider">VS</div>

            <!-- Broker 2 -->
            <div class="vs-broker-card">
                <?php if (!empty($b2['logo'])): ?>
                <img src="<?= e($b2['logo']) ?>" alt="<?= e($b2['name']) ?> logo" class="vs-broker-logo">
                <?php else: ?>
                <div style="height:56px;display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;margin-bottom:.75rem"><?= e($b2['name']) ?></div>
                <?php endif; ?>
                <div style="font-size:.9rem;font-weight:700;color:#fff;margin-bottom:.25rem"><?= e($b2['name']) ?></div>
                <div style="font-size:1rem;color:var(--accent)"><?= brokerRating($b2) ?> <?= number_format((float)($b2['overall_rating'] ?? 0), 1) ?></div>
                <?php if (!empty($b2['affiliate_url'])): ?>
                <a href="<?= url('go/' . $b2['slug']) ?>" target="_blank" rel="noopener sponsored"
                   style="display:inline-block;margin-top:.75rem;padding:.4rem .9rem;background:var(--accent);color:var(--navy-dark);border-radius:6px;font-size:.78rem;font-weight:700;text-decoration:none">
                    Open Account
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Quick comparison table -->
<section style="padding:2.5rem 0">
    <div class="container">

        <?= ad_zone('broker_review_top') ?>

        <div style="text-align:center;padding:.25rem 0 1.25rem">
            <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:.3rem">Advertisement</div>
            <a href="https://clicks.pipaffiliates.com/c?m=133352&c=1236678" referrerpolicy="no-referrer-when-downgrade" target="_blank" rel="nofollow noopener sponsored" data-track="banner_click" data-track-label="pip_versus">
                <img src="https://ads.pipaffiliates.com/i/133352?c=1236678" width="600" height="90" referrerpolicy="no-referrer-when-downgrade" alt="Sponsored" style="max-width:100%;height:auto;border-radius:6px;display:inline-block" loading="lazy">
            </a>
        </div>

        <h2 style="font-size:1.2rem;margin-bottom:1.25rem"><?= e($b1['name']) ?> vs <?= e($b2['name']) ?> — Quick Comparison</h2>

        <?php
        $minDepositClass = vsCell((string)($b1['min_deposit'] ?? 0), (string)($b2['min_deposit'] ?? 0), true);
        $ratingClass     = vsCell((string)($b1['overall_rating'] ?? 0), (string)($b2['overall_rating'] ?? 0), false);
        $spreadClass     = vsCell((string)($b1['spread_eurusd'] ?? 0), (string)($b2['spread_eurusd'] ?? 0), true);
        ?>

        <div style="overflow-x:auto">
        <table class="vs-table">
            <thead>
                <tr>
                    <th class="label">Feature</th>
                    <th class="val b1"><?= e($b1['name']) ?></th>
                    <th class="val b2"><?= e($b2['name']) ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="<?= $ratingClass ?>">
                    <td class="label">Overall Rating</td>
                    <td class="val b1"><?= number_format((float)($b1['overall_rating'] ?? 0), 1) ?>/5</td>
                    <td class="val b2"><?= number_format((float)($b2['overall_rating'] ?? 0), 1) ?>/5</td>
                </tr>
                <tr>
                    <td class="label">Regulation</td>
                    <td class="val b1" style="font-size:.8rem"><?= e($b1['regulation'] ?? '—') ?></td>
                    <td class="val b2" style="font-size:.8rem"><?= e($b2['regulation'] ?? '—') ?></td>
                </tr>
                <tr class="<?= $minDepositClass ?>">
                    <td class="label">Min. Deposit</td>
                    <td class="val b1">$<?= e($b1['min_deposit'] ?? '—') ?></td>
                    <td class="val b2">$<?= e($b2['min_deposit'] ?? '—') ?></td>
                </tr>
                <tr class="<?= $spreadClass ?>">
                    <td class="label">EUR/USD Spread</td>
                    <td class="val b1"><?= e($b1['spread_eurusd'] ?? '—') ?> pips</td>
                    <td class="val b2"><?= e($b2['spread_eurusd'] ?? '—') ?> pips</td>
                </tr>
                <tr>
                    <td class="label">Max Leverage</td>
                    <td class="val b1"><?= e($b1['max_leverage'] ?? '—') ?></td>
                    <td class="val b2"><?= e($b2['max_leverage'] ?? '—') ?></td>
                </tr>
                <tr>
                    <td class="label">Platforms</td>
                    <td class="val b1" style="font-size:.8rem"><?= e($b1['platforms'] ?? '—') ?></td>
                    <td class="val b2" style="font-size:.8rem"><?= e($b2['platforms'] ?? '—') ?></td>
                </tr>
                <tr>
                    <td class="label">Islamic Account</td>
                    <td class="val b1"><?= empty($b1['has_islamic']) ? '✗' : '✓' ?></td>
                    <td class="val b2"><?= empty($b2['has_islamic']) ? '✗' : '✓' ?></td>
                </tr>
                <tr>
                    <td class="label">Copy Trading</td>
                    <td class="val b1"><?= empty($b1['has_copy_trading']) ? '✗' : '✓' ?></td>
                    <td class="val b2"><?= empty($b2['has_copy_trading']) ? '✗' : '✓' ?></td>
                </tr>
                <tr>
                    <td class="label">Founded</td>
                    <td class="val b1"><?= e($b1['founded_year'] ?? '—') ?></td>
                    <td class="val b2"><?= e($b2['founded_year'] ?? '—') ?></td>
                </tr>
                <tr>
                    <td class="label">Headquarters</td>
                    <td class="val b1"><?= e($b1['headquarters'] ?? '—') ?></td>
                    <td class="val b2"><?= e($b2['headquarters'] ?? '—') ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="val b1">
                        <a href="<?= url('brokers/' . e($b1['slug'])) ?>"
                           style="font-size:.8rem;color:var(--accent);text-decoration:none">Full Review →</a>
                    </td>
                    <td class="val b2">
                        <a href="<?= url('brokers/' . e($b2['slug'])) ?>"
                           style="font-size:.8rem;color:var(--accent);text-decoration:none">Full Review →</a>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>

        <!-- Verdict box -->
        <div class="verdict-box">
            <h3>Our Verdict</h3>
            <p style="font-size:.9rem;color:var(--text-muted);line-height:1.7;margin:0">
                Both <?= e($b1['name']) ?> and <?= e($b2['name']) ?> are established, well-regulated forex brokers with strong track records in the MENA region.
                <?php if (!empty($b1['spread_eurusd']) && !empty($b2['spread_eurusd']) && (float)$b1['spread_eurusd'] < (float)$b2['spread_eurusd']): ?>
                <strong><?= e($b1['name']) ?></strong> offers tighter EUR/USD spreads (<?= e($b1['spread_eurusd']) ?> vs <?= e($b2['spread_eurusd']) ?> pips), making it more cost-effective for active traders.
                <?php elseif (!empty($b1['spread_eurusd']) && !empty($b2['spread_eurusd'])): ?>
                <strong><?= e($b2['name']) ?></strong> offers tighter EUR/USD spreads (<?= e($b2['spread_eurusd']) ?> vs <?= e($b1['spread_eurusd']) ?> pips), an advantage for cost-conscious traders.
                <?php endif; ?>
                <?php if (!empty($b1['min_deposit']) && !empty($b2['min_deposit']) && (int)$b1['min_deposit'] < (int)$b2['min_deposit']): ?>
                <?= e($b1['name']) ?>'s lower minimum deposit ($<?= e($b1['min_deposit']) ?>) makes it more accessible to newer traders.
                <?php elseif (!empty($b1['min_deposit']) && !empty($b2['min_deposit'])): ?>
                <?= e($b2['name']) ?>'s lower minimum deposit ($<?= e($b2['min_deposit']) ?>) is more accessible to newer traders.
                <?php endif; ?>
                We recommend reading both full reviews before making a final decision.
            </p>
        </div>

        <!-- Detailed sections -->
        <?php foreach ([
            ['regulation_html',      'Regulation'],
            ['account_types_html',   'Account Types'],
            ['platforms_html',       'Platforms'],
            ['spreads_html',         'Spreads & Costs'],
            ['deposits_html',        'Deposits & Withdrawals'],
            ['support_html',         'Customer Support'],
        ] as [$field, $label]):
            if (empty($b1[$field]) && empty($b2[$field])) continue;
        ?>
        <h3 style="font-size:1rem;margin:1.75rem 0 .75rem"><?= e($label) ?></h3>
        <div class="detail-section">
            <div class="detail-col">
                <h4><?= e($b1['name']) ?></h4>
                <?= $b1[$field] ?? '<p>Review coming soon.</p>' ?>
            </div>
            <div class="detail-col">
                <h4><?= e($b2['name']) ?></h4>
                <?= $b2[$field] ?? '<p>Review coming soon.</p>' ?>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Other comparisons -->
        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.25rem;margin-top:1.5rem">
            <h3 style="font-size:.95rem;margin:0 0 .75rem">Other Broker Comparisons</h3>
            <div style="display:flex;flex-wrap:wrap;gap:.5rem;font-size:.83rem">
                <?php
                $pairs = [
                    ['exness', 'xm', 'Exness vs XM'],
                    ['pepperstone', 'ic-markets', 'Pepperstone vs IC Markets'],
                    ['exness', 'pepperstone', 'Exness vs Pepperstone'],
                    ['xm', 'ic-markets', 'XM vs IC Markets'],
                    ['exness', 'ic-markets', 'Exness vs IC Markets'],
                    ['avatrade', 'pepperstone', 'AvaTrade vs Pepperstone'],
                    ['fp-markets', 'ic-markets', 'FP Markets vs IC Markets'],
                ];
                $currentVersus = $versus ?? '';
                foreach ($pairs as [$s1, $s2, $label]) {
                    $slug = "$s1-vs-$s2";
                    if ($slug === $currentVersus) continue;
                ?>
                <a href="<?= url('compare/' . $slug) ?>"
                   style="padding:.35rem .75rem;border:1px solid var(--border);border-radius:6px;color:var(--text-muted);text-decoration:none;white-space:nowrap">
                    <?= e($label) ?>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
