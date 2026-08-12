<?php
declare(strict_types=1);

namespace App\Modules\Admin\Dashboard;

use App\Core\Request;
use App\Modules\Admin\AdminBaseController;

class AdminDashboardController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $brokers  = (int) $this->db()->fetchValue('SELECT COUNT(*) FROM brokers');
        $articles = (int) $this->db()->fetchValue('SELECT COUNT(*) FROM articles');
        $glossary = (int) $this->db()->fetchValue('SELECT COUNT(*) FROM glossary');
        $pages    = (int) $this->db()->fetchValue('SELECT COUNT(*) FROM pages');

        $recentBrokers = $this->db()->fetchAll(
            'SELECT id, name, overall_rating, is_active FROM brokers ORDER BY id DESC LIMIT 5'
        );
        $recentArticles = $this->db()->fetchAll(
            'SELECT id, title, category, is_published FROM articles ORDER BY id DESC LIMIT 5'
        );

        $this->render('admin/dashboard', [
            'pageTitle'      => 'Dashboard',
            'brokers'        => $brokers,
            'articles'       => $articles,
            'glossary'       => $glossary,
            'pages'          => $pages,
            'recentBrokers'  => $recentBrokers,
            'recentArticles' => $recentArticles,
        ]);
    }
}
