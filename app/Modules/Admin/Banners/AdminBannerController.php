<?php
declare(strict_types=1);

namespace App\Modules\Admin\Banners;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminBannerController extends AdminBaseController
{
    private const UPLOAD_DIR  = 'img/banners/';
    private const MAX_BYTES   = 3 * 1024 * 1024; // 3 MB
    private const ALLOWED_MIME = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    private const ALLOWED_EXT  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    public function index(Request $request): void
    {
        $this->requireAuth();
        $banners = $this->db()->fetchAll(
            'SELECT b.*, br.name AS broker_name
             FROM banners b
             LEFT JOIN brokers br ON b.broker_id = br.id
             ORDER BY b.sort_order ASC'
        );
        $this->render('admin/banners/index', [
            'pageTitle' => 'Banner Management',
            'banners'   => $banners,
        ]);
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();
        $banner = $this->db()->fetch('SELECT * FROM banners WHERE id = ?', [$id]);
        if (!$banner) {
            Response::redirect('admin/banners');
        }
        $brokers = $this->db()->fetchAll(
            'SELECT id, name FROM brokers WHERE is_active = 1 ORDER BY sort_order ASC'
        );
        $this->render('admin/banners/edit', [
            'pageTitle' => 'Edit Banner: ' . ($banner['label'] ?? ''),
            'banner'    => $banner,
            'brokers'   => $brokers,
            'action'    => url("admin/banners/{$id}/edit"),
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $banner = $this->db()->fetch('SELECT id, image_url FROM banners WHERE id = ?', [$id]);
        if (!$banner) {
            Response::redirect('admin/banners');
        }

        $brokerId = !empty($_POST['broker_id']) ? (int)$_POST['broker_id'] : null;

        // --- Handle image: upload takes priority over URL field ---
        $imageUrl = trim($_POST['image_url'] ?? '');

        $uploadErr = null;
        if (!empty($_FILES['banner_image']['name'])) {
            $result = $this->handleUpload($_FILES['banner_image'], (int)$id);
            if (isset($result['error'])) {
                $uploadErr = $result['error'];
            } else {
                // Delete old uploaded file if it was a local upload
                if (!empty($banner['image_url'])) {
                    $this->deleteOldUpload($banner['image_url']);
                }
                $imageUrl = $result['url'];
            }
        } elseif (isset($_POST['clear_image']) && $_POST['clear_image'] === '1') {
            if (!empty($banner['image_url'])) {
                $this->deleteOldUpload($banner['image_url']);
            }
            $imageUrl = '';
        }

        if ($uploadErr) {
            session()->flash('error', 'Image upload failed: ' . $uploadErr);
        } else {
            $this->db()->execute(
                'UPDATE banners
                 SET broker_id=?, link_url=?, image_url=?, badge_text=?, headline=?, sub_text=?,
                     cta_text=?, bg_style=?, is_active=?
                 WHERE id=?',
                [
                    $brokerId,
                    trim($_POST['link_url'] ?? ''),
                    $imageUrl,
                    trim($_POST['badge_text'] ?? ''),
                    trim($_POST['headline'] ?? ''),
                    trim($_POST['sub_text'] ?? ''),
                    trim($_POST['cta_text'] ?? 'Open Account →'),
                    trim($_POST['bg_style'] ?? ''),
                    isset($_POST['is_active']) ? 1 : 0,
                    (int)$id,
                ]
            );
            session()->flash('success', 'Banner updated successfully.');
        }

        Response::redirect('admin/banners');
    }

    // ── Private helpers ────────────────────────────────────────────────────

    private function handleUpload(array $file, int $bannerId): array
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'Upload error code ' . $file['error']];
        }
        if ($file['size'] > self::MAX_BYTES) {
            return ['error' => 'File too large (max 3 MB)'];
        }

        // Validate MIME via finfo (ignore $_FILES['type'] - it's client-supplied)
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        if (!in_array($mime, self::ALLOWED_MIME, true)) {
            return ['error' => 'Invalid file type. Allowed: JPG, PNG, WebP, GIF'];
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::ALLOWED_EXT, true)) {
            $ext = explode('/', $mime)[1]; // fallback to mime ext
        }

        $filename  = 'banner_' . $bannerId . '_' . time() . '.' . $ext;
        $uploadDir = base_path('public/assets/' . self::UPLOAD_DIR);
        $destPath  = $uploadDir . $filename;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $destPath)) {
            return ['error' => 'Could not save file to server'];
        }

        return ['url' => asset(self::UPLOAD_DIR . $filename)];
    }

    private function deleteOldUpload(string $url): void
    {
        // Only delete files we own (stored under our asset path)
        $assetBase = asset(self::UPLOAD_DIR);
        if (!str_starts_with($url, $assetBase)) {
            return; // external URL - don't touch
        }
        $filename = basename($url);
        $path     = base_path('public/assets/' . self::UPLOAD_DIR . $filename);
        if (is_file($path)) {
            @unlink($path);
        }
    }
}
