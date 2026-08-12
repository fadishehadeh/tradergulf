<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function render(string $template, array $data = [], string $layout = 'main'): void
    {
        View::render($template, $data, $layout);
    }

    protected function json(mixed $data, int $status = 200): never
    {
        Response::json($data, $status);
    }

    protected function redirect(string $path): never
    {
        Response::redirect($path);
    }

    protected function db(): Database
    {
        return $this->app->database();
    }

    protected function notFound(): never
    {
        Response::abort(404);
    }
}
