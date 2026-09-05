<?php
$defaults = [
    'site_name'        => 'Trader Gulf',
    'site_tagline'     => 'Independent Forex Broker Reviews',
    'contact_email'    => 'info@tradergulf.com',
    'twitter_url'      => '',
    'twitter_handle'   => '',
    'facebook_url'     => '',
    'linkedin_url'     => '',
    'youtube_url'      => '',
    'footer_risk_text' => 'Trading forex and CFDs carries a high level of risk and may not be suitable for all investors. You could lose some or all of your invested capital. Past performance is not indicative of future results.',
    'google_analytics' => '',
    'gsc_verification' => '',
    'og_image'         => '',
    'indexnow_key'     => '',
    'robots_txt'       => "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /admin/*\n\nSitemap: " . url('sitemap.xml'),
];
$s = array_merge($defaults, $settings ?? []);
?>

<div class="a-card" style="max-width:800px">
    <div class="a-card-header"><h2>Site Settings</h2></div>
    <div class="a-card-body">
    <form action="<?= url('admin/settings') ?>" method="post" class="a-form">
        <?= csrf_field() ?>

        <!-- ── Site Identity ───────────────────── -->
        <div class="section-divider">Site Identity</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label>Site Name</label>
                <input type="text" name="settings[site_name]" value="<?= e($s['site_name']) ?>">
            </div>
            <div class="a-field">
                <label>Tagline</label>
                <input type="text" name="settings[site_tagline]" value="<?= e($s['site_tagline']) ?>">
                <div class="hint">Shown in footer and used as default meta description.</div>
            </div>
        </div>

        <div class="a-field">
            <label>Contact Email</label>
            <input type="email" name="settings[contact_email]" value="<?= e($s['contact_email']) ?>">
        </div>

        <div class="a-field">
            <label>Default OG / Social Image URL</label>
            <input type="url" name="settings[og_image]" value="<?= e($s['og_image']) ?>"
                   placeholder="https://tradergulf.com/assets/img/og-default.jpg">
            <div class="hint">1200×630px image shown when pages are shared on social media. Recommended: upload to public/assets/img/ and paste the URL.</div>
        </div>

        <div class="a-field">
            <label>Footer Risk Warning Text</label>
            <textarea name="settings[footer_risk_text]" rows="3"><?= e($s['footer_risk_text']) ?></textarea>
        </div>

        <!-- ── Engagement ─────────────────────── -->
        <div class="section-divider">Engagement &amp; Contact</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label>Newsletter Enabled</label>
                <select name="settings[newsletter_enabled]">
                    <option value="1" <?= ($s['newsletter_enabled'] ?? '1') === '1' ? 'selected' : '' ?>>Enabled</option>
                    <option value="0" <?= ($s['newsletter_enabled'] ?? '1') === '0' ? 'selected' : '' ?>>Disabled</option>
                </select>
                <div class="hint">Show newsletter signup strip in footer.</div>
            </div>
            <div class="a-field">
                <label>AI Chatbot Enabled</label>
                <select name="settings[chatbot_enabled]">
                    <option value="1" <?= ($s['chatbot_enabled'] ?? '1') === '1' ? 'selected' : '' ?>>Enabled</option>
                    <option value="0" <?= ($s['chatbot_enabled'] ?? '1') === '0' ? 'selected' : '' ?>>Disabled</option>
                </select>
                <div class="hint">Show AI assistant chat widget on all public pages.</div>
            </div>
        </div>

        <!-- ── AI & Monetization ──────────────── -->
        <div class="section-divider">AI &amp; Monetization</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label>Claude API Key <span style="color:var(--text-muted);font-weight:400">(optional)</span></label>
                <input type="password" name="settings[claude_api_key]"
                       value="<?= e($s['claude_api_key'] ?? '') ?>"
                       placeholder="sk-ant-api03-…"
                       autocomplete="new-password">
                <div class="hint">
                    Enables the AI chatbot to use Claude (claude-haiku-4-5-20251001 model) for natural-language answers.
                    Without a key the chatbot uses built-in keyword matching. Get a key at
                    <a href="https://console.anthropic.com/" target="_blank" rel="noopener">console.anthropic.com</a>.
                </div>
            </div>
            <div class="a-field">
                <label>Google AdSense Publisher ID <span style="color:var(--text-muted);font-weight:400">(optional)</span></label>
                <input type="text" name="settings[adsense_publisher_id]"
                       value="<?= e($s['adsense_publisher_id'] ?? '') ?>"
                       placeholder="ca-pub-0000000000000000">
                <div class="hint">
                    Enables the AdSense script on all public pages (ads only serve once your site is approved).
                    Format: <code>ca-pub-XXXXXXXXXXXXXXXXX</code>.
                    Found in your <a href="https://adsense.google.com/" target="_blank" rel="noopener">AdSense account</a>.
                </div>
            </div>
        </div>

        <!-- ── Social Links ────────────────────── -->
        <div class="section-divider">Social Links</div>

        <div class="a-form-row a-form-row-2">
            <div class="a-field">
                <label>Twitter / X Profile URL</label>
                <input type="url" name="settings[twitter_url]" value="<?= e($s['twitter_url']) ?>"
                       placeholder="https://twitter.com/tradergulf">
            </div>
            <div class="a-field">
                <label>Twitter Handle (for meta tag)</label>
                <input type="text" name="settings[twitter_handle]" value="<?= e($s['twitter_handle']) ?>"
                       placeholder="@tradergulf">
                <div class="hint">Used in Twitter Card meta tag.</div>
            </div>
        </div>

        <div class="a-form-row a-form-row-3">
            <div class="a-field">
                <label>Facebook URL</label>
                <input type="url" name="settings[facebook_url]" value="<?= e($s['facebook_url']) ?>">
            </div>
            <div class="a-field">
                <label>LinkedIn URL</label>
                <input type="url" name="settings[linkedin_url]" value="<?= e($s['linkedin_url']) ?>">
            </div>
            <div class="a-field">
                <label>YouTube URL</label>
                <input type="url" name="settings[youtube_url]" value="<?= e($s['youtube_url']) ?>">
            </div>
        </div>

        <!-- ── Analytics ──────────────────────── -->
        <div class="section-divider">Google Analytics 4</div>

        <div class="a-field">
            <label>GA4 Measurement ID</label>
            <input type="text" name="settings[google_analytics]"
                   placeholder="G-XXXXXXXXXX"
                   value="<?= e($s['google_analytics']) ?>">
            <div class="hint">Paste your GA4 Measurement ID (starts with G-). Leave blank to disable. GA4 loads with Consent Mode v2 - analytics are only recorded after the visitor accepts cookies.</div>
        </div>

        <!-- ── Google Search Console ──────────── -->
        <div class="section-divider">Google Search Console</div>

        <div class="a-field">
            <label>GSC Verification Code</label>
            <input type="text" name="settings[gsc_verification]"
                   placeholder="aBcDeFgHiJkLmNoPqRsTuVwXyZ012345678"
                   value="<?= e($s['gsc_verification']) ?>">
            <div class="hint">
                In Google Search Console → Settings → Ownership Verification → HTML tag, copy only the <code>content="..."</code> value - not the full tag.
                Example: <code>aBcDeFgHiJkLmNoPqRsTuVwXyZ012345678</code>
            </div>
        </div>

        <!-- ── Bing / IndexNow ────────────────── -->
        <div class="section-divider">Bing Webmaster &amp; IndexNow</div>

        <div class="a-field">
            <label>IndexNow API Key</label>
            <input type="text" name="settings[indexnow_key]"
                   placeholder="your-indexnow-key-here"
                   value="<?= e($s['indexnow_key']) ?>">
            <div class="hint">
                Generate a key at <strong>Bing Webmaster Tools → IndexNow</strong>. Once saved, create a file at
                <code>public/<?= e($s['indexnow_key'] ?: 'your-key') ?>.txt</code> containing only the key.
                The Sitemap generator automatically pings IndexNow when you regenerate.
            </div>
        </div>

        <!-- ── Robots.txt ─────────────────────── -->
        <div class="section-divider">Robots.txt</div>

        <div class="a-field">
            <label>robots.txt Content</label>
            <textarea name="settings[robots_txt]" rows="10"
                      style="font-family:monospace;font-size:.82rem"><?= e($s['robots_txt']) ?></textarea>
            <div class="hint">
                Served at <a href="<?= url('robots.txt') ?>" target="_blank"><?= url('robots.txt') ?></a>.
                The Sitemap line is appended automatically if missing.
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-a btn-a-accent">Save Settings</button>
        </div>
    </form>
    </div>
</div>

<!-- Quick-links panel -->
<div class="a-card" style="max-width:800px;margin-top:1.25rem">
    <div class="a-card-header"><h3 style="font-size:1rem">SEO Quick Links</h3></div>
    <div class="a-card-body" style="display:flex;gap:.75rem;flex-wrap:wrap">
        <a href="<?= url('admin/sitemap') ?>" class="btn-a btn-a-outline">🗺️ Sitemap Generator</a>
        <a href="<?= url('sitemap.xml') ?>" target="_blank" class="btn-a btn-a-outline">View sitemap.xml</a>
        <a href="<?= url('robots.txt') ?>" target="_blank" class="btn-a btn-a-outline">View robots.txt</a>
    </div>
</div>
