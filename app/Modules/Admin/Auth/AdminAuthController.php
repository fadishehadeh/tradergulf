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
            Response::redirect('/admin');
        }

        View::render('admin/auth/login', [
            '_flash_error' => session()->getFlash('error'),
        ], null);
    }

    public function login(Request $request): void
    {
        $this->verifyCsrf();

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $validUser = $username === env('ADMIN_USER', 'admin');
        $validPass = password_verify($password, env('ADMIN_PASS_HASH', ''));

        if ($validUser && $validPass) {
            session()->regenerate();
            session()->set('admin_logged_in', true);
            session()->set('admin_user', $username);
            Response::redirect('/admin');
        }

        session()->flash('error', 'Invalid username or password.');
        Response::redirect('/admin/login');
    }

    public function logout(Request $request): void
    {
        session()->forget('admin_logged_in');
        session()->forget('admin_user');
        session()->flash('success', 'You have been logged out.');
        Response::redirect('/admin/login');
    }
}
