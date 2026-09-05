<?php
/** @var array $regulators */
$tierColors = [
    1 => ['bg' => 'rgba(16,185,129,.12)', 'text' => '#10b981', 'label' => 'Tier 1'],
    2 => ['bg' => 'rgba(245,158,11,.12)',  'text' => '#f59e0b', 'label' => 'Tier 2'],
    3 => ['bg' => 'rgba(156,163,175,.12)', 'text' => '#9ca3af', 'label' => 'Tier 3'],
];
?>

<!-- Hero -->
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem">
    <div class="container">
        <nav style="font-size:.8rem;color:rgba(255,255,255,.5);margin-bottom:1rem">
            <a href="<?= url() ?>" style="color:rgba(255,255,255,.5);text-decoration:none">Home</a>
            <span style="margin:0 .4rem">/</span>
            <span style="color:rgba(255,255,255,.8)">Regulators</span>
        </nav>
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.75rem;max-width:700px">
            Forex Regulators Guide <?= date('Y') ?>
        </h1>
        <p style="color:rgba(255,255,255,.72);max-width:660px;font-size:.95rem;line-height:1.7;margin:0">
            Understand which regulatory body oversees your broker. From Tier 1 authorities like the FCA and ASIC - with compensation schemes and strict client-money rules - to regional regulators across the UAE, Saudi Arabia, and Kuwait, this guide explains what each licence means for your protection as a Gulf trader.
        </p>
    </div>
</section>

<!-- Tier legend -->
<div style="background:var(--card-bg);border-bottom:1px solid var(--border)">
    <div class="container" style="padding:.85rem 0;display:flex;flex-wrap:wrap;gap:1.5rem;align-items:center">
        <span style="font-size:.78rem;color:var(--text-muted);font-weight:600;letter-spacing:.04em;text-transform:uppercase">Tier Rating:</span>
        <?php foreach ($tierColors as $t => $c): ?>
        <span style="display:flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--text-muted)">
            <span style="width:10px;height:10px;border-radius:50%;background:<?= $c['text'] ?>;display:inline-block"></span>
            <strong style="color:<?= $c['text'] ?>"><?= $c['label'] ?></strong>
            <?php if ($t === 1): ?>- Top rated, strongest client protection
            <?php elseif ($t === 2): ?>- Well regulated, good oversight
            <?php else: ?>- Offshore, basic oversight<?php endif; ?>
        </span>
        <?php endforeach; ?>
    </div>
</div>

<!-- Regulator grid -->
<section style="padding:2.5rem 0 3rem">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:1.25rem">

        <?php foreach ($regulators as $reg):
            $tc = $tierColors[$reg['tier']] ?? $tierColors[3]; ?>

        <a href="<?= url('regulators/' . $reg['slug']) ?>" style="display:block;background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.5rem;text-decoration:none;color:inherit;transition:border-color .15s,box-shadow .15s"
           onmouseover="this.style.borderColor='var(--accent)';this.style.boxShadow='0 4px 16px rgba(245,158,11,.12)'"
           onmouseout="this.style.borderColor='var(--border)';this.style.boxShadow='none'">

            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1rem">
                <div style="display:flex;align-items:center;gap:.75rem">
                    <span style="font-size:2rem;line-height:1"><?= $reg['flag'] ?></span>
                    <div>
                        <div style="font-size:1.15rem;font-weight:800;color:var(--text-main)"><?= e($reg['name']) ?></div>
                        <div style="font-size:.75rem;color:var(--text-muted)"><?= e($reg['country']) ?></div>
                    </div>
                </div>
                <span style="font-size:.68rem;font-weight:700;padding:.2rem .55rem;border-radius:20px;background:<?= $tc['bg'] ?>;color:<?= $tc['text'] ?>;white-space:nowrap">
                    <?= $tc['label'] ?>
                </span>
            </div>

            <div style="font-size:.8rem;color:var(--text-muted);margin-bottom:.75rem;font-style:italic">
                <?= e($reg['full_name']) ?>
            </div>

            <div style="display:flex;flex-direction:column;gap:.45rem">
                <div style="display:flex;justify-content:space-between;font-size:.79rem">
                    <span style="color:var(--text-muted)">Compensation</span>
                    <span style="color:var(--text-main);font-weight:600;text-align:right;max-width:200px"><?= e($reg['compensation']) ?></span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.79rem">
                    <span style="color:var(--text-muted)">Max Leverage</span>
                    <span style="color:var(--text-main);font-weight:600"><?= e($reg['leverage']) ?></span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:.79rem">
                    <span style="color:var(--text-muted)">Established</span>
                    <span style="color:var(--text-main);font-weight:600"><?= e($reg['established']) ?></span>
                </div>
            </div>

            <div style="margin-top:1.1rem;font-size:.8rem;color:var(--accent);font-weight:600">
                View brokers &amp; details &rarr;
            </div>
        </a>
        <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- Editorial section -->
