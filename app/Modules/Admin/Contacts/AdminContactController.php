<?php
declare(strict_types=1);

namespace App\Modules\Admin\Contacts;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminContactController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $filter  = $request->input('filter', 'all'); // all | unread
        $page    = max(1, (int)$request->input('page', 1));
        $perPage = 30;
        $offset  = ($page - 1) * $perPage;

        $onlyUnread = ($filter === 'unread');
        $whereParam  = $onlyUnread ? [1] : [];
        $whereSql    = $onlyUnread ? 'WHERE is_read = ?' : '';

        $total   = (int)$this->db()->fetchValue("SELECT COUNT(*) FROM contact_messages $whereSql", $whereParam);
        $messages = $this->db()->fetchAll(
            "SELECT * FROM contact_messages $whereSql ORDER BY created_at DESC LIMIT $perPage OFFSET $offset",
            $whereParam
        );
        $pages = (int)ceil($total / $perPage);
        $unread = (int)$this->db()->fetchValue('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0');

        $this->render('admin/contacts/index', [
            'pageTitle' => 'Contact Messages',
            'messages'  => $messages,
            'total'     => $total,
            'unread'    => $unread,
            'page'      => $page,
            'pages'     => $pages,
            'filter'    => $filter,
        ]);
    }

    public function show(Request $request, string $id = '0'): void
    {
        $this->requireAuth();
        $id  = (int)$id;
        $msg = $this->db()->fetch('SELECT * FROM contact_messages WHERE id = ?', [$id]);
        if (!$msg) Response::redirect('admin/contacts');

        // Mark as read
        if (!$msg['is_read']) {
            $this->db()->execute('UPDATE contact_messages SET is_read = 1 WHERE id = ?', [$id]);
        }

        $this->render('admin/contacts/show', [
            'pageTitle' => 'Message from ' . ($msg['name'] ?? 'Unknown'),
            'msg'       => $msg,
        ]);
    }

    public function delete(Request $request, string $id = '0'): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $this->db()->execute('DELETE FROM contact_messages WHERE id = ?', [(int)$id]);
        session()->flash('success', 'Message deleted.');
        Response::redirect('admin/contacts');
    }

    public function markRead(Request $request, string $id = '0'): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $this->db()->execute('UPDATE contact_messages SET is_read = 1 WHERE id = ?', [(int)$id]);
        Response::redirect('admin/contacts');
    }
}
