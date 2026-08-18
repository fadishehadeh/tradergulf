<?php
$_lang   = lang();
$_isRtl  = is_rtl();
$_dir    = $_isRtl ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?= $_lang ?>" dir="<?= $_dir ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary SEO -->
    <title><?= e($title ?? setting('site_name', 'Trader Gulf')) ?></title>
    <meta name="description" content="<?= e($metaDesc ?? setting('site_tagline', 'Independent forex broker reviews and comparisons for traders worldwide.')) ?>">
    <meta name="robots" content="<?= e($metaRobots ?? 'index, follow') ?>">
    <link rel="canonical" href="<?= e($canonical ?? url(ltrim(strtok($_SERVER['REQUEST_URI'] ?? '/', '?'), '/'))) ?>">

    <!-- Open Graph -->
    <?php
    $ogTitle = $title ?? setting('site_name', 'Trader Gulf');
    $ogDesc  = $metaDesc ?? setting('site_tagline', '');
    $ogImg   = $ogImage ?? setting('og_image', asset('img/og-default.svg'));
    $ogUrl   = $canonical ?? url(ltrim(strtok($_SERVER['REQUEST_URI'] ?? '/', '?'), '/'));
    ?>
    <meta property="og:site_name"   content="<?= e(setting('site_name', 'Trader Gulf')) ?>">
    <meta property="og:type"        content="<?= e($ogType ?? 'website') ?>">
    <meta property="og:title"       content="<?= e($ogTitle) ?>">
    <meta property="og:description" content="<?= e($ogDesc) ?>">
    <meta property="og:url"         content="<?= e($ogUrl) ?>">
    <meta property="og:locale"      content="en_US">
    <?php if ($ogImg): ?>
    <meta property="og:image"       content="<?= e($ogImg) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height"content="630">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <?php if (setting('twitter_handle')): ?>
    <meta name="twitter:site"        content="<?= e(setting('twitter_handle')) ?>">
    <?php endif; ?>
    <meta name="twitter:title"       content="<?= e($ogTitle) ?>">
    <meta name="twitter:description" content="<?= e($ogDesc) ?>">
    <?php if ($ogImg): ?>
    <meta name="twitter:image"       content="<?= e($ogImg) ?>">
    <?php endif; ?>

    <!-- Google Search Console verification -->
    <?php if (setting('gsc_verification')): ?>
    <meta name="google-site-verification" content="<?= e(setting('gsc_verification')) ?>">
    <?php endif; ?>

    <!-- GA4 Consent Mode v2 -->
    <?php if (setting('google_analytics')): ?>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('consent', 'default', {analytics_storage:'denied',ad_storage:'denied',wait_for_update:500});
    (function(){var c=localStorage.getItem('tg_cookie_consent');if(c==='accepted')gtag('consent','update',{analytics_storage:'granted'});})();
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(setting('google_analytics')) ?>"></script>
    <script>
    gtag('js', new Date());
    gtag('config', '<?= e(setting('google_analytics')) ?>', {
        anonymize_ip: true
    });
    </script>
    <?php endif; ?>

    <!-- Google AdSense -->
    <?php if (setting('adsense_publisher_id')): ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?= e(setting('adsense_publisher_id')) ?>" crossorigin="anonymous"></script>
    <?php endif; ?>

    <!-- Organization Schema -->
    <?php
    $sameAs = array_values(array_filter([
        setting('facebook_url'), setting('twitter_url'),
        setting('linkedin_url'), setting('youtube_url'),
    ]));
    $orgSchema = ['@context'=>'https://schema.org','@type'=>'Organization',
        'name'=>setting('site_name','Trader Gulf'),'url'=>url(),
        'description'=>setting('site_tagline','Independent forex broker reviews and comparisons for traders worldwide.')];
    if ($ogImg) $orgSchema['logo'] = ['@type'=>'ImageObject','url'=>$ogImg];
    if ($sameAs) $orgSchema['sameAs'] = $sameAs;
    if (setting('contact_email')) $orgSchema['contactPoint'] = ['@type'=>'ContactPoint','contactType'=>'customer support','email'=>setting('contact_email')];
    ?>
    <script type="application/ld+json"><?= json_encode($orgSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>

    <!-- WebSite Schema -->
    <script type="application/ld+json"><?= json_encode([
        '@context'=>'https://schema.org','@type'=>'WebSite',
        'name'=>setting('site_name','Trader Gulf'),'url'=>url(),
        'description'=>setting('site_tagline','Independent forex broker reviews.'),
        'potentialAction'=>['@type'=>'SearchAction',
            'target'=>['@type'=>'EntryPoint','urlTemplate'=>url('search').'?q={search_term_string}'],
            'query-input'=>'required name=search_term_string'],
        'publisher'=>['@type'=>'Organization','name'=>setting('site_name','Trader Gulf'),'url'=>url()],
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script>

    <?php if (isset($headSchemas)) echo $headSchemas; ?>

    <!-- Preconnect to critical third parties -->
    <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
    <link rel="preconnect" href="https://www.google-analytics.com" crossorigin>
    <link rel="preconnect" href="https://s3.tradingview.com" crossorigin>
    <?php if (setting('adsense_publisher_id')): ?>
    <link rel="preconnect" href="https://pagead2.googlesyndication.com" crossorigin>
    <?php endif; ?>

    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= asset('img/favicon.svg') ?>">
</head>
<body class="<?= $_isRtl ? 'rtl' : '' ?>">
<div class="page-wrapper">

<!-- ========== TICKER TAPE ========== -->
<div class="ticker-wrap" id="tickerWrap">
    <div class="ticker-track" id="tickerTrack">
        <div class="ticker-item ticker-placeholder">
            <span class="ticker-label">EUR/USD</span><span class="ticker-price">—</span>
            <span class="ticker-label">GBP/USD</span><span class="ticker-price">—</span>
            <span class="ticker-label">USD/JPY</span><span class="ticker-price">—</span>
            <span class="ticker-label">XAU/USD</span><span class="ticker-price">—</span>
            <span class="ticker-label">BTC/USD</span><span class="ticker-price">—</span>
        </div>
    </div>
</div>

<!-- ========== HEADER ========== -->
<header class="site-header">
    <div class="container header-inner">
        <a href="<?= url() ?>" class="site-logo">
            <svg width="38" height="38" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0" aria-hidden="true">
                <rect width="32" height="32" rx="7" fill="#0f1b35"/>
                <rect x="3"    y="24" width="5.5" height="7"  rx="1.5" fill="#f59e0b" opacity="0.4"/>
                <rect x="10.5" y="18" width="5.5" height="13" rx="1.5" fill="#f59e0b" opacity="0.65"/>
                <rect x="18"   y="11" width="5.5" height="20" rx="1.5" fill="#f59e0b" opacity="0.85"/>
                <rect x="25.5" y="4"  width="5.5" height="27" rx="1.5" fill="#f59e0b"/>
                <polyline points="5.75,24 13.25,18 20.75,11 28.25,4" fill="none" stroke="white" stroke-width="1.2" stroke-opacity="0.2" stroke-linecap="round"/>
            </svg>
            <div class="site-logo-text">TRADER<span>GULF</span></div>
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">&#9776;</button>

        <nav class="site-nav" id="siteNav">
            <a href="<?= url('brokers') ?>"><?= t('Brokers') ?></a>
            <a href="<?= url('compare') ?>"><?= t('Compare') ?></a>
            <a href="<?= url('calculators') ?>"><?= t('Calculators') ?></a>

            <div class="nav-dropdown" id="navDropGuides">
                <button class="nav-dropdown-toggle" aria-expanded="false" aria-haspopup="true">
                    <?= t('Educational Guides') ?> <span class="nav-caret" aria-hidden="true"></span>
                </button>
                <div class="nav-dropdown-menu" role="menu">
                    <a href="<?= url('guides') ?>" role="menuitem"><?= t('All Guides') ?></a>
                    <a href="<?= url('glossary') ?>" role="menuitem"><?= t('Forex Glossary') ?></a>
                </div>
            </div>

            <div class="nav-dropdown" id="navDropMarket">
                <button class="nav-dropdown-toggle" aria-expanded="false" aria-haspopup="true">
                    <?= t('Market Updates') ?> <span class="nav-caret" aria-hidden="true"></span>
                </button>
                <div class="nav-dropdown-menu" role="menu">
                    <a href="<?= url('economic-calendar') ?>" role="menuitem"><?= t('Economic Calendar') ?></a>
                    <a href="<?= url('news') ?>" role="menuitem"><?= t('Market News') ?></a>
                </div>
            </div>

            <a href="<?= url('compare') ?>" class="btn btn-primary btn-sm nav-cta"><?= t('Compare Now') ?></a>
            <a href="<?= url('search') ?>" class="nav-search-btn" aria-label="Search" title="Search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="18" height="18" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </a>
        </nav>
    </div>
</header>

<!-- ========== MAIN ========== -->
<main>
    <?= $content ?>
</main>

<!-- ========== FOOTER ========== -->
<footer class="site-footer">
    <div class="container">

        <div class="footer-grid">
            <div class="footer-brand">
                <span class="site-logo-text" style="font-size:1.2rem">Trader<span>Gulf</span></span>
                <p><?= e(setting('site_tagline', 'Independent forex broker reviews and comparisons for traders worldwide.')) ?></p>
                <?php
                $socials = ['twitter_url'=>['X','𝕏'],'facebook_url'=>['Facebook','f'],'linkedin_url'=>['LinkedIn','in'],'youtube_url'=>['YouTube','▶']];
                $hasSocials = false;
                foreach ($socials as $k=>[$l,$i]) if (setting($k)) { $hasSocials=true; break; }
                if ($hasSocials):
                ?>
                <div style="display:flex;gap:.65rem;margin-top:.85rem;<?= $_isRtl ? 'flex-direction:row-reverse' : '' ?>">
                <?php foreach ($socials as $key=>[$label,$icon]): ?>
                    <?php if (setting($key)): ?>
                    <a href="<?= e(setting($key)) ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= e($label) ?>"
                       style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;background:rgba(255,255,255,.12);color:#fff;font-size:.8rem;font-weight:700;text-decoration:none">
                        <?= $icon ?>
                    </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="footer-col">
                <h4><?= t('Brokers') ?></h4>
                <a href="<?= url('brokers') ?>"><?= t('All Reviews') ?></a>
                <a href="<?= url('compare') ?>"><?= t('Compare Brokers') ?></a>
                <a href="<?= url('islamic-forex-brokers') ?>">Islamic Accounts</a>
            </div>
            <div class="footer-col">
                <h4>Brokers by Country</h4>
                <a href="<?= url('forex-brokers-in/uae') ?>">🇦🇪 UAE</a>
                <a href="<?= url('forex-brokers-in/saudi-arabia') ?>">🇸🇦 Saudi Arabia</a>
                <a href="<?= url('forex-brokers-in/kuwait') ?>">🇰🇼 Kuwait</a>
                <a href="<?= url('forex-brokers-in/qatar') ?>">🇶🇦 Qatar</a>
                <a href="<?= url('forex-brokers-in/bahrain') ?>">🇧🇭 Bahrain</a>
                <a href="<?= url('forex-brokers-in/oman') ?>">🇴🇲 Oman</a>
                <a href="<?= url('forex-brokers-in/egypt') ?>">🇪🇬 Egypt</a>
            </div>
            <div class="footer-col">
                <h4><?= t('Educational Guides') ?></h4>
                <a href="<?= url('guides') ?>"><?= t('All Guides') ?></a>
                <a href="<?= url('glossary') ?>"><?= t('Forex Glossary') ?></a>
                <a href="<?= url('best/best-low-spread-forex-brokers-mena') ?>">Low Spread Brokers</a>
            </div>
            <div class="footer-col">
                <h4><?= t('Market Updates') ?></h4>
                <a href="<?= url('economic-calendar') ?>"><?= t('Economic Calendar') ?></a>
                <a href="<?= url('news') ?>"><?= t('Market News') ?></a>
                <a href="<?= url('currency-converter') ?>">Currency Converter</a>
                <a href="<?= url('calculators') ?>"><?= t('Calculators') ?></a>
                <h4 style="margin-top:1.25rem"><?= t('Company') ?></h4>
                <a href="<?= url('about') ?>"><?= t('About Us') ?></a>
                <a href="<?= url('contact') ?>"><?= t('Contact') ?></a>
                <a href="<?= url('advertise') ?>">Advertise</a>
                <a href="<?= url('affiliate-disclosure') ?>">Affiliate Disclosure</a>
                <a href="<?= url('terms-of-service') ?>">Terms</a>
                <a href="<?= url('privacy-policy') ?>"><?= t('Privacy Policy') ?></a>
            </div>
        </div>
        <div class="footer-bottom">
            <div>&copy; <?= date('Y') ?> <?= e(setting('site_name', 'Trader Gulf')) ?>. <?= t('All rights reserved') ?>.</div>
            <div class="risk-warning">
                <strong><?= t('Risk Warning') ?>:</strong>
                <?= e(setting('footer_risk_text', 'Trading forex and CFDs carries a high level of risk and may not be suitable for all investors. You could lose some or all of your invested capital.')) ?>
            </div>
        </div>
    </div>
</footer>

</div><!-- .page-wrapper -->

<!-- ========== AI CHATBOT ========== -->
<?php if (setting('chatbot_enabled', '1') === '1'): ?>
<button id="chatToggle" class="chat-toggle-btn" aria-label="Chat assistant" title="Ask our AI assistant">
    <svg id="chatIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="26" height="26">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
    </svg>
    <svg id="chatCloseIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="22" height="22" style="display:none">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
    </svg>
</button>

<div id="chatPanel" class="chat-panel" style="display:none">
    <div class="chat-header">
        <div class="chat-header-info">
            <div class="chat-avatar">TG</div>
            <div>
                <strong>Trader Gulf Assistant</strong>
                <div class="chat-status">● Online</div>
            </div>
        </div>
        <button id="chatClose2" class="chat-header-close" aria-label="Close">&times;</button>
    </div>
    <div class="chat-messages" id="chatMessages">
        <div class="chat-msg chat-msg-bot">
            <div class="chat-bubble">Hi! I'm the Trader Gulf assistant. Ask me about forex brokers, Islamic accounts, trading tools, or anything else on this site 👋</div>
        </div>
    </div>
    <div class="chat-quick-btns" id="chatQuickBtns">
        <button class="chat-quick" data-q="Which brokers offer Islamic accounts?">Islamic accounts</button>
        <button class="chat-quick" data-q="What are the best brokers for UAE traders?">UAE brokers</button>
        <button class="chat-quick" data-q="Compare top brokers for low spreads">Low spreads</button>
        <button class="chat-quick" data-q="How do I use the broker comparison tool?">Compare tool</button>
    </div>
    <div class="chat-input-row">
        <input type="text" id="chatInput" class="chat-input" placeholder="Ask a question…" autocomplete="off">
        <button id="chatSend" class="chat-send-btn" aria-label="Send">
            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
        </button>
    </div>
</div>
<?php endif; ?>

<!-- ========== MOBILE BOTTOM NAV ========== -->
<nav class="mobile-bottom-nav" aria-label="Mobile navigation">
    <a href="<?= url() ?>" class="mbn-item" data-page="">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/><polyline points="9 21 9 12 15 12 15 21"/></svg>
        <span>Home</span>
    </a>
    <a href="<?= url('brokers') ?>" class="mbn-item" data-page="brokers">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
        <span>Brokers</span>
    </a>
    <a href="<?= url('compare') ?>" class="mbn-item" data-page="compare">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="3" x2="12" y2="21"/><path d="M3 9l9-6 9 6"/><path d="M3 15l9 6 9-6"/></svg>
        <span>Compare</span>
    </a>
    <a href="<?= url('calculators') ?>" class="mbn-item" data-page="calculators">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="10" y2="10"/><line x1="14" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="10" y2="14"/><line x1="14" y1="14" x2="16" y2="14"/><line x1="8" y1="18" x2="10" y2="18"/><line x1="14" y1="18" x2="16" y2="18"/></svg>
        <span>Calculators</span>
    </a>
    <a href="<?= url('search') ?>" class="mbn-item" data-page="search">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <span>Search</span>
    </a>
</nav>

<!-- ========== COOKIE CONSENT ========== -->
<div id="cookieBar" style="
    position:fixed;bottom:0;left:0;right:0;z-index:999;
    background:var(--navy-dark);border-top:2px solid var(--accent);
    padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;
    transform:translateY(100%);transition:transform .4s cubic-bezier(.22,.61,.36,1);
    box-shadow:0 -4px 24px rgba(0,0,0,.25);">
    <div style="display:flex;align-items:center;gap:.85rem;flex:1;min-width:220px">
        <span style="font-size:1.5rem">🍪</span>
        <p style="margin:0;font-size:.88rem;color:rgba(255,255,255,.85);line-height:1.5">
            We use cookies to improve your experience and analyse site traffic.
            By clicking <strong style="color:#fff">Accept</strong>, you consent to our use of cookies.
            <a href="<?= url('privacy-policy') ?>" style="color:var(--accent);text-decoration:underline">Privacy Policy</a>
        </p>
    </div>
    <div style="display:flex;gap:.65rem;flex-shrink:0">
        <button id="cookieDecline" style="background:transparent;border:1px solid rgba(255,255,255,.3);color:rgba(255,255,255,.7);font-size:.82rem;font-weight:600;padding:.45rem 1rem;border-radius:5px;cursor:pointer">Decline</button>
        <button id="cookieAccept" style="background:var(--accent);border:none;color:#0f3d25;font-size:.88rem;font-weight:700;padding:.45rem 1.25rem;border-radius:5px;cursor:pointer">Accept All</button>
    </div>
</div>

<script>
document.getElementById('navToggle').addEventListener('click', function() {
    document.getElementById('siteNav').classList.toggle('open');
});

// Nav dropdowns
(function() {
    document.querySelectorAll('.nav-dropdown').forEach(function(dd) {
        var btn = dd.querySelector('.nav-dropdown-toggle');
        var menu = dd.querySelector('.nav-dropdown-menu');
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var isOpen = dd.classList.contains('open');
            document.querySelectorAll('.nav-dropdown.open').forEach(function(o) {
                o.classList.remove('open');
                o.querySelector('.nav-dropdown-toggle').setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                dd.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });
    document.addEventListener('click', function() {
        document.querySelectorAll('.nav-dropdown.open').forEach(function(o) {
            o.classList.remove('open');
            o.querySelector('.nav-dropdown-toggle').setAttribute('aria-expanded', 'false');
        });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.nav-dropdown.open').forEach(function(o) {
                o.classList.remove('open');
                o.querySelector('.nav-dropdown-toggle').setAttribute('aria-expanded', 'false');
            });
        }
    });
})();

(function() {
    var path = window.location.pathname.split('/')[1] || '';
    document.querySelectorAll('.site-nav a:not(.lang-btn)').forEach(function(a) {
        var href = a.getAttribute('href').split('/').filter(Boolean)[0] || '';
        if (path && path === href) a.classList.add('active');
    });
})();


// ── Click tracking (GA4 custom events) ──────────────────────────────────────
(function() {
    function trackEvent(category, label) {
        if (typeof gtag === 'function') {
            gtag('event', category, {event_category: 'engagement', event_label: label});
        }
    }
    document.addEventListener('click', function(e) {
        var el = e.target.closest('[data-track]');
        if (!el) return;
        trackEvent(el.dataset.track, el.dataset.trackLabel || document.title);
    });
})();

// ── Cookie consent + GA4 ────────────────────────────────────────────────────
(function() {
    var bar = document.getElementById('cookieBar');
    function updateConsent(granted) {
        if (typeof gtag === 'function') {
            gtag('consent', 'update', {analytics_storage: granted ? 'granted' : 'denied', ad_storage: granted ? 'granted' : 'denied'});
        }
    }
    function nudgeFloaters(up) {
        var el = document.getElementById('chatToggle');
        if (el) el.style.bottom = up ? 'calc(1.5rem + ' + (bar.offsetHeight + 12) + 'px)' : '';
    }
    if (!localStorage.getItem('tg_cookie_consent')) {
        setTimeout(function() { bar.style.transform = 'translateY(0)'; nudgeFloaters(true); }, 800);
    }
    function dismiss() { bar.style.transform = 'translateY(120%)'; nudgeFloaters(false); }
    document.getElementById('cookieAccept').addEventListener('click', function() {
        localStorage.setItem('tg_cookie_consent', 'accepted');
        updateConsent(true); dismiss();
    });
    document.getElementById('cookieDecline').addEventListener('click', function() {
        localStorage.setItem('tg_cookie_consent', 'declined');
        updateConsent(false); dismiss();
    });
})();


// ── AI Chatbot ───────────────────────────────────────────────────────────────
(function() {
    var toggle   = document.getElementById('chatToggle');
    var panel    = document.getElementById('chatPanel');
    var close2   = document.getElementById('chatClose2');
    var input    = document.getElementById('chatInput');
    var sendBtn  = document.getElementById('chatSend');
    var messages = document.getElementById('chatMessages');
    var quickBtns= document.getElementById('chatQuickBtns');
    var icon     = document.getElementById('chatIcon');
    var closeIco = document.getElementById('chatCloseIcon');
    if (!toggle) return;

    var isOpen = false;
    function openChat() {
        panel.style.display = 'flex';
        isOpen = true;
        icon.style.display = 'none';
        closeIco.style.display = '';
        setTimeout(function() { input.focus(); }, 100);
    }
    function closeChat() {
        panel.style.display = 'none';
        isOpen = false;
        icon.style.display = '';
        closeIco.style.display = 'none';
    }

    toggle.addEventListener('click', function() { isOpen ? closeChat() : openChat(); });
    if (close2) close2.addEventListener('click', closeChat);

    function addMsg(text, role) {
        var div = document.createElement('div');
        div.className = 'chat-msg chat-msg-' + role;
        var bubble = document.createElement('div');
        bubble.className = 'chat-bubble';
        bubble.innerHTML = text;
        div.appendChild(bubble);
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function addTyping() {
        var div = document.createElement('div');
        div.className = 'chat-msg chat-msg-bot';
        div.id = 'chatTyping';
        div.innerHTML = '<div class="chat-bubble chat-typing"><span></span><span></span><span></span></div>';
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }
    function removeTyping() {
        var t = document.getElementById('chatTyping');
        if (t) t.remove();
    }

    function sendMessage(text) {
        text = text.trim();
        if (!text) return;
        if (quickBtns) quickBtns.style.display = 'none';
        addMsg(text, 'user');
        input.value = '';
        addTyping();

        fetch(<?= json_encode(url('api/chat')) ?>, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({message: text})
        })
        .then(function(r) { return r.json(); })
        .then(function(d) {
            removeTyping();
            addMsg(d.reply || 'Sorry, something went wrong. Please try again.', 'bot');
        })
        .catch(function() {
            removeTyping();
            addMsg('Sorry, I couldn\'t reach the server. Please try again or use our <a href="/contact">Contact Form</a>.', 'bot');
        });
    }

    sendBtn.addEventListener('click', function() { sendMessage(input.value); });
    input.addEventListener('keydown', function(e) { if (e.key === 'Enter') sendMessage(input.value); });

    if (quickBtns) {
        quickBtns.querySelectorAll('.chat-quick').forEach(function(btn) {
            btn.addEventListener('click', function() { sendMessage(btn.dataset.q); });
        });
    }
})();
</script>
<?php if (isset($pageScripts)) echo $pageScripts; ?>
<script>
(function() {
    var seg = window.location.pathname.split('/').filter(Boolean)[0] || '';
    document.querySelectorAll('.mbn-item').forEach(function(a) {
        if (a.dataset.page === seg) a.classList.add('active');
    });
})();
</script>

<!-- ── Self-hosted ticker ─────────────────────────────── -->
<script>
(function() {
    function buildTicker(rates) {
        var doubled = rates.concat(rates); // duplicate for seamless loop
        var html = '';
        doubled.forEach(function(r) {
            html += '<span class="ticker-item">'
                  + '<span class="ticker-label">' + r.label + '</span>'
                  + '<span class="ticker-price">' + r.price + '</span>'
                  + '<span class="ticker-change ' + (r.up ? 'up' : 'down') + '">'
                  + r.changePct + '</span>'
                  + '</span>';
        });
        var track = document.getElementById('tickerTrack');
        if (!track) return;
        var inner = document.createElement('div');
        inner.className = 'ticker-animated';
        inner.innerHTML = html;
        track.innerHTML = '';
        track.appendChild(inner);
        // Adjust animation duration by item count
        var dur = Math.max(20, rates.length * 5);
        inner.style.animationDuration = dur + 's';
    }

    function loadTicker() {
        fetch('/api/ticker')
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (Array.isArray(data) && data.length) buildTicker(data);
            })
            .catch(function() {});
    }

    loadTicker();
    setInterval(loadTicker, 300000); // refresh every 5 min
})();
</script>

<!-- ── Self-hosted news widget ────────────────────────── -->
<script>
(function() {
    var grid = document.getElementById('newsWidgetGrid');
    if (!grid) return;

    fetch('/api/news-widget')
        .then(function(r) { return r.json(); })
        .then(function(items) {
            if (!Array.isArray(items) || !items.length) {
                grid.innerHTML = '<p style="color:var(--muted);text-align:center;padding:2rem">'
                    + 'No news available at this time. <a href="<?= url('news') ?>">Browse our news archive</a>.</p>';
                return;
            }
            var html = '';
            items.forEach(function(item) {
                html += '<div class="news-widget-card">'
                      + '<div class="news-widget-date">' + item.date + '</div>'
                      + '<h3><a href="' + item.url + '" target="_blank" rel="noopener noreferrer">'
                      + item.title + '</a></h3>';
                if (item.excerpt) html += '<p>' + item.excerpt + '</p>';
                html += '</div>';
            });
            grid.innerHTML = html;
        })
        .catch(function() {
            grid.innerHTML = '';
        });
})();
</script>
</body>
</html>
