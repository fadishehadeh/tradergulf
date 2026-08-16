<?php
declare(strict_types=1);

namespace App\Modules\Admin\Brokers;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminBrokerController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $brokers = $this->db()->fetchAll(
            'SELECT id, name, slug, overall_rating, headquarters, is_active
             FROM brokers ORDER BY overall_rating DESC'
        );

        $this->render('admin/brokers/index', [
            'pageTitle' => 'Brokers',
            'brokers'   => $brokers,
        ]);
    }

    public function create(Request $request): void
    {
        $this->requireAuth();

        $this->render('admin/brokers/form', [
            'pageTitle' => 'Add Broker',
            'broker'    => [],
            'action'    => url('admin/brokers/create'),
        ]);
    }

    public function store(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $data = $this->sanitizeBroker($_POST);
        $uploaded = $this->handleLogoUpload($data['slug']);
        if ($uploaded !== null) $data['logo'] = $uploaded;

        $this->db()->execute(
            'INSERT INTO brokers (name, slug, headquarters, founded_year, min_deposit,
             spread_eurusd, max_leverage, overall_rating, regulation, platforms,
             affiliate_url, logo, is_active, is_featured)
             VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [
                $data['name'], $data['slug'], $data['headquarters'], $data['founded_year'],
                $data['min_deposit'], $data['spread_eurusd'], $data['max_leverage'],
                $data['overall_rating'], $data['regulation'], $data['platforms'],
                $data['affiliate_url'], $data['logo'], $data['is_active'], $data['is_featured'],
            ]
        );

        session()->flash('success', "Broker \"{$data['name']}\" created.");
        Response::redirect('admin/brokers');
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();

        $broker = $this->db()->fetch('SELECT * FROM brokers WHERE id = ?', [(int) $id]);
        if (!$broker) $this->notFound();

        $this->render('admin/brokers/form', [
            'pageTitle' => 'Edit Broker',
            'broker'    => $broker,
            'action'    => url("admin/brokers/{$id}/edit"),
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $data = $this->sanitizeBroker($_POST);
        $uploaded = $this->handleLogoUpload($data['slug']);
        if ($uploaded !== null) $data['logo'] = $uploaded;

        $this->db()->execute(
            'UPDATE brokers SET name=?, slug=?, headquarters=?, founded_year=?, min_deposit=?,
             spread_eurusd=?, max_leverage=?, overall_rating=?, regulation=?, platforms=?,
             affiliate_url=?, logo=?, is_active=?, is_featured=? WHERE id=?',
            [
                $data['name'], $data['slug'], $data['headquarters'], $data['founded_year'],
                $data['min_deposit'], $data['spread_eurusd'], $data['max_leverage'],
                $data['overall_rating'], $data['regulation'], $data['platforms'],
                $data['affiliate_url'], $data['logo'], $data['is_active'], $data['is_featured'], (int) $id,
            ]
        );

        session()->flash('success', "Broker \"{$data['name']}\" updated.");
        Response::redirect('admin/brokers');
    }

    public function destroy(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $broker = $this->db()->fetch('SELECT name FROM brokers WHERE id = ?', [(int) $id]);
        if (!$broker) $this->notFound();

        $this->db()->execute('DELETE FROM broker_reviews WHERE broker_id = ?', [(int) $id]);
        $this->db()->execute('DELETE FROM brokers WHERE id = ?', [(int) $id]);

        session()->flash('success', "Broker \"{$broker['name']}\" deleted.");
        Response::redirect('admin/brokers');
    }

    private function handleLogoUpload(string $slug): ?string
    {
        $file = $_FILES['logo_file'] ?? null;
        if (!$file || $file['error'] !== UPLOAD_ERR_OK || $file['size'] === 0) {
            return null;
        }
        if ($file['size'] > 1_048_576) {
            session()->flash('error', 'Logo file exceeds 1 MB.');
            return null;
        }
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($allowed[$mime])) {
            session()->flash('error', 'Invalid logo file type. Use JPG, PNG, or WebP.');
            return null;
        }
        $ext  = $allowed[$mime];
        $name = preg_replace('/[^a-z0-9\-]/', '', strtolower($slug)) . '.' . $ext;
        $dest = base_path('public/assets/img/brokers/' . $name);
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return $name;
        }
        session()->flash('error', 'Failed to save logo file.');
        return null;
    }

    private function sanitizeBroker(array $post): array
    {
        $name = trim($post['name'] ?? '');
        $slug = trim($post['slug'] ?? '');
        if ($slug === '') {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
            $slug = trim($slug, '-');
        }

        return [
            'name'           => $name,
            'slug'           => $slug,
            'headquarters'   => trim($post['headquarters'] ?? ''),
            'founded_year'   => (int) ($post['founded_year'] ?? 0) ?: null,
            'min_deposit'    => (float) ($post['min_deposit'] ?? 0),
            'spread_eurusd'  => $post['spread_eurusd'] ?? '0.00',
            'max_leverage'   => trim($post['max_leverage'] ?? '1:100'),
            'overall_rating' => min(5, max(0, (float) ($post['overall_rating'] ?? 0))),
            'regulation'     => trim($post['regulation'] ?? ''),
            'platforms'      => trim($post['platforms'] ?? ''),
            'affiliate_url'  => trim($post['affiliate_url'] ?? ''),
            'logo'           => trim($post['logo'] ?? ''),
            'is_active'      => isset($post['is_active']) ? 1 : 0,
            'is_featured'    => isset($post['is_featured']) ? 1 : 0,
        ];
    }
}
