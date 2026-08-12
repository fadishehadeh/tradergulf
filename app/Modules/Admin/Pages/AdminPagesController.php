<?php
declare(strict_types=1);

namespace App\Modules\Admin\Pages;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminPagesController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $pages = $this->db()->fetchAll(
            'SELECT id, slug, title, updated_at FROM pages ORDER BY slug ASC'
        );

        $this->render('admin/pages/index', [
            'pageTitle' => 'Static Pages',
            'pages'     => $pages,
        ]);
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();

        $page = $this->db()->fetch('SELECT * FROM pages WHERE id = ?', [(int) $id]);
        if (!$page) $this->notFound();

        $this->render('admin/pages/edit', [
            'pageTitle' => "Edit: {$page['title']}",
            'page'      => $page,
            'action'    => url("admin/pages/{$id}/edit"),
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $page = $this->db()->fetch('SELECT id FROM pages WHERE id = ?', [(int) $id]);
        if (!$page) $this->notFound();

        $this->db()->execute(
            'UPDATE pages SET title=?, content_html=?, meta_title=?, meta_description=? WHERE id=?',
            [
                trim($_POST['title'] ?? ''),
                $_POST['content_html'] ?? '',
                trim($_POST['meta_title'] ?? ''),
                trim($_POST['meta_description'] ?? ''),
                (int) $id,
            ]
        );

        session()->flash('success', 'Page updated.');
        Response::redirect("/admin/pages/{$id}/edit");
    }
}
