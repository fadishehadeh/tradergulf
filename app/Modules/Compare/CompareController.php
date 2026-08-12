<?php
declare(strict_types=1);

namespace App\Modules\Compare;

use App\Core\Controller;
use App\Core\Request;

class CompareController extends Controller
{
    public function index(Request $request): void
    {
        $allBrokers = $this->db()->fetchAll(
            'SELECT id, slug, name, logo, overall_rating FROM brokers
             WHERE is_active = 1 ORDER BY sort_order ASC'
        );

        $this->render('compare/index', [
            'title'     => 'Compare Forex Brokers | Side-by-Side Comparison | Trader Gulf',
            'metaDesc'  => 'Compare up to 4 forex brokers side-by-side. Spreads, regulation, platforms, minimum deposit and more.',
            'allBrokers'=> $allBrokers,
        ]);
    }

    public function data(Request $request): void
    {
        $slugs = array_filter(array_map('trim', explode(',', $request->query('brokers', ''))));

        if (empty($slugs) || count($slugs) > 4) {
            $this->json(['error' => 'Select 2–4 brokers'], 400);
        }

        $placeholders = implode(',', array_fill(0, count($slugs), '?'));
        $brokers = $this->db()->fetchAll(
            "SELECT slug, name, logo, overall_rating, regulation, founded_year,
                    headquarters, min_deposit, max_leverage, spread_eurusd,
                    spread_type, commission_per_lot, platforms,
                    has_islamic, has_copy_trading, has_demo,
                    base_currencies, deposit_methods, affiliate_url
             FROM brokers
             WHERE slug IN ($placeholders) AND is_active = 1
             ORDER BY FIELD(slug, $placeholders)",
            array_merge($slugs, $slugs)
        );

        $this->json($brokers);
    }
}
