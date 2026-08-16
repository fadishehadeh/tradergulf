<?php
echo '<script type="application/ld+json">' . json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'AboutPage',
    'name'        => 'How We Rate Forex Brokers — Our Methodology',
    'description' => 'Transparent, consistent, and independent methodology for rating forex brokers. We assess regulation, spreads, platforms, deposits, and customer support.',
    'url'         => url('methodology'),
    'publisher'   => ['@type' => 'Organization', 'name' => setting('site_name', 'Trader Gulf'), 'url' => url()],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . json_encode([
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',        'item' => url()],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Methodology', 'item' => url('methodology')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>
<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem;text-align:center">
    <div class="container">
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.65rem">How We Rate Forex Brokers</h1>
        <p style="color:rgba(255,255,255,.7);max-width:600px;margin:0 auto;font-size:.95rem">
            Our methodology is transparent, consistent, and independent. Here's exactly how we evaluate every broker we review.
        </p>
    </div>
</section>

<section style="padding:3rem 0 4rem">
    <div class="container" style="max-width:780px">

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem;margin-bottom:2rem">
            <h2 style="font-size:1.15rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem">
                <span style="width:32px;height:32px;border-radius:8px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;color:var(--navy-dark);font-weight:700;font-size:.9rem">1</span>
                Regulation &amp; Safety (25%)
            </h2>
            <p style="color:var(--text-muted);line-height:1.7;font-size:.9rem">
                We verify each broker's regulatory status with the relevant authority (FCA, ASIC, CySEC, DFSA, etc.).
                Brokers holding licenses from Tier-1 regulators receive higher scores. We also check for investor compensation schemes,
                segregated client funds, and negative balance protection policies.
            </p>
        </div>

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem;margin-bottom:2rem">
            <h2 style="font-size:1.15rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem">
                <span style="width:32px;height:32px;border-radius:8px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;color:var(--navy-dark);font-weight:700;font-size:.9rem">2</span>
                Spreads &amp; Trading Costs (25%)
            </h2>
            <p style="color:var(--text-muted);line-height:1.7;font-size:.9rem">
                We open real accounts and measure live EUR/USD spreads during the London and New York sessions.
                We also account for commission structures, swap rates, deposit/withdrawal fees, and inactivity fees.
                Lower total trading costs = higher score. We do not accept compensation to inflate cost scores.
            </p>
        </div>

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem;margin-bottom:2rem">
            <h2 style="font-size:1.15rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem">
                <span style="width:32px;height:32px;border-radius:8px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;color:var(--navy-dark);font-weight:700;font-size:.9rem">3</span>
                Platforms &amp; Tools (20%)
            </h2>
            <p style="color:var(--text-muted);line-height:1.7;font-size:.9rem">
                We evaluate platform stability, execution speed, charting tools, and the range of order types.
                MT4, MT5, and proprietary platforms are all tested. We check mobile apps on iOS and Android,
                and verify that the demo account accurately reflects live trading conditions.
            </p>
        </div>

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem;margin-bottom:2rem">
            <h2 style="font-size:1.15rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem">
                <span style="width:32px;height:32px;border-radius:8px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;color:var(--navy-dark);font-weight:700;font-size:.9rem">4</span>
                Deposit &amp; Withdrawal (15%)
            </h2>
            <p style="color:var(--text-muted);line-height:1.7;font-size:.9rem">
                We test deposit and withdrawal processing times, and verify accepted payment methods relevant to Gulf traders
                (bank transfer, credit cards, e-wallets, and local payment methods).
                We also verify the minimum deposit requirements and whether brokers accept AED, SAR, or KWD base currencies.
            </p>
        </div>

        <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:2rem;margin-bottom:2rem">
            <h2 style="font-size:1.15rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem">
                <span style="width:32px;height:32px;border-radius:8px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;color:var(--navy-dark);font-weight:700;font-size:.9rem">5</span>
                Customer Support (15%)
            </h2>
            <p style="color:var(--text-muted);line-height:1.7;font-size:.9rem">
                We contact customer support via live chat, email, and phone to test response times and quality.
                For MENA readers, we specifically test whether Arabic-language support is available and whether agents
                have genuine knowledge of the local regulatory environment.
            </p>
        </div>

        <div style="background:rgba(255,193,7,.06);border:1px solid rgba(255,193,7,.2);border-radius:10px;padding:1.5rem">
            <h3 style="font-size:.95rem;margin-bottom:.5rem">Our Independence Guarantee</h3>
            <p style="font-size:.85rem;color:var(--text-muted);line-height:1.6">
                Trader Gulf earns affiliate commissions from some brokers. These commissions never influence our ratings or rankings.
                All scores are determined by our methodology, not by commercial relationships.
                <a href="<?= url('affiliate-disclosure') ?>" style="color:var(--accent)">Learn more in our Affiliate Disclosure.</a>
            </p>
        </div>
    </div>
</section>
