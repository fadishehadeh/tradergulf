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

    public function comparison(Request $request, string $versus): void
    {
        // Parse "broker-a-vs-broker-b" - split on first "-vs-"
        $pos = strpos($versus, '-vs-');
        if ($pos === false) $this->notFound();

        $slug1 = substr($versus, 0, $pos);
        $slug2 = substr($versus, $pos + 4);

        $brokers = $this->db()->fetchAll(
            "SELECT b.*, r.overview_html, r.regulation_html, r.spreads_html,
                    r.account_types_html, r.platforms_html, r.deposits_html,
                    r.support_html
             FROM brokers b
             LEFT JOIN broker_reviews r ON r.broker_id = b.id
             WHERE b.slug IN (?, ?) AND b.is_active = 1",
            [$slug1, $slug2]
        );

        if (count($brokers) < 2) $this->notFound();

        // Ensure b1 is always $slug1 order
        usort($brokers, fn($a, $b) => ($a['slug'] === $slug1) ? -1 : 1);
        [$b1, $b2] = $brokers;

        $pageUrl   = url('compare/' . $versus);
        $pageTitle = $b1['name'] . ' vs ' . $b2['name'] . ' 2025 - Broker Comparison | Trader Gulf';
        $metaDesc  = 'Compare ' . $b1['name'] . ' vs ' . $b2['name'] . ' side-by-side. Spreads, regulation, platforms, minimum deposit, Islamic accounts. Which is best for MENA traders?';

        $bSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',    'item' => url()],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Compare', 'item' => url('compare')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $b1['name'] . ' vs ' . $b2['name'], 'item' => $pageUrl],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $this->render('compare/versus', [
            'title'       => $pageTitle,
            'metaDesc'    => $metaDesc,
            'canonical'   => $pageUrl,
            'headSchemas' => "<script type=\"application/ld+json\">$bSchema</script>",
            'b1'          => $b1,
            'b2'          => $b2,
            'versus'      => $versus,
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
