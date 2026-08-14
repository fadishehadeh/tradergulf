<?php
declare(strict_types=1);

namespace App\Modules\Search;

use App\Core\Controller;
use App\Core\Request;

class SearchController extends Controller
{
    public function index(Request $request): void
    {
        $q = trim((string) $request->query('q', ''));
        $results = [];

        if (mb_strlen($q) >= 2) {
            $like = '%' . $q . '%';

            $brokers = $this->db()->fetchAll(
                'SELECT slug, name, tagline, overall_rating, regulation FROM brokers
                 WHERE is_active = 1 AND (name LIKE ? OR tagline LIKE ? OR regulation LIKE ?)
                 ORDER BY overall_rating DESC LIMIT 5',
                [$like, $like, $like]
            );
            foreach ($brokers as $b) {
                $results[] = [
                    'type'    => 'broker',
                    'title'   => $b['name'] . ' Review',
                    'url'     => url('brokers/' . $b['slug']),
                    'excerpt' => $b['tagline'],
                    'meta'    => 'Broker · ' . $b['overall_rating'] . '/5',
                ];
            }

            $articles = $this->db()->fetchAll(
                "SELECT slug, title, excerpt, category FROM articles
                 WHERE is_published = 1 AND (title LIKE ? OR excerpt LIKE ?)
                 ORDER BY published_at DESC LIMIT 5",
                [$like, $like]
            );
            foreach ($articles as $a) {
                $section = ($a['category'] === 'news') ? 'news' : 'guides';
                $results[] = [
                    'type'    => $section,
                    'title'   => $a['title'],
                    'url'     => url($section . '/' . $a['slug']),
                    'excerpt' => $a['excerpt'],
                    'meta'    => ucfirst($section),
                ];
            }

            $terms = $this->db()->fetchAll(
                'SELECT slug, term, definition_html FROM glossary
                 WHERE term LIKE ? OR definition_html LIKE ?
                 ORDER BY term ASC LIMIT 5',
                [$like, $like]
            );
            foreach ($terms as $g) {
                $results[] = [
                    'type'    => 'glossary',
                    'title'   => $g['term'],
                    'url'     => url('glossary/' . $g['slug']),
                    'excerpt' => substr(strip_tags($g['definition_html']), 0, 200),
                    'meta'    => 'Glossary',
                ];
            }
        }

        $this->render('search/results', [
            'title'       => $q ? 'Search: ' . $q . ' | Trader Gulf' : 'Search | Trader Gulf',
            'metaDesc'    => 'Search brokers, guides, and glossary terms on Trader Gulf.',
            'metaRobots'  => 'noindex, follow',
            'q'           => $q,
            'results'     => $results,
        ]);
    }
}
