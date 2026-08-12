<?php
declare(strict_types=1);

namespace App\Modules\Admin\Admins;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminAdminsController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();
        $admins = $this->db()->fetchAll('SELECT id, email, name, is_active, created_at FROM admins ORDER BY id ASC');
        $this->render('admin/admins/index', ['pageTitle' => 'Admin Users', 'admins' => $admins]);
    }

    public function create(Request $request): void
    {
        $this->requireAuth();
        $this->render('admin/admins/form', ['pageTitle' => 'Add Admin User', 'admin' => null]);
    }

    public function store(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $email = strtolower(trim($_POST['email'] ?? ''));
        $name  = trim($_POST['name'] ?? '');
        $pass  = $_POST['password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            session()->flash('error', 'Invalid email address.');
            Response::redirect('admin/admins/create');
        }
        if (strlen($pass) < 8) {
            session()->flash('error', 'Password must be at least 8 characters.');
            Response::redirect('admin/admins/create');
        }

        $exists = $this->db()->fetchValue('SELECT COUNT(*) FROM admins WHERE email = ?', [$email]);
        if ($exists) {
            session()->flash('error', 'An admin with that email already exists.');
            Response::redirect('admin/admins/create');
        }

        $this->db()->execute(
            'INSERT INTO admins (email, name, password_hash) VALUES (?, ?, ?)',
            [$email, $name, password_hash($pass, PASSWORD_BCRYPT)]
        );

        session()->flash('success', "Admin {$email} added.");
        Response::redirect('admin/admins');
    }

    public function delete(Request $request, string $id = ''): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $id = (int) $id;
        if ($id === (int) session()->get('admin_id')) {
            session()->flash('error', 'You cannot delete your own account.');
            Response::redirect('admin/admins');
        }

        $this->db()->execute('DELETE FROM admins WHERE id = ?', [$id]);
        session()->flash('success', 'Admin removed.');
        Response::redirect('admin/admins');
    }

    public function changePassword(Request $request, string $id = ''): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $id      = (int) $id;
        $pass    = $_POST['password'] ?? '';
        if (strlen($pass) < 8) {
            session()->flash('error', 'Password must be at least 8 characters.');
            Response::redirect('admin/admins');
        }

        $this->db()->execute(
            'UPDATE admins SET password_hash = ? WHERE id = ?',
            [password_hash($pass, PASSWORD_BCRYPT), $id]
        );
        session()->flash('success', 'Password updated.');
        Response::redirect('admin/admins');
    }
}
