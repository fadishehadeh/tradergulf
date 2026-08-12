<?php
declare(strict_types=1);

namespace App\Modules\Admin\Newsletter;

use App\Core\Request;
use App\Modules\Admin\AdminBaseController;
use App\Core\Response;

class AdminNewsletterController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $page    = max(1, (int)$request->input('page', 1));
        $perPage = 50;
        $offset  = ($page - 1) * $perPage;

        $total       = (int)$this->db()->fetchValue('SELECT COUNT(*) FROM newsletter_subscribers');
        $subscribers = $this->db()->fetchAll(
            "SELECT * FROM newsletter_subscribers ORDER BY created_at DESC LIMIT $perPage OFFSET $offset"
        );
        $pages = (int)ceil($total / $perPage);

        $this->render('admin/newsletter/index', [
            'pageTitle'   => 'Newsletter Subscribers',
            'subscribers' => $subscribers,
            'total'       => $total,
            'page'        => $page,
            'pages'       => $pages,
        ]);
    }

    public function delete(Request $request, string $id = '0'): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $id = (int)$id;
        $this->db()->execute('DELETE FROM newsletter_subscribers WHERE id = ?', [$id]);
        session()->flash('success', 'Subscriber removed.');
        Response::redirect('admin/newsletter');
    }
}
