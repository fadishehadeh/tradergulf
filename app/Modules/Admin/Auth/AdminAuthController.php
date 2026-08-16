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

        /* Brute-force protection: max 5 attempts per IP per 15 minutes */
        $ip      = $_SERVER['REMOTE_ADDR'] ?? '';
        $lockKey = '_login_attempts_' . md5($ip);
        $lockTs  = '_login_lockout_until_' . md5($ip);

        $lockUntil = session()->get($lockTs, 0);
        if ($lockUntil > time()) {
            $wait = (int) ceil(($lockUntil - time()) / 60);
            session()->flash('error', "Too many failed attempts. Try again in {$wait} minute(s).");
            Response::redirect('admin/login');
        }

        $admin = app()->database()->fetch(
            'SELECT * FROM admins WHERE email = ? AND is_active = 1',
            [$email]
        );

        if ($admin && password_verify($password, $admin['password_hash'])) {
            session()->set($lockKey, 0);
            session()->set($lockTs, 0);
            session()->regenerate();
            session()->set('admin_logged_in', true);
            session()->set('admin_user', $admin['email']);
            session()->set('admin_name', $admin['name'] ?: $admin['email']);
            session()->set('admin_id', (int) $admin['id']);
            Response::redirect('admin');
        }

        $attempts = (int) session()->get($lockKey, 0) + 1;
        session()->set($lockKey, $attempts);
        if ($attempts >= 5) {
            session()->set($lockTs, time() + 900); // 15-minute lockout
            session()->set($lockKey, 0);
            session()->flash('error', 'Too many failed attempts. Login locked for 15 minutes.');
        } else {
            session()->flash('error', 'Invalid email or password. Attempt ' . $attempts . ' of 5.');
        }
        Response::redirect('admin/login');
    }

    public function logout(Request $request): void
    {
        $this->verifyCsrf();
        session()->destroy();
        Response::redirect('admin/login');
    }
}
