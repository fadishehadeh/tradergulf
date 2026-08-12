<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    private static Application $app;

    public static function setApplication(Application $app): void
    {
        self::$app = $app;
    }

    public static function render(string $template, array $data = [], ?string $layout = 'main'): void
    {
        $template = str_replace('.', '/', $template);
        $viewFile = base_path("app/Views/$template.php");

        if (!is_file($viewFile)) {
            Response::abort(500, "View not found: $template");
        }

        extract($data, EXTR_SKIP);
        ob_start();
        require $viewFile;
        $content = (string) ob_get_clean();

        if ($layout !== null) {
            $layoutFile = base_path("app/Views/layouts/$layout.php");
            if (!is_file($layoutFile)) {
                Response::abort(500, "Layout not found: $layout");
            }
            require $layoutFile;
        } else {
            echo $content;
        }
    }
}
