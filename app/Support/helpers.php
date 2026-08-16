<?php
declare(strict_types=1);

use App\Core\Application;

(static function (): void {
    static $loaded = false;
    if ($loaded) return;
    $loaded = true;

    $envPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
    if (!is_file($envPath)) return;

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$key, $value] = explode('=', $line, 2) + [null, ''];
        $key   = trim($key);
        $value = trim($value, '\'" ');
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
        putenv("$key=$value");
    }
})();

function env(string $key, mixed $default = null): mixed {
    return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
}

function app(): Application {
    return Application::getInstance();
}

function config(string $key, mixed $default = null): mixed {
    return app()->config($key, $default);
}

function base_path(string $path = ''): string {
    return app()->basePath($path);
}

function public_path(string $path = ''): string {
    $pub = base_path('public');
    return $path ? $pub . DIRECTORY_SEPARATOR . ltrim($path, '\\/') : $pub;
}

function web_path(string $path = ''): string {
    // WEB_ROOT env var lets production point to the real web root (separate from BASE_PATH/public)
    $root = env('WEB_ROOT') ?: public_path();
    $root = rtrim($root, '\\/');
    return $path ? $root . DIRECTORY_SEPARATOR . ltrim($path, '\\/') : $root;
}

function url(string $path = ''): string {
    $base = rtrim(config('app.url', 'http://localhost'), '/');
    $path = ltrim($path, '/');
    return $path ? "$base/$path" : $base;
}

function asset(string $path = ''): string {
    $full = public_path("assets/$path");
    $v    = is_file($full) ? filemtime($full) : 1;
    return url("assets/$path") . "?v=$v";
}

function e(mixed $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function slug_to_title(string $slug): string {
    return ucwords(str_replace(['-', '_'], ' ', $slug));
}

function session(): \App\Core\Session {
    return app()->session();
}

function csrf_token(): string {
    return session()->token();
}

function csrf_field(): string {
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function lang(): string { return 'en'; }

function is_rtl(): bool { return false; }

function t(string $key): string {
    static $strings = null;
    if ($strings === null) {
        $l = lang();
        $file = base_path('lang/' . $l . '.php');
        $strings = ($l !== 'en' && file_exists($file)) ? require $file : [];
    }
    return $strings[$key] ?? $key;
}

function ad_zone(string $slug): string {
    static $cache = [];
    if (array_key_exists($slug, $cache)) return $cache[$slug];
    try {
        $db = app()->database();
        $ad = $db->fetch(
            "SELECT a.*, z.width, z.height FROM ads a
             JOIN ad_zones z ON z.id = a.zone_id
             WHERE z.slug = ? AND a.is_active = 1
               AND (a.starts_at IS NULL OR a.starts_at <= CURDATE())
               AND (a.ends_at   IS NULL OR a.ends_at   >= CURDATE())
             ORDER BY a.id DESC LIMIT 1",
            [$slug]
        );
        if (!$ad) {
            return $cache[$slug] = '';
        }
        $db->execute('UPDATE ads SET impressions = impressions + 1 WHERE id = ?', [$ad['id']]);
        $href = url('ad/' . $ad['id'] . '/click');
        $alt  = e($ad['alt_text'] ?: ($ad['advertiser'] ? $ad['advertiser'] . ' advertisement' : 'Advertisement'));
        $html  = '<div style="text-align:center;padding:.75rem 0">';
        $html .= '<div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:.3rem">Advertisement</div>';
        $html .= '<a href="' . $href . '" target="_blank" rel="nofollow noopener sponsored">';
        $html .= '<img src="' . e($ad['image_url']) . '" alt="' . $alt . '" ';
        $html .= 'style="max-width:100%;height:auto;border-radius:6px;display:inline-block" loading="lazy">';
        $html .= '</a></div>';
        return $cache[$slug] = $html;
    } catch (\Throwable) {
        return $cache[$slug] = '';
    }
}

function lead_capture_form(string $brokerSlug, string $brokerName, string $affiliateUrl): string {
    if (!$affiliateUrl) return '';
    $id   = 'lcf_' . preg_replace('/[^a-z0-9]/', '', strtolower($brokerSlug));
    $dest = url('go/' . $brokerSlug);
    $sub  = url('newsletter/subscribe');
    $csrf = csrf_token();
    $nm   = htmlspecialchars($brokerName, ENT_QUOTES, 'UTF-8');
    return '<div style="background:linear-gradient(135deg,rgba(15,27,53,.96) 0%,rgba(9,17,42,.98) 100%);border:1px solid rgba(245,158,11,.25);border-radius:12px;padding:1.75rem 2rem;margin:2rem 0">'
        . '<div style="display:flex;gap:1.25rem;align-items:flex-start">'
        . '<div style="font-size:2rem;line-height:1">&#128273;</div>'
        . '<div style="flex:1">'
        . '<h3 style="color:#fff;font-size:1rem;margin:0 0 .25rem">Open an Account with ' . $nm . '</h3>'
        . '<p style="color:rgba(255,255,255,.6);font-size:.82rem;margin:0 0 1.1rem;line-height:1.5">Enter your email and we\'ll send you the latest welcome offer details before you visit the broker site.</p>'
        . '<form id="' . $id . '" style="display:flex;gap:.5rem;flex-wrap:wrap">'
        . '<input type="text" name="hp" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0" aria-hidden="true">'
        . '<input type="email" id="' . $id . '_em" placeholder="Your email address" required '
        .        'style="flex:1;min-width:200px;padding:.55rem .85rem;border-radius:7px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.08);color:#fff;font-size:.88rem;outline:none">'
        . '<button type="submit" style="padding:.55rem 1.25rem;background:var(--accent);color:var(--navy-dark);font-weight:700;font-size:.88rem;border:none;border-radius:7px;cursor:pointer;white-space:nowrap">'
        . 'Open Account &#8594;</button>'
        . '</form>'
        . '<p style="color:rgba(255,255,255,.3);font-size:.7rem;margin:.6rem 0 0">No spam. Trading involves significant risk of loss.</p>'
        . '</div></div></div>'
        . '<script>(function(){'
        . 'var f=document.getElementById(' . json_encode($id) . ');'
        . 'if(!f)return;'
        . 'f.addEventListener("submit",function(e){'
        . 'e.preventDefault();'
        . 'var em=document.getElementById(' . json_encode($id . '_em') . ').value.trim();'
        . 'if(em){var fd=new FormData();fd.append("email",em);fd.append("source",' . json_encode('lead_broker_' . $brokerSlug) . ');fd.append("_csrf",' . json_encode($csrf) . ');'
        . 'fetch(' . json_encode($sub) . ',{method:"POST",body:fd}).catch(function(){});}'
        . 'window.open(' . json_encode($dest) . ',"_blank","noopener,noreferrer");'
        . '});})();</script>';
}

function setting(string $key, string $default = ''): string {
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        try {
            $rows = app()->database()->fetchAll('SELECT key_name, value FROM settings');
            foreach ($rows as $r) {
                $cache[$r['key_name']] = $r['value'];
            }
        } catch (\Throwable) {}
    }
    return $cache[$key] ?? $default;
}
