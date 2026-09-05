<?php
declare(strict_types=1);

namespace App\Modules\Admin\Sitemap;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminSitemapController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $path    = web_path('sitemap.xml');
        $exists  = file_exists($path);
        $lastMod = $exists ? date('Y-m-d H:i:s', (int)filemtime($path)) : null;
        $urlCount = 0;

        if ($exists) {
            $urlCount = substr_count((string)file_get_contents($path), '<url>');
        }

        $this->render('admin/sitemap/index', [
            'pageTitle' => 'Sitemap Generator',
            'exists'    => $exists,
            'lastMod'   => $lastMod,
            'urlCount'  => $urlCount,
            'sitemapUrl'=> url('sitemap.xml'),
        ]);
    }

    public function generate(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        // Always use the canonical site URL; strip any path suffix (e.g. /tradergulf/public on localhost)
        $cfgUrl = config('app.url', 'https://tradergulf.com');
        $parsed = parse_url($cfgUrl);
        $base   = rtrim(($parsed['scheme'] ?? 'https') . '://' . ($parsed['host'] ?? 'tradergulf.com'), '/');
        $today = date('Y-m-d');
        $urls  = [];

        // Static pages
        foreach ([
            ['/', '1.0', 'daily'],
            ['/brokers', '0.9', 'weekly'],
            ['/compare', '0.8', 'weekly'],
            ['/calculators', '0.7', 'monthly'],
            ['/calculators/pip', '0.6', 'monthly'],
            ['/calculators/position-size', '0.6', 'monthly'],
            ['/calculators/margin', '0.6', 'monthly'],
            ['/calculators/profit', '0.6', 'monthly'],
            ['/guides', '0.7', 'weekly'],
            ['/news', '0.7', 'daily'],
            ['/glossary', '0.6', 'monthly'],
            ['/advertise', '0.5', 'monthly'],
            ['/about', '0.5', 'monthly'],
            ['/contact', '0.4', 'monthly'],
            ['/privacy-policy', '0.3', 'monthly'],
            ['/risk-disclaimer', '0.3', 'monthly'],
            ['/islamic-forex-brokers', '0.8', 'weekly'],
            ['/forex-brokers-in/uae', '0.85', 'weekly'],
            ['/forex-brokers-in/saudi-arabia', '0.85', 'weekly'],
            ['/forex-brokers-in/kuwait', '0.85', 'weekly'],
            ['/forex-brokers-in/qatar', '0.8', 'weekly'],
            ['/forex-brokers-in/bahrain', '0.8', 'weekly'],
            ['/forex-brokers-in/oman', '0.8', 'weekly'],
            ['/forex-brokers-in/egypt', '0.8', 'weekly'],
            ['/forex-brokers-in/jordan', '0.75', 'weekly'],
            ['/forex-brokers-in/iraq', '0.75', 'weekly'],
            ['/forex-brokers-in/morocco', '0.75', 'weekly'],
            ['/forex-brokers-in/turkey', '0.75', 'weekly'],
            ['/forex-brokers-in/lebanon', '0.7', 'weekly'],
            ['/currency-converter', '0.75', 'weekly'],
            ['/economic-calendar', '0.75', 'weekly'],
            ['/broker-quiz', '0.75', 'monthly'],
            ['/compare', '0.8', 'weekly'],
        ] as [$loc, $pri, $freq]) {
            $urls[] = ['loc' => $base . $loc, 'lastmod' => $today, 'priority' => $pri, 'freq' => $freq];
        }

        // Comparison pages
        foreach ([
            'exness-vs-xm', 'pepperstone-vs-ic-markets', 'exness-vs-pepperstone',
            'xm-vs-ic-markets', 'exness-vs-ic-markets', 'avatrade-vs-pepperstone',
            'fp-markets-vs-ic-markets', 'pepperstone-vs-exness', 'xtb-vs-pepperstone',
            'etoro-vs-xm', 'ic-markets-vs-avatrade', 'capital-com-vs-etoro',
            'xm-vs-avatrade', 'exness-vs-avatrade', 'pepperstone-vs-xm',
            'ic-markets-vs-exness', 'xtb-vs-xm', 'ig-vs-pepperstone',
        ] as $pair) {
            $urls[] = ['loc' => $base . '/compare/' . $pair, 'lastmod' => $today, 'priority' => '0.75', 'freq' => 'monthly'];
        }

        // Active brokers
        foreach ($this->db()->fetchAll('SELECT slug FROM brokers WHERE is_active = 1 ORDER BY sort_order ASC') as $b) {
            $urls[] = ['loc' => $base . '/brokers/' . $b['slug'], 'lastmod' => $today, 'priority' => '0.85', 'freq' => 'monthly'];
        }

        // Published articles
        foreach ($this->db()->fetchAll("SELECT slug, category, published_at FROM articles WHERE is_published = 1 ORDER BY published_at DESC") as $a) {
            $section = ($a['category'] === 'news') ? 'news' : 'guides';
            $lm = $a['published_at'] ? date('Y-m-d', (int)strtotime($a['published_at'])) : $today;
            $urls[] = ['loc' => $base . '/' . $section . '/' . $a['slug'], 'lastmod' => $lm, 'priority' => '0.7', 'freq' => 'monthly'];
        }

        // Published SEO pages
        foreach ($this->db()->fetchAll("SELECT slug FROM seo_pages WHERE is_published = 1 ORDER BY id ASC") as $p) {
            $urls[] = ['loc' => $base . '/best/' . $p['slug'], 'lastmod' => $today, 'priority' => '0.85', 'freq' => 'monthly'];
        }

        // Glossary terms
        foreach ($this->db()->fetchAll('SELECT slug FROM glossary ORDER BY term ASC') as $g) {
            $urls[] = ['loc' => $base . '/glossary/' . $g['slug'], 'lastmod' => $today, 'priority' => '0.5', 'freq' => 'monthly'];
        }

        // Regulators directory
        $urls[] = ['loc' => $base . '/regulators', 'lastmod' => $today, 'priority' => '0.8', 'freq' => 'monthly'];
        foreach (['fca', 'asic', 'cysec', 'dfsa', 'sca', 'cma-saudi', 'fsca', 'fsa-seychelles', 'cma-kuwait'] as $slug) {
            $urls[] = ['loc' => $base . '/regulators/' . $slug, 'lastmod' => $today, 'priority' => '0.75', 'freq' => 'monthly'];
        }

        // Build XML
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
        $xml .= '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
            $xml .= '    <lastmod>' . $u['lastmod'] . "</lastmod>\n";
            $xml .= '    <changefreq>' . $u['freq'] . "</changefreq>\n";
            $xml .= '    <priority>' . $u['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        file_put_contents(web_path('sitemap.xml'), $xml);

        // Auto-ping IndexNow (Bing) if key is configured
        $indexNowKey = setting('indexnow_key');
        if ($indexNowKey) {
            $pingUrl = 'https://api.indexnow.org/indexnow?url=' . urlencode($base . '/sitemap.xml') . '&key=' . urlencode($indexNowKey);
            @file_get_contents($pingUrl);
        }

        session()->flash('success', 'Sitemap generated with ' . count($urls) . ' URLs.');
        Response::redirect('admin/sitemap');
    }

    public function ping(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        // Always use the real production domain, not localhost
        $cfgUrl    = config('app.url', 'https://tradergulf.com');
        $parsed    = parse_url($cfgUrl);
        $base      = rtrim(($parsed['scheme'] ?? 'https') . '://' . ($parsed['host'] ?? 'tradergulf.com'), '/');
        $sitemapUrl = $base . '/sitemap.xml';

        @file_get_contents('https://www.google.com/ping?sitemap=' . urlencode($sitemapUrl));
        @file_get_contents('https://www.bing.com/ping?sitemap=' . urlencode($sitemapUrl));

        $indexNowKey = setting('indexnow_key');
        if ($indexNowKey) {
            @file_get_contents('https://api.indexnow.org/indexnow?url=' . urlencode($sitemapUrl) . '&key=' . urlencode($indexNowKey));
        }

        session()->flash('success', 'Search engines pinged (' . $sitemapUrl . '). Also submit manually in Google Search Console for fastest indexing.');
        Response::redirect('admin/sitemap');
    }
}
