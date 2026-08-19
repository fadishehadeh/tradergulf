<?php
$gscSubmitUrl = 'https://search.google.com/search-console/sitemaps?resource_id=' . urlencode(rtrim(config('app.url', url('')), '/') . '/');
$sitemapEncoded = urlencode($sitemapUrl);
?>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;max-width:960px">

    <!-- Status Card -->
    <div class="a-card">
        <div class="a-card-header"><h3>Sitemap Status</h3></div>
        <div class="a-card-body">
            <?php if ($exists): ?>
            <table class="a-table" style="margin:0">
                <tr><td style="color:var(--muted-a)">Status</td><td><span class="badge badge-green">✓ Generated</span></td></tr>
                <tr><td style="color:var(--muted-a)">Last Generated</td><td><?= e($lastMod) ?></td></tr>
                <tr><td style="color:var(--muted-a)">Total URLs</td><td><strong><?= number_format($urlCount) ?></strong></td></tr>
                <tr>
                    <td style="color:var(--muted-a)">Sitemap URL</td>
                    <td>
                        <a href="<?= e($sitemapUrl) ?>" target="_blank" style="word-break:break-all;font-size:.82rem"><?= e($sitemapUrl) ?></a>
                        <button onclick="navigator.clipboard.writeText('<?= e($sitemapUrl) ?>');this.textContent='Copied!';setTimeout(()=>this.textContent='Copy',1500)"
                                style="margin-left:.5rem;font-size:.72rem;padding:.15rem .5rem;cursor:pointer;border:1px solid var(--a-border);border-radius:4px;background:var(--a-card);color:var(--a-muted)">Copy</button>
                    </td>
                </tr>
            </table>
            <?php else: ?>
            <div style="text-align:center;padding:2rem;color:var(--a-muted)">
                <div style="font-size:2.5rem;margin-bottom:.75rem">🗺️</div>
                <p>No sitemap generated yet.</p>
                <p style="font-size:.85rem">Click <strong>Generate Sitemap</strong> to build <code>sitemap.xml</code>.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="a-card">
        <div class="a-card-header"><h3>Actions</h3></div>
        <div class="a-card-body" style="display:flex;flex-direction:column;gap:.85rem">

            <form action="<?= url('admin/sitemap/generate') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn-a btn-a-accent" style="width:100%">
                    🔄 Generate Sitemap Now
                </button>
            </form>

            <?php if ($exists): ?>
            <form action="<?= url('admin/sitemap/ping') ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn-a btn-a-outline" style="width:100%">
                    📡 Ping Search Engines (Google + Bing)
                </button>
            </form>

            <a href="<?= e($sitemapUrl) ?>" target="_blank" class="btn-a btn-a-outline" style="width:100%;text-align:center">
                👁️ View sitemap.xml
            </a>

            <a href="<?= e($gscSubmitUrl) ?>" target="_blank" rel="noopener"
               class="btn-a btn-a-accent" style="width:100%;text-align:center">
                🔍 Submit to Google Search Console ↗
            </a>
            <?php else: ?>
            <p style="font-size:.83rem;color:var(--a-muted)">Generate the sitemap first to unlock submission.</p>
            <?php endif; ?>

            <a href="https://www.bing.com/webmasters" target="_blank" rel="noopener"
               class="btn-a btn-a-outline" style="width:100%;text-align:center;font-size:.83rem">
                Bing Webmaster Tools ↗
            </a>
        </div>
    </div>

</div>

<!-- Submit to GSC step-by-step -->
<?php if ($exists): ?>
<div class="a-card" style="max-width:960px;margin-top:1.25rem">
    <div class="a-card-header"><h3>Submit to Google Search Console - Step by Step</h3></div>
    <div class="a-card-body">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;font-size:.85rem">
            <div style="background:var(--a-bg);border-radius:8px;padding:1rem">
                <div style="font-size:1.5rem;margin-bottom:.5rem">1️⃣</div>
                <strong>Generate</strong><br>
                Click <em>Generate Sitemap Now</em> above to rebuild with all current URLs.
            </div>
            <div style="background:var(--a-bg);border-radius:8px;padding:1rem">
                <div style="font-size:1.5rem;margin-bottom:.5rem">2️⃣</div>
                <strong>Open GSC</strong><br>
                Click <em>Submit to Google Search Console</em> - opens the Sitemaps section of your property.
            </div>
            <div style="background:var(--a-bg);border-radius:8px;padding:1rem">
                <div style="font-size:1.5rem;margin-bottom:.5rem">3️⃣</div>
                <strong>Paste &amp; Submit</strong><br>
                In the "Add a new sitemap" box paste:<br>
                <code style="font-size:.78rem;word-break:break-all;display:block;margin-top:.35rem"><?= e($sitemapUrl) ?></code>
            </div>
            <div style="background:var(--a-bg);border-radius:8px;padding:1rem">
                <div style="font-size:1.5rem;margin-bottom:.5rem">4️⃣</div>
                <strong>Ping</strong><br>
                Come back and click <em>Ping Search Engines</em> so Google crawls it immediately.
            </div>
        </div>
        <p style="margin-top:1rem;font-size:.83rem;color:var(--a-muted)">
            <strong>Tip:</strong> Regenerate + ping whenever you publish new broker reviews, articles, or SEO pages. Google typically crawls within 24–48 hours after a ping.
        </p>
    </div>
</div>
<?php endif; ?>

<!-- What's included -->
<div class="a-card" style="max-width:960px;margin-top:1.25rem">
    <div class="a-card-header"><h3>What's Included in the Sitemap</h3></div>
    <div class="a-card-body">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;font-size:.85rem">
            <div>
                <strong style="display:block;margin-bottom:.35rem;color:var(--a-accent)">Static Pages</strong>
                Home, Brokers, Compare, Calculators (all 4), Guides, News, Glossary, Advertise, About, Contact, Privacy, Risk Disclaimer
            </div>
            <div>
                <strong style="display:block;margin-bottom:.35rem;color:var(--a-accent)">Dynamic Content</strong>
                All active broker review pages &middot; Published guides &amp; news articles &middot; Glossary terms
            </div>
            <div>
                <strong style="display:block;margin-bottom:.35rem;color:var(--a-accent)">SEO Landing Pages</strong>
                All published <code>/best/{slug}</code> geo &amp; comparison pages (priority 0.85)
            </div>
        </div>
    </div>
</div>
