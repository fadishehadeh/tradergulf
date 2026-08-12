<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;max-width:900px">

    <!-- Status Card -->
    <div class="a-card">
        <div class="a-card-header"><h3>Sitemap Status</h3></div>
        <div class="a-card-body">
            <?php if ($exists): ?>
            <table class="a-table" style="margin:0">
                <tr><td style="color:var(--muted-a)">Status</td><td><span class="badge badge-green">Generated</span></td></tr>
                <tr><td style="color:var(--muted-a)">Last Generated</td><td><?= e($lastMod) ?></td></tr>
                <tr><td style="color:var(--muted-a)">Total URLs</td><td><strong><?= $urlCount ?></strong></td></tr>
                <tr><td style="color:var(--muted-a)">Sitemap URL</td>
                    <td><a href="<?= e($sitemapUrl) ?>" target="_blank" style="word-break:break-all;font-size:.82rem"><?= e($sitemapUrl) ?></a></td>
                </tr>
            </table>
            <?php else: ?>
            <div style="text-align:center;padding:2rem;color:var(--muted-a)">
                <div style="font-size:2.5rem;margin-bottom:.75rem">🗺️</div>
                <p>No sitemap has been generated yet.</p>
                <p style="font-size:.85rem">Click <strong>Generate Sitemap</strong> to create sitemap.xml.</p>
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
                    📡 Ping Search Engines
                </button>
            </form>

            <a href="<?= e($sitemapUrl) ?>" target="_blank" class="btn-a btn-a-outline" style="width:100%;text-align:center">
                👁️ View sitemap.xml
            </a>
            <?php endif; ?>

            <a href="https://search.google.com/search-console" target="_blank" rel="noopener"
               class="btn-a btn-a-outline" style="width:100%;text-align:center">
                🔍 Open Google Search Console ↗
            </a>
            <a href="https://www.bing.com/webmasters" target="_blank" rel="noopener"
               class="btn-a btn-a-outline" style="width:100%;text-align:center">
                🔍 Open Bing Webmaster Tools ↗
            </a>
        </div>
    </div>

</div>

<!-- What's included -->
<div class="a-card" style="max-width:900px;margin-top:1.25rem">
    <div class="a-card-header"><h3>What the Sitemap Includes</h3></div>
    <div class="a-card-body">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;font-size:.88rem">
            <div>
                <strong style="display:block;margin-bottom:.35rem;color:var(--accent-a)">Static Pages</strong>
                Home, Brokers, Compare, Calculators, Guides, News, Glossary, About, Contact, Privacy Policy, Risk Disclaimer
            </div>
            <div>
                <strong style="display:block;margin-bottom:.35rem;color:var(--accent-a)">Dynamic Content</strong>
                All active broker review pages &middot; Published guides &middot; Published news articles &middot; Glossary terms
            </div>
            <div>
                <strong style="display:block;margin-bottom:.35rem;color:var(--accent-a)">SEO Landing Pages</strong>
                All published <code>/best/{slug}</code> geo/category/comparison pages (priority 0.85)
            </div>
        </div>
    </div>
</div>

<!-- GSC submission instructions -->
<div class="a-card" style="max-width:900px;margin-top:1.25rem">
    <div class="a-card-header"><h3>How to Submit to Google Search Console</h3></div>
    <div class="a-card-body" style="font-size:.88rem;line-height:1.7">
        <ol style="padding-left:1.25rem;margin:0">
            <li>Generate the sitemap above (writes <code>public/sitemap.xml</code>).</li>
            <li>Open <a href="https://search.google.com/search-console" target="_blank" rel="noopener">Google Search Console</a>.</li>
            <li>Go to <strong>Sitemaps</strong> in the left menu.</li>
            <li>Enter <code><?= e($sitemapUrl) ?></code> and click <strong>Submit</strong>.</li>
            <li>Return here and click <strong>Ping Search Engines</strong> to notify Google &amp; Bing immediately.</li>
        </ol>
        <p style="margin-top:.85rem;color:var(--muted-a)">
            <strong>Tip:</strong> Regenerate and re-ping whenever you publish new broker reviews, articles, or SEO pages.
            Google typically crawls within 24–48 hours after a successful ping.
        </p>
    </div>
</div>
