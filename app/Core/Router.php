<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    private Application $app;
    private array $routes = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function get(string $path, mixed $handler): void
    {
        $this->add(['GET', 'HEAD'], $path, $handler);
    }

    public function post(string $path, mixed $handler): void
    {
        $this->add(['POST'], $path, $handler);
    }

    public function add(array $methods, string $path, mixed $handler): void
    {
        $path = '/' . ltrim(rtrim($path, '/'), '/');
        foreach ($methods as $method) {
            $this->routes[] = [
                'method'  => $method,
                'path'    => $path,
                'handler' => $handler,
                'pattern' => $this->pathToPattern($path),
            ];
        }
    }

    public function dispatch(Request $request): void
    {
        $method = $request->method();
        $path   = $request->path();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;
            $matches = [];
            if (!preg_match($route['pattern'], $path, $matches)) continue;

            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            $this->runHandler($route['handler'], $params, $request);
            return;
        }

        Response::abort(404);
    }

    private function pathToPattern(string $path): string
    {
        $pattern = preg_quote($path, '#');
        $pattern = preg_replace_callback(
            '#\\\\\{([a-zA-Z_][a-zA-Z0-9_]*)\\\\\}#',
            static fn ($m) => "(?P<{$m[1]}>[^/]+)",
            $pattern
        );
        return "#^$pattern$#";
    }

    private function runHandler(mixed $handler, array $params, Request $request): void
    {
        if (is_array($handler)) {
            $controller = new $handler[0]($this->app);
            $method     = $handler[1];
            $controller->$method($request, ...array_values($params));
            return;
        }
        $handler($request);
    }
}
