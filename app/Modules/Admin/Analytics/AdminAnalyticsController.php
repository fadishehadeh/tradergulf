<?php
declare(strict_types=1);

namespace App\Modules\Admin\Analytics;

use App\Core\Request;
use App\Modules\Admin\AdminBaseController;

class AdminAnalyticsController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();
        $db = $this->db();

        $human = 'AND bot = 0';

        $totals = [
            'today'   => (int) $db->fetchValue("SELECT COUNT(*) FROM page_views WHERE DATE(created_at) = CURDATE() $human"),
            'week'    => (int) $db->fetchValue("SELECT COUNT(*) FROM page_views WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) $human"),
            'month'   => (int) $db->fetchValue("SELECT COUNT(*) FROM page_views WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) $human"),
            'all'     => (int) $db->fetchValue("SELECT COUNT(*) FROM page_views WHERE 1 $human"),
        ];

        $topPages = $db->fetchAll(
            "SELECT path, COUNT(*) AS views FROM page_views
             WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) $human
             GROUP BY path ORDER BY views DESC LIMIT 20"
        );

        $topReferrers = $db->fetchAll(
            "SELECT referrer, COUNT(*) AS views FROM page_views
             WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) AND referrer != '' $human
             GROUP BY referrer ORDER BY views DESC LIMIT 15"
        );

        $daily = $db->fetchAll(
            "SELECT DATE(created_at) AS day, COUNT(*) AS views FROM page_views
             WHERE created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY) $human
             GROUP BY day ORDER BY day ASC"
        );

        $this->render('admin/analytics/index', [
            'pageTitle'    => 'Analytics',
            'totals'       => $totals,
            'topPages'     => $topPages,
            'topReferrers' => $topReferrers,
            'daily'        => $daily,
        ]);
    }
}
