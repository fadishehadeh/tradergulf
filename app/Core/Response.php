<?php
declare(strict_types=1);

namespace App\Core;

final class Response
{
    public static function redirect(string $path, int $status = 302): never
    {
        header('Location: ' . url($path), true, $status);
        exit;
    }

    public static function json(mixed $data, int $status = 200): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    public static function abort(int $status, string $message = ''): never
    {
        http_response_code($status);
        $titles = [404 => 'Page Not Found', 500 => 'Server Error', 403 => 'Forbidden'];
        $title  = $titles[$status] ?? "Error $status";

        if (is_file(base_path("app/Views/errors/$status.php"))) {
            extract(['title' => $title, 'message' => $message]);
            require base_path("app/Views/errors/$status.php");
            exit;
        }

        $safeTitle   = htmlspecialchars($title,   ENT_QUOTES, 'UTF-8');
        $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        echo "<!DOCTYPE html><html><head><title>$safeTitle</title></head>"
           . "<body style='font-family:sans-serif;text-align:center;padding:80px'>"
           . "<h1>$safeTitle</h1><p>$safeMessage</p><a href='/'>Go Home</a></body></html>";
        exit;
    }
}
