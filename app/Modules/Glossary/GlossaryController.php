<?php
declare(strict_types=1);

namespace App\Modules\Glossary;

use App\Core\Controller;
use App\Core\Request;

class GlossaryController extends Controller
{
    public function index(Request $request): void
    {
        $terms = $this->db()->fetchAll(
            'SELECT id, term, slug, letter FROM glossary ORDER BY letter ASC, term ASC'
        );

        $grouped = [];
        foreach ($terms as $term) {
            $grouped[strtoupper($term['letter'])][] = $term;
        }

        $this->render('glossary/index', [
            'title'   => 'Forex Glossary - Trading Terms for Gulf Traders | Trader Gulf',
            'metaDesc'=> 'Complete forex and CFD glossary in plain English. Learn what pip, leverage, spread, margin call, and Islamic account mean - essential for UAE and Gulf traders.',
            'grouped' => $grouped,
        ]);
    }

    public function show(Request $request, string $slug): void
    {
        $term = $this->db()->fetch(
            'SELECT * FROM glossary WHERE slug = ?',
            [$slug]
        );

        if (!$term) $this->notFound();

        $related = [];
        if ($term['related_terms']) {
            $slugs = json_decode($term['related_terms'], true);
            if (!empty($slugs)) {
                $ph = implode(',', array_fill(0, count($slugs), '?'));
                $related = $this->db()->fetchAll(
                    "SELECT term, slug FROM glossary WHERE slug IN ($ph)", $slugs
                );
            }
        }

        $this->render('glossary/show', [
            'title'   => $term['term'] . ' | Forex Glossary | Trader Gulf',
            'metaDesc'=> strip_tags($term['definition_html']),
            'term'    => $term,
            'related' => $related,
        ]);
    }
}
