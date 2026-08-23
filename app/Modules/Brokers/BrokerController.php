<?php
declare(strict_types=1);

namespace App\Modules\Brokers;

use App\Core\Controller;
use App\Core\Request;

class BrokerController extends Controller
{
    public function index(Request $request): void
    {
        $perPage = 10;
        $page    = max(1, (int)$request->query('page', 1));
        $offset  = ($page - 1) * $perPage;

        $total   = (int)$this->db()->fetchValue('SELECT COUNT(*) FROM brokers WHERE is_active = 1');
        $brokers = $this->db()->fetchAll(
            "SELECT * FROM brokers WHERE is_active = 1 ORDER BY is_featured DESC, sort_order ASC LIMIT $perPage OFFSET $offset"
        );
        $pages = (int)ceil($total / $perPage);

        $this->render('brokers/index', [
            'title'     => 'Best Forex Brokers in UAE & Gulf ' . date('Y') . ' | Trader Gulf',
            'metaDesc'  => 'Compare the best forex brokers for UAE, Saudi Arabia and Gulf traders in ' . date('Y') . '. In-depth reviews of spreads, regulation, Islamic accounts and fees. Updated ' . date('M Y') . '.',
            'canonical' => url('brokers'),
            'brokers'   => $brokers,
            'page'    => $page,
            'pages'   => $pages,
            'total'   => $total,
        ]);
    }

    public function show(Request $request, string $slug): void
    {
        $broker = $this->db()->fetch(
            'SELECT b.*, br.intro_html, br.pros, br.cons, br.overview_html,
                    br.regulation_html, br.account_types_html, br.platforms_html,
                    br.spreads_html, br.deposits_html, br.support_html,
                    br.verdict_html, br.meta_title, br.meta_description, br.last_updated
             FROM brokers b
             LEFT JOIN broker_reviews br ON br.broker_id = b.id
             WHERE b.slug = ? AND b.is_active = 1',
            [$slug]
        );

        if (!$broker) $this->notFound();

        $broker['pros'] = json_decode($broker['pros'] ?? '[]', true);
        $broker['cons'] = json_decode($broker['cons'] ?? '[]', true);

        $relatedBrokers = $this->db()->fetchAll(
            'SELECT id, slug, name, logo, overall_rating FROM brokers
             WHERE is_active = 1 AND slug != ? ORDER BY sort_order ASC LIMIT 3',
            [$slug]
        );

        $year = date('Y');
        $this->render('brokers/show', [
            'title'         => $broker['meta_title'] ?? $broker['name'] . ' Review ' . $year . ' | Spreads, Fees & Regulation | Trader Gulf',
            'metaDesc'      => $broker['meta_description'] ?? $broker['name'] . ' review ' . $year . ': min deposit $' . number_format((float)$broker['min_deposit']) . ', EUR/USD spread from ' . $broker['spread_eurusd'] . ' pips, max leverage ' . ($broker['max_leverage'] ?: '1:500') . '. Regulated by ' . ($broker['regulation'] ?: 'multiple authorities') . '. Independent review for UAE & Gulf traders.',
            'canonical'     => url('brokers/' . $broker['slug']),
            'broker'        => $broker,
            'relatedBrokers'=> $relatedBrokers,
        ]);
    }
}
