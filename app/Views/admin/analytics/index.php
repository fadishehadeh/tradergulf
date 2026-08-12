<?php
$maxDaily = max(array_column($daily, 'views') ?: [1]);
$maxPage  = $topPages[0]['views'] ?? 1;
?>

<style>
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem}
.stat-card{background:var(--a-card);border:1px solid var(--a-border);border-radius:10px;padding:1.25rem 1.5rem}
.stat-card .label{font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--a-muted);margin-bottom:.4rem}
.stat-card .value{font-size:2rem;font-weight:700;color:var(--a-text)}

.bar-chart{display:flex;align-items:flex-end;gap:6px;height:120px;margin-bottom:.5rem}
.bar-wrap{flex:1;display:flex;flex-direction:column;align-items:center;gap:4px}
.bar{width:100%;background:var(--a-accent);border-radius:3px 3px 0 0;min-height:3px;transition:opacity .15s}
.bar:hover{opacity:.75}
.bar-label{font-size:.62rem;color:var(--a-muted);white-space:nowrap;transform:rotate(-40deg);transform-origin:top right;margin-top:4px}
.bar-val{font-size:.68rem;color:var(--a-muted)}

.two-col{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-top:1.5rem}
.section-card{background:var(--a-card);border:1px solid var(--a-border);border-radius:10px;padding:1.25rem 1.5rem}
.section-card h3{font-size:.85rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--a-muted);margin:0 0 1rem}
.page-row{display:flex;align-items:center;gap:.75rem;margin-bottom:.6rem;font-size:.85rem}
.page-bar-bg{flex:1;background:var(--a-border);border-radius:3px;height:6px;overflow:hidden}
.page-bar-fill{height:100%;background:var(--a-accent);border-radius:3px}
.page-count{min-width:2.5rem;text-align:right;font-weight:600;color:var(--a-text)}
.page-path{min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:var(--a-muted)}
.ref-row{display:flex;justify-content:space-between;align-items:center;padding:.35rem 0;border-bottom:1px solid var(--a-border);font-size:.83rem}
.ref-row:last-child{border:none}
.ref-domain{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:var(--a-text)}
.ref-count{font-weight:600;color:var(--a-accent);margin-left:.5rem;flex-shrink:0}
.empty{color:var(--a-muted);font-size:.85rem;padding:.5rem 0}
</style>

<!-- Stat cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="label">Today</div>
        <div class="value"><?= number_format($totals['today']) ?></div>
    </div>
    <div class="stat-card">
        <div class="label">Last 7 Days</div>
        <div class="value"><?= number_format($totals['week']) ?></div>
    </div>
    <div class="stat-card">
        <div class="label">Last 30 Days</div>
        <div class="value"><?= number_format($totals['month']) ?></div>
    </div>
    <div class="stat-card">
        <div class="label">All Time</div>
        <div class="value"><?= number_format($totals['all']) ?></div>
    </div>
</div>

<!-- Daily chart -->
<div class="section-card" style="margin-bottom:0">
    <h3>Daily Views — Last 14 Days (humans only)</h3>
    <?php if (empty($daily)): ?>
        <p class="empty">No data yet.</p>
    <?php else: ?>
        <div class="bar-chart">
            <?php
            $dayMap = [];
            foreach ($daily as $d) $dayMap[$d['day']] = $d['views'];
            for ($i = 13; $i >= 0; $i--) {
                $day = date('Y-m-d', strtotime("-$i days"));
                $v   = $dayMap[$day] ?? 0;
                $pct = $maxDaily > 0 ? round($v / $maxDaily * 100) : 0;
                $label = date('M j', strtotime($day));
                echo "<div class='bar-wrap'>";
                echo "<div class='bar-val' style='font-size:.6rem;margin-bottom:2px'>" . ($v > 0 ? $v : '') . "</div>";
                echo "<div class='bar' style='height:{$pct}%' title='{$label}: {$v} views'></div>";
                echo "<div class='bar-label'>{$label}</div>";
                echo "</div>";
            }
            ?>
        </div>
    <?php endif; ?>
</div>

<div class="two-col">
    <!-- Top Pages -->
    <div class="section-card">
        <h3>Top Pages — Last 30 Days</h3>
        <?php if (empty($topPages)): ?>
            <p class="empty">No data yet.</p>
        <?php else: foreach ($topPages as $row): $pct = round($row['views'] / $maxPage * 100); ?>
        <div class="page-row">
            <div class="page-path" title="<?= e($row['path']) ?>"><?= e($row['path'] ?: '/') ?></div>
            <div class="page-bar-bg"><div class="page-bar-fill" style="width:<?= $pct ?>%"></div></div>
            <div class="page-count"><?= number_format((int)$row['views']) ?></div>
        </div>
        <?php endforeach; endif; ?>
    </div>

    <!-- Top Referrers -->
    <div class="section-card">
        <h3>Top Referrers — Last 30 Days</h3>
        <?php if (empty($topReferrers)): ?>
            <p class="empty">No referrer data yet.</p>
        <?php else: foreach ($topReferrers as $row):
            $domain = parse_url($row['referrer'], PHP_URL_HOST) ?: $row['referrer'];
        ?>
        <div class="ref-row">
            <span class="ref-domain" title="<?= e($row['referrer']) ?>"><?= e($domain) ?></span>
            <span class="ref-count"><?= number_format((int)$row['views']) ?></span>
        </div>
        <?php endforeach; endif; ?>
    </div>
</div>
