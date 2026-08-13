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

    public function campaign(Request $request): void
    {
        $this->requireAuth();

        $subscriberCount = (int)$this->db()->fetchValue(
            'SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active = 1'
        );

        $this->render('admin/newsletter/campaign', [
            'pageTitle'       => 'Send Campaign',
            'subscriberCount' => $subscriberCount,
        ]);
    }

    public function sendCampaign(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $subject = trim($request->input('subject', ''));
        $body    = trim($request->input('body', ''));

        if ($subject === '' || $body === '') {
            session()->flash('error', 'Subject and body are both required.');
            Response::redirect('admin/newsletter/campaign');
            return;
        }

        $subscribers = $this->db()->fetchAll(
            'SELECT email, name FROM newsletter_subscribers WHERE is_active = 1'
        );

        $headers = implode("\r\n", [
            'From: Trader Gulf <noreply@tradergulf.com>',
            'Content-Type: text/html; charset=UTF-8',
            'List-Unsubscribe: <mailto:unsubscribe@tradergulf.com?subject=unsubscribe>',
        ]);

        $htmlBody = '<!DOCTYPE html><html><body style="font-family:sans-serif;max-width:620px;margin:0 auto;padding:24px;color:#1f2937">'
            . '<div style="background:#0f1b35;padding:20px 24px;border-radius:8px 8px 0 0;margin-bottom:0">'
            . '<span style="color:#fff;font-weight:900;font-size:18px;letter-spacing:2px">TRADER</span>'
            . '<span style="color:#34d399;font-weight:900;font-size:18px;letter-spacing:2px">GULF</span>'
            . '</div>'
            . '<div style="border:1px solid #e5e7eb;border-top:none;border-radius:0 0 8px 8px;padding:28px 24px">'
            . '<h2 style="margin-top:0">' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</h2>'
            . $body
            . '<hr style="margin:24px 0;border:none;border-top:1px solid #e5e7eb">'
            . '<p style="font-size:12px;color:#9ca3af">You are receiving this because you subscribed to Trader Gulf updates. '
            . '<a href="https://tradergulf.com">tradergulf.com</a></p>'
            . '</div>'
            . '</body></html>';

        $sent = 0;
        foreach ($subscribers as $sub) {
            $to = $sub['email'];
            if (mail($to, $subject, $htmlBody, $headers)) {
                $sent++;
            }
        }

        session()->flash('success', "Campaign sent to {$sent} subscribers.");
        Response::redirect('admin/newsletter');
    }
}