<section style="padding:0 0 3rem;background:var(--card-bg);border-top:1px solid var(--border)">
    <div class="container" style="max-width:800px;padding-top:2.5rem">

        <h2 style="font-size:1.25rem;font-weight:800;margin-bottom:1rem">Why Regulation Matters for Gulf Forex Traders</h2>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">
            Choosing a regulated broker is the single most important step you can take to protect your trading capital. Regulation determines whether your funds are segregated from the broker's own assets, whether you are covered by a compensation scheme if the broker becomes insolvent, and what legal recourse you have in a dispute.
        </p>
        <p style="line-height:1.75;color:var(--text-muted);font-size:.92rem;margin-bottom:.9rem">
            For traders in the UAE, Saudi Arabia, and Kuwait, most international forex brokers operate under licences from multiple regulators. The entity your account is held under determines which rules apply. A broker may hold FCA, ASIC, and Seychelles FSA licences simultaneously - offering clients different entities with different levels of protection and leverage.
        </p>

        <h2 style="font-size:1.25rem;font-weight:800;margin:1.75rem 0 1rem">Understanding the Tier System</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;margin-bottom:1rem">
            <div style="background:rgba(16,185,129,.06);border:1px solid rgba(16,185,129,.2);border-radius:10px;padding:1.1rem">
                <div style="font-weight:800;color:#10b981;margin-bottom:.4rem">Tier 1 - Top Rated</div>
                <div style="font-size:.82rem;color:var(--text-muted);line-height:1.6">Strict oversight, compensation schemes, mandatory fund segregation. FCA, ASIC, DFSA.</div>
            </div>
            <div style="background:rgba(245,158,11,.06);border:1px solid rgba(245,158,11,.2);border-radius:10px;padding:1.1rem">
                <div style="font-weight:800;color:#f59e0b;margin-bottom:.4rem">Tier 2 - Well Regulated</div>
                <div style="font-size:.82rem;color:var(--text-muted);line-height:1.6">Good standards, some investor protection. CySEC, FSCA, SCA, CMA, QFCRA, CBB.</div>
            </div>
            <div style="background:rgba(156,163,175,.06);border:1px solid rgba(156,163,175,.2);border-radius:10px;padding:1.1rem">
                <div style="font-weight:800;color:#9ca3af;margin-bottom:.4rem">Tier 3 - Offshore</div>
                <div style="font-size:.82rem;color:var(--text-muted);line-height:1.6">Basic licensing, minimal oversight, no compensation. FSA Seychelles, Vanuatu, BVI.</div>
            </div>
        </div>

        <h2 style="font-size:1.25rem;font-weight:800;margin:1.75rem 0 1rem">Frequently Asked Questions</h2>

        <details class="faq-item">
            <summary class="faq-q">Which regulator is best for UAE traders?</summary>
            <div class="faq-a">For UAE traders, the strongest protection comes from brokers regulated by the FCA (UK), ASIC (Australia), or the DFSA (Dubai). The FCA and ASIC are globally recognised Tier 1 regulators with mandatory fund segregation and compensation schemes. The DFSA is the UAE\'s own top-tier regulator within the DIFC. All provide strong legal frameworks for client protection. Many Gulf traders use FCA or ASIC-regulated broker entities to benefit from the highest level of protection available.</div>
        </details>

        <details class="faq-item">
            <summary class="faq-q">Is it safe to trade with an offshore-regulated broker?</summary>
            <div class="faq-a">Offshore-regulated brokers (Seychelles FSA, Vanuatu, BVI) carry more risk than Tier 1-regulated alternatives. They typically offer higher leverage, but provide less client protection: no compensation scheme, no mandatory negative balance protection, and weaker enforcement. If you choose an offshore-regulated entity for its leverage, ensure the broker also holds a Tier 1 licence for its other entities - this signals the firm meets high standards elsewhere, even if your specific account has fewer protections.</div>
        </details>

        <details class="faq-item">
            <summary class="faq-q">Can Gulf traders use FCA-regulated brokers?</summary>
            <div class="faq-a">Yes. UAE, Saudi, Kuwaiti, and other Gulf traders can legally open accounts with FCA-regulated brokers. Many of the brokers reviewed on Trader Gulf - including Pepperstone, AvaTrade, and IC Markets - hold FCA licences. However, your account may be held under a different entity (e.g. ASIC or an offshore entity) depending on how the broker handles its account opening process. Always check your account agreement to confirm which regulatory entity covers you.</div>
        </details>

        <details class="faq-item">
            <summary class="faq-q">What is the difference between the DFSA and SCA?</summary>
            <div class="faq-a">The DFSA (Dubai Financial Services Authority) regulates financial firms within the DIFC - a special economic zone in Dubai. The SCA (Securities and Commodities Authority) is the UAE\'s federal regulator for financial services on the mainland, covering all 7 emirates outside the DIFC and ADGM. A broker with a DFSA licence is not automatically permitted to operate on the UAE mainland, and vice versa. Both are separate regulatory bodies with distinct jurisdictions and licensing requirements.</div>
        </details>

    </div>
</section>
