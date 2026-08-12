<?php
declare(strict_types=1);

namespace App\Modules\Admin;

use App\Core\Controller;
use App\Core\Response;
use App\Core\View;

abstract class AdminBaseController extends Controller
{
    protected function requireAuth(): void
    {
        if (!session()->get('admin_logged_in')) {
            session()->flash('error', 'Please log in to access the admin panel.');
            Response::redirect('/admin/login');
        }
    }

    protected function render(string $template, array $data = [], string $layout = 'admin'): void
    {
        $data['_flash_success'] = session()->getFlash('success');
        $data['_flash_error']   = session()->getFlash('error');
        View::render($template, $data, $layout);
    }

    protected function verifyCsrf(): void
    {
        $token = $_POST['_csrf'] ?? '';
        if (!session()->verifyToken($token)) {
            session()->flash('error', 'Security token mismatch. Please try again.');
            Response::redirect($_SERVER['HTTP_REFERER'] ?? url('/admin'));
        }
    }
}
