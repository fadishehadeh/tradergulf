<?php
declare(strict_types=1);

namespace App\Modules\Admin\Settings;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminSettingsController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $rows     = $this->db()->fetchAll('SELECT key_name, value FROM settings');
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key_name']] = $row['value'];
        }

        $this->render('admin/settings', [
            'pageTitle' => 'Settings',
            'settings'  => $settings,
        ]);
    }

    public function update(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $pairs = $_POST['settings'] ?? [];
        foreach ($pairs as $key => $value) {
            $key   = preg_replace('/[^a-z0-9_]/', '', (string) $key);
            $value = trim((string) $value);
            if ($key === '') continue;
            $this->db()->execute(
                'INSERT INTO settings (key_name, value) VALUES (?,?)
                 ON DUPLICATE KEY UPDATE value = VALUES(value)',
                [$key, $value]
            );
        }

        session()->flash('success', 'Settings saved.');
        Response::redirect('/admin/settings');
    }
}
