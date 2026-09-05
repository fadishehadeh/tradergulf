<section style="background:linear-gradient(135deg,var(--navy-dark) 0%,var(--navy) 100%);padding:3.5rem 0 2.5rem;text-align:center">
    <div class="container">
        <h1 style="font-size:clamp(1.6rem,3vw,2.4rem);color:#fff;margin-bottom:.65rem">Meet the Team</h1>
        <p style="color:rgba(255,255,255,.7);max-width:580px;margin:0 auto;font-size:.95rem">
            Independent forex analysts, traders, and researchers dedicated to unbiased broker reviews for the Gulf and MENA region.
        </p>
    </div>
</section>

<section style="padding:3rem 0 4rem">
    <div class="container" style="max-width:820px">

        <?php if (empty($members)): ?>
        <?php $members = [
            ['name'=>'Fadi Shehadeh','role'=>'Founder & Chief Editor','bio'=>'10+ years in forex trading and financial analysis. Based in the UAE, with deep expertise in Gulf-region broker regulation, DFSA compliance, and MENA trading markets. Previously traded proprietary capital at a Dubai-based fund.','img'=>''],
            ['name'=>'Sara Al-Mansouri','role'=>'Senior Broker Analyst','bio'=>'Certified Financial Analyst (CFA) with expertise in Gulf-region broker regulation and compliance. Specializes in Islamic finance products and halal trading accounts for Muslim investors in Saudi Arabia, UAE, and Kuwait.','img'=>''],
            ['name'=>'James Khoury','role'=>'US & Global Markets Analyst','bio'=>'Specialist in NFA/CFTC-regulated brokers and US trading legislation. Reviews global brokers for cross-border traders and US expats in the Gulf region. Based in New York.','img'=>''],
        ]; ?>
        <?php endif; ?>

        <?php
        // Person schema - runs after $members is fully populated
        $headSchemas = ($headSchemas ?? '');
        foreach ($members as $m) {
            if (empty($m['name'])) continue;
            $ps = [
                '@context'    => 'https://schema.org',
                '@type'       => 'Person',
                'name'        => $m['name'],
                'jobTitle'    => $m['role'] ?? '',
                'description' => $m['bio'] ?? '',
                'worksFor'    => ['@type' => 'Organization', 'name' => 'Trader Gulf', 'url' => url()],
            ];
            $j = json_encode($ps, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $headSchemas .= "<script type=\"application/ld+json\">$j</script>\n";
        }
        ?>

        <?php foreach ($members as $member): ?>
        <?php if (empty($member['name'])) continue; ?>
        <div style="display:flex;gap:1.75rem;align-items:flex-start;margin-bottom:2.5rem;padding-bottom:2.5rem;border-bottom:1px solid var(--border)">
            <?php if (!empty($member['img'])): ?>
            <img src="<?= e($member['img']) ?>" alt="<?= e($member['name']) ?>"
                 style="width:90px;height:90px;border-radius:50%;object-fit:cover;flex-shrink:0">
            <?php else: ?>
            <div style="width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,var(--accent) 0%,#1a6641 100%);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;color:var(--navy-dark);flex-shrink:0">
                <?= strtoupper(substr($member['name'], 0, 1)) ?>
            </div>
            <?php endif; ?>
            <div>
                <h2 style="font-size:1.15rem;margin-bottom:.2rem"><?= e($member['name']) ?></h2>
                <div style="color:var(--accent);font-size:.82rem;font-weight:600;margin-bottom:.75rem"><?= e($member['role']) ?></div>
                <p style="color:var(--text-muted);font-size:.9rem;line-height:1.65"><?= e($member['bio']) ?></p>
            </div>
        </div>
        <?php endforeach; ?>

        <div style="background:rgba(52,211,153,.07);border:1px solid rgba(52,211,153,.2);border-radius:10px;padding:1.5rem;text-align:center;margin-top:1rem">
            <h3 style="font-size:1rem;margin-bottom:.5rem">Our Commitment to Independence</h3>
            <p style="font-size:.88rem;color:var(--text-muted);line-height:1.6;max-width:560px;margin:0 auto">
                Every broker review on Trader Gulf is conducted independently. We test accounts ourselves, measure real spreads, and verify regulation.
                While we earn affiliate commissions from some brokers, our ratings are never influenced by commercial relationships.
                <a href="<?= url('affiliate-disclosure') ?>" style="color:var(--accent)">Read our full disclosure &#8594;</a>
            </p>
        </div>
    </div>
</section>
