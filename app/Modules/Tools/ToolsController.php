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
            'title'   => 'Currency Converter - AED, SAR, USD & Live Rates | Trader Gulf',
            'metaDesc'=> 'Free currency converter with live exchange rates for AED, SAR, KWD, QAR, USD, EUR, GBP and 150+ currencies. Updated daily from ECB data.',
            'canonical' => url('currency-converter'),
        ]);
    }

    public function economicCalendar(Request $request): void
    {
        $this->render('tools/economic-calendar', [
            'title'   => 'Forex Economic Calendar ' . date('Y') . ' - Live Events for Gulf Traders | Trader Gulf',
            'metaDesc'=> 'Live forex economic calendar with high-impact events: NFP, FOMC, CPI, central bank decisions and Gulf market updates. Updated daily.',
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
            'title'    => 'Find Your Perfect Forex Broker - Free Quiz | Trader Gulf',
            'metaDesc' => 'Answer 5 quick questions and we\'ll match you with the best forex broker for your trading style, experience level, and location.',
            'canonical' => url('broker-quiz'),
            'brokersJson' => json_encode($brokers, JSON_HEX_TAG | JSON_HEX_APOS | JSON_UNESCAPED_UNICODE),
        ]);
    }
}
