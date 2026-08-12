<?php
declare(strict_types=1);

namespace App\Modules\Rss;

use App\Core\Controller;
use App\Core\Request;

class RssController extends Controller
{
    public function feed(Request $request): void
    {
        $articles = $this->db()->fetchAll(
            "SELECT title, slug, excerpt, category, published_at, updated_at
             FROM articles
             WHERE is_published = 1
             ORDER BY published_at DESC
             LIMIT 30"
        );

        $siteName = setting('site_name', 'Trader Gulf');
        $siteUrl  = url();
        $tagline  = setting('site_tagline', 'Independent forex broker reviews.');

        header('Content-Type: application/rss+xml; charset=UTF-8');
        header('Cache-Control: public, max-age=3600');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
        echo '<channel>' . "\n";
        echo '<title>' . htmlspecialchars($siteName) . '</title>' . "\n";
        echo '<link>' . htmlspecialchars($siteUrl) . '</link>' . "\n";
        echo '<description>' . htmlspecialchars($tagline) . '</description>' . "\n";
        echo '<language>en-GB</language>' . "\n";
        echo '<lastBuildDate>' . date('r') . '</lastBuildDate>' . "\n";
        echo '<atom:link href="' . htmlspecialchars(url('feed')) . '" rel="self" type="application/rss+xml"/>' . "\n";

        foreach ($articles as $a) {
            $type  = $a['category'] === 'news' ? 'news' : 'guides';
            $link  = url($type . '/' . $a['slug']);
            $date  = date('r', strtotime($a['published_at']));
            $desc  = htmlspecialchars($a['excerpt'] ?? '');

            echo '<item>' . "\n";
            echo '  <title>' . htmlspecialchars($a['title']) . '</title>' . "\n";
            echo '  <link>' . htmlspecialchars($link) . '</link>' . "\n";
            echo '  <guid isPermaLink="true">' . htmlspecialchars($link) . '</guid>' . "\n";
            echo '  <pubDate>' . $date . '</pubDate>' . "\n";
            if ($desc) echo '  <description>' . $desc . '</description>' . "\n";
            echo '</item>' . "\n";
        }

        echo '</channel>' . "\n";
        echo '</rss>' . "\n";
        exit;
    }
}
