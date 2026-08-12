<?php
declare(strict_types=1);

namespace App\Modules\Admin\Seo;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminSeoController extends AdminBaseController
{
    private function allBrokers(): array
    {
        return $this->db()->fetchAll(
            'SELECT id, name FROM brokers WHERE is_active = 1 ORDER BY sort_order ASC'
        );
    }

    public function index(Request $request): void
    {
        $this->requireAuth();
        $pages = $this->db()->fetchAll(
            'SELECT id, slug, page_type, h1, is_published, updated_at
             FROM seo_pages ORDER BY page_type ASC, h1 ASC'
        );
        $this->render('admin/seo/index', [
            'pageTitle' => 'SEO Landing Pages',
            'pages'     => $pages,
        ]);
    }

    public function create(Request $request): void
    {
        $this->requireAuth();
        $this->render('admin/seo/form', [
            'pageTitle'  => 'New SEO Page',
            'page'       => [],
            'allBrokers' => $this->allBrokers(),
            'action'     => url('admin/seo/create'),
            'isNew'      => true,
        ]);
    }

    public function store(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $slug = $this->makeSlug($_POST['slug'] ?? $_POST['h1'] ?? '');
        if (empty($slug)) {
            session()->flash('error', 'Slug is required.');
            Response::redirect('/admin/seo/create');
        }

        $brokerIds = json_encode(array_map('intval', $_POST['broker_ids'] ?? []));

        $this->db()->execute(
            'INSERT INTO seo_pages
             (slug, page_type, h1, intro_html, body_html, faq_json, broker_ids,
              meta_title, meta_description, is_published)
             VALUES (?,?,?,?,?,?,?,?,?,?)',
            [
                $slug,
                $_POST['page_type'] ?? 'geo',
                trim($_POST['h1'] ?? ''),
                $_POST['intro_html'] ?? '',
                $_POST['body_html'] ?? '',
                $_POST['faq_json'] ?? '[]',
                $brokerIds,
                trim($_POST['meta_title'] ?? ''),
                trim($_POST['meta_description'] ?? ''),
                isset($_POST['is_published']) ? 1 : 0,
            ]
        );

        $new = $this->db()->fetch('SELECT id FROM seo_pages WHERE slug = ?', [$slug]);
        session()->flash('success', 'SEO page created.');
        Response::redirect("admin/seo/{$new['id']}/edit");
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();
        $page = $this->db()->fetch('SELECT * FROM seo_pages WHERE id = ?', [$id]);
        if (!$page) {
            Response::redirect('admin/seo');
        }
        $this->render('admin/seo/form', [
            'pageTitle'  => 'Edit: ' . $page['h1'],
            'page'       => $page,
            'allBrokers' => $this->allBrokers(),
            'action'     => url("admin/seo/{$id}/edit"),
            'isNew'      => false,
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $page = $this->db()->fetch('SELECT id FROM seo_pages WHERE id = ?', [$id]);
        if (!$page) {
            Response::redirect('admin/seo');
        }

        $brokerIds = json_encode(array_map('intval', $_POST['broker_ids'] ?? []));

        $this->db()->execute(
            'UPDATE seo_pages
             SET page_type=?, h1=?, intro_html=?, body_html=?, faq_json=?,
                 broker_ids=?, meta_title=?, meta_description=?, is_published=?
             WHERE id=?',
            [
                $_POST['page_type'] ?? 'geo',
                trim($_POST['h1'] ?? ''),
                $_POST['intro_html'] ?? '',
                $_POST['body_html'] ?? '',
                $_POST['faq_json'] ?? '[]',
                $brokerIds,
                trim($_POST['meta_title'] ?? ''),
                trim($_POST['meta_description'] ?? ''),
                isset($_POST['is_published']) ? 1 : 0,
                (int)$id,
            ]
        );

        session()->flash('success', 'SEO page updated.');
        Response::redirect("admin/seo/{$id}/edit");
    }

    public function destroy(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $this->db()->execute('DELETE FROM seo_pages WHERE id = ?', [$id]);
        session()->flash('success', 'SEO page deleted.');
        Response::redirect('admin/seo');
    }

    private function makeSlug(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9\-]+/', '-', $text);
        $text = trim((string)preg_replace('/-+/', '-', $text), '-');
        return $text;
    }
}
