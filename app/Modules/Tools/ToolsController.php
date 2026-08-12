<?php
declare(strict_types=1);

namespace App\Modules\Tools;

use App\Core\Controller;
use App\Core\Request;

class ToolsController extends Controller
{
    public function currencyConverter(Request $request): void
    {
        $this->render('tools/currency-converter', [
            'title'   => 'Currency Converter — Free Live Rates | Trader Gulf',
            'metaDesc'=> 'Free currency converter with live exchange rates. Convert between 150+ currencies including AED, SAR, USD, EUR, GBP and more.',
            'canonical' => url('currency-converter'),
        ]);
    }

    public function economicCalendar(Request $request): void
    {
        $this->render('tools/economic-calendar', [
            'title'   => 'Economic Calendar 2025 — Forex Market Events | Trader Gulf',
            'metaDesc'=> 'Live economic calendar with high-impact forex events: NFP, FOMC, CPI, central bank decisions and more. Updated in real time.',
            'canonical' => url('economic-calendar'),
        ]);
    }

    public function brokerQuiz(Request $request): void
    {
        $brokers = $this->db()->fetchAll(
            'SELECT id, name, slug, min_deposit, max_leverage, regulation, platforms,
                    has_islamic, overall_rating, logo, affiliate_url
             FROM brokers WHERE is_active = 1 ORDER BY overall_rating DESC'
        );

        $this->render('tools/broker-quiz', [
            'title'    => 'Find Your Perfect Forex Broker — Free Quiz | Trader Gulf',
            'metaDesc' => 'Answer 5 quick questions and we\'ll match you with the best forex broker for your trading style, experience level, and location.',
            'canonical' => url('broker-quiz'),
            'brokersJson' => json_encode($brokers, JSON_HEX_TAG | JSON_HEX_APOS | JSON_UNESCAPED_UNICODE),
        ]);
    }
}
