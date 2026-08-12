<?php
declare(strict_types=1);

namespace App\Modules\Home;

use App\Core\Controller;
use App\Core\Request;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $featuredBrokers = $this->db()->fetchAll(
            'SELECT * FROM brokers WHERE is_featured = 1 AND is_active = 1 ORDER BY sort_order ASC LIMIT 6'
        );

        $latestGuides = $this->db()->fetchAll(
            "SELECT id, slug, title, excerpt, published_at FROM articles
             WHERE category = 'guide' AND is_published = 1
             ORDER BY published_at DESC LIMIT 3"
        );

        $latestNews = $this->db()->fetchAll(
            "SELECT id, slug, title, excerpt, published_at FROM articles
             WHERE category = 'news' AND is_published = 1
             ORDER BY published_at DESC LIMIT 3"
        );

        $bannerRows = $this->db()->fetchAll(
            'SELECT b.*, br.name AS bname, br.overall_rating, br.spread_eurusd,
                    br.min_deposit, br.max_leverage, br.regulation, br.platforms, br.slug AS broker_slug
             FROM banners b
             LEFT JOIN brokers br ON b.broker_id = br.id
             WHERE b.is_active = 1
             ORDER BY b.sort_order ASC'
        );
        $banners = array_column($bannerRows, null, 'position');

        $this->render('home/index', [
            'title'          => 'Compare Top Forex Brokers | Trader Gulf',
            'metaDesc'       => 'Independent forex broker reviews and comparisons for traders worldwide. Find the right broker for your trading style.',
            'featuredBrokers'=> $featuredBrokers,
            'latestGuides'   => $latestGuides,
            'latestNews'     => $latestNews,
            'banners'        => $banners,
        ]);
    }
}
