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
