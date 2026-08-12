<?php
declare(strict_types=1);

namespace App\Modules\Affiliate;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class AffiliateController extends Controller
{
    public function go(Request $request, string $slug = ''): void
    {
        $broker = $this->db()->fetch(
            'SELECT id, slug, affiliate_url FROM brokers WHERE slug = ? AND is_active = 1',
            [$slug]
        );

        if (!$broker || empty($broker['affiliate_url'])) {
            Response::abort(404);
        }

        // Log the click
        $source  = trim($_GET['src'] ?? '');
        $ip      = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
        $ip      = explode(',', $ip)[0]; // take first IP if forwarded
        $ua      = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 512);
        $referer = substr($_SERVER['HTTP_REFERER'] ?? '', 0, 512);

        try {
            $this->db()->execute(
                'INSERT INTO affiliate_clicks (broker_id, broker_slug, source, ip, user_agent, referer)
                 VALUES (?, ?, ?, ?, ?, ?)',
                [(int)$broker['id'], $broker['slug'], $source ?: null, $ip ?: null, $ua ?: null, $referer ?: null]
            );
        } catch (\Throwable) {
            // Non-fatal — still redirect
        }

        header('Location: ' . $broker['affiliate_url'], true, 302);
        header('Cache-Control: no-store, no-cache, must-revalidate');
        exit;
    }
}
