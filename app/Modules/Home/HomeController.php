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

        $orgSchema = json_encode([
            '@context'    => 'https://schema.org',
            '@type'       => 'Organization',
            'name'        => 'Trader Gulf',
            'url'         => url(),
            'logo'        => url('assets/img/logo.svg'),
            'description' => 'Independent forex broker comparison platform for UAE, Saudi Arabia, Kuwait and the GCC. Reviews, calculators, and country guides.',
            'areaServed'  => ['UAE', 'Saudi Arabia', 'Kuwait', 'Qatar', 'Bahrain', 'Oman', 'GCC'],
            'sameAs'      => [],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $siteSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'name'            => 'Trader Gulf',
            'url'             => url(),
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => ['@type' => 'EntryPoint', 'urlTemplate' => url('search') . '?q={search_term_string}'],
                'query-input' => 'required name=search_term_string',
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $this->render('home/index', [
            'title'          => 'Best Forex Brokers in UAE & Gulf 2026 | Trader Gulf',
            'metaDesc'       => 'Compare the best forex brokers in UAE, Saudi Arabia, Kuwait and the Gulf region. Independent reviews, spreads, regulation and fees - updated 2026.',
            'canonical'      => url(),
            'headSchemas'    => "<script type=\"application/ld+json\">$orgSchema</script><script type=\"application/ld+json\">$siteSchema</script>",
            'featuredBrokers'=> $featuredBrokers,
            'latestGuides'   => $latestGuides,
            'latestNews'     => $latestNews,
            'banners'        => $banners,
        ]);
    }
}
