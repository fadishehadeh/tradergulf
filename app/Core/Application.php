<?php
declare(strict_types=1);

namespace App\Core;

final class Application
{
    private static ?self $instance = null;

    private string $basePath;
    private array   $config = [];
    private Database $database;
    private Router   $router;
    private Session  $session;

    public function __construct(string $basePath)
    {
        $this->basePath  = rtrim($basePath, DIRECTORY_SEPARATOR);
        self::$instance  = $this;

        $this->loadConfig();
        date_default_timezone_set($this->config('app.timezone', 'UTC'));

        $this->session  = new Session();
        $this->database = new Database((array) $this->config('database', []));
        $this->router   = new Router($this);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            throw new \RuntimeException('Application not initialized');
        }
        return self::$instance;
    }

    public function basePath(string $path = ''): string
    {
        return $path
            ? $this->basePath . DIRECTORY_SEPARATOR . ltrim($path, '\\/')
            : $this->basePath;
    }

    public function config(string $key, mixed $default = null): mixed
    {
        $keys  = explode('.', $key);
        $value = $this->config;
        foreach ($keys as $k) {
            if (!isset($value[$k])) return $default;
            $value = $value[$k];
        }
        return $value ?? $default;
    }

    public function database(): Database { return $this->database; }
    public function router(): Router     { return $this->router; }
    public function session(): Session   { return $this->session; }

    public function run(): void
    {
        View::setApplication($this);
        $this->applySecurityHeaders();
        $request = Request::capture();
        $this->trackPageView($request);
        $this->router->dispatch($request);
    }

    private function trackPageView(Request $request): void
    {
        if ($request->method() !== 'GET') return;
        $path = $request->path();
        if (str_starts_with($path, '/admin') || $path === '/feed' || str_starts_with($path, '/go/')) return;

        $ua  = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $bot = (int)(bool) preg_match('/bot|crawl|slurp|spider|mediapartners|facebookexternalhit|whatsapp|curl|python|wget|headless/i', $ua);

        $ip      = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '')[0];
        $referer = substr($_SERVER['HTTP_REFERER'] ?? '', 0, 512);

        try {
            $this->database->execute(
                'INSERT INTO page_views (path, referrer, ip, bot) VALUES (?, ?, ?, ?)',
                [substr($path, 0, 512), $referer, substr(trim($ip), 0, 45), $bot]
            );
        } catch (\Throwable) {}
    }

    private function loadConfig(): void
    {
        $this->config = [
            'app'      => require $this->basePath('config/app.php'),
            'database' => require $this->basePath('config/database.php'),
        ];
    }

    private function applySecurityHeaders(): void
    {
        header('X-Content-Type-Options: nosniff', true);
        header('X-Frame-Options: SAMEORIGIN', true);
        header('Referrer-Policy: strict-origin-when-cross-origin', true);
    }
}
