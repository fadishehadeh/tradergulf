<?php
declare(strict_types=1);

namespace App\Modules\SeoPages;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class SeoPageController extends Controller
{
    public function show(Request $request, string $slug): void
    {
        $page = $this->db()->fetch(
            'SELECT * FROM seo_pages WHERE slug = ? AND is_published = 1',
            [$slug]
        );
        if (!$page) {
            http_response_code(404);
            $this->render('errors/404', ['title' => 'Page Not Found | Trader Gulf']);
            return;
        }

        $brokerIds = json_decode($page['broker_ids'] ?? '[]', true) ?: [];
        $brokers   = [];

        if (!empty($brokerIds)) {
            $placeholders = implode(',', array_fill(0, count($brokerIds), '?'));
            $rows = $this->db()->fetchAll(
                "SELECT * FROM brokers WHERE id IN ($placeholders) AND is_active = 1",
                $brokerIds
            );
            // Preserve the admin-defined order
            $indexed = [];
            foreach ($rows as $row) {
                $indexed[$row['id']] = $row;
            }
            foreach ($brokerIds as $bid) {
                if (isset($indexed[$bid])) {
                    $brokers[] = $indexed[$bid];
                }
            }
        }

        $faqs = json_decode($page['faq_json'] ?? '[]', true) ?: [];

        $this->render('seo/show', [
            'title'   => !empty($page['meta_title'])
                ? $page['meta_title']
                : $page['h1'] . ' | Trader Gulf',
            'metaDesc' => $page['meta_description'] ?? '',
            'page'    => $page,
            'brokers' => $brokers,
            'faqs'    => $faqs,
        ]);
    }
}
