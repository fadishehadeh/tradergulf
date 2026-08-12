<?php
declare(strict_types=1);

namespace App\Core;

final class Request
{
    private array $get;
    private array $post;
    private array $server;

    public function __construct(array $get, array $post, array $server)
    {
        $this->get    = $get;
        $this->post   = $post;
        $this->server = $server;
    }

    public static function capture(): self
    {
        return new self($_GET, $_POST, $_SERVER);
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function path(): string
    {
        $uri  = parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $base = parse_url(env('APP_URL', 'http://localhost'), PHP_URL_PATH) ?? '';
        $base = rtrim($base, '/');

        if ($base && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }
        return $uri ?: '/';
    }

    public function query(string $key, mixed $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }
}
