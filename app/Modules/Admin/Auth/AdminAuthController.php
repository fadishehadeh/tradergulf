<?php
declare(strict_types=1);

namespace App\Modules\Admin\Auth;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Modules\Admin\AdminBaseController;

class AdminAuthController extends AdminBaseController
{
    public function loginForm(Request $request): void
    {
        if (session()->get('admin_logged_in')) {
            Response::redirect('admin');
        }

        View::render('admin/auth/login', [
            '_flash_error' => session()->getFlash('error'),
        ], null);
    }

    public function login(Request $request): void
    {
        $this->verifyCsrf();

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $admin = app()->database()->fetch(
            'SELECT * FROM admins WHERE email = ? AND is_active = 1',
            [$email]
        );

        if ($admin && password_verify($password, $admin['password_hash'])) {
            session()->regenerate();
            session()->set('admin_logged_in', true);
            session()->set('admin_user', $admin['email']);
            session()->set('admin_name', $admin['name'] ?: $admin['email']);
            session()->set('admin_id', (int) $admin['id']);
            Response::redirect('admin');
        }

        session()->flash('error', 'Invalid email or password.');
        Response::redirect('admin/login');
    }

    public function logout(Request $request): void
    {
        session()->forget('admin_logged_in');
        session()->forget('admin_user');
        session()->forget('admin_name');
        session()->forget('admin_id');
        Response::redirect('admin/login');
    }
}
