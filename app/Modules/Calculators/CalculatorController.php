<?php
declare(strict_types=1);

namespace App\Modules\Calculators;

use App\Core\Controller;
use App\Core\Request;

class CalculatorController extends Controller
{
    public function index(Request $request): void
    {
        $this->render('calculators/index', [
            'title'   => 'Forex Trading Calculators | Pip, Margin & Position Size | Trader Gulf',
            'metaDesc'=> 'Free forex calculators: pip value, position size, margin required, and profit/loss. Instant results.',
        ]);
    }

    public function pip(Request $request): void
    {
        $this->render('calculators/pip', [
            'title'      => 'Pip Calculator | Forex Pip Value Calculator | Trader Gulf',
            'metaDesc'   => 'Calculate the pip value for any forex pair and lot size. Supports all major and minor currency pairs.',
            'canonical'  => url('calculators/pip'),
            'headSchemas'=> $this->calcSchemas('pip', 'How to Calculate Forex Pip Value', [
                ['Select Currency Pair', 'Choose the forex pair you want to trade, e.g. EUR/USD or GBP/USD.'],
                ['Enter Lot Size', 'Enter your position size in standard lots (1 lot = 100,000 units), mini lots, or micro lots.'],
                ['Select Account Currency', 'Choose the base currency of your trading account (USD, EUR, GBP, etc.).'],
                ['Read Results', 'The calculator instantly shows the monetary value of one pip for your selected pair and lot size.'],
            ]),
        ]);
    }

    public function positionSize(Request $request): void
    {
        $this->render('calculators/position-size', [
            'title'      => 'Position Size Calculator | Forex Risk Calculator | Trader Gulf',
            'metaDesc'   => 'Calculate the correct position size based on your account balance, risk percentage, and stop loss in pips.',
            'canonical'  => url('calculators/position-size'),
            'headSchemas'=> $this->calcSchemas('position-size', 'How to Calculate Forex Position Size', [
                ['Enter Account Balance', 'Input your total trading account balance in your account currency.'],
                ['Set Risk Percentage', 'Enter the percentage of your balance you are willing to risk on this trade (e.g. 1% or 2%).'],
                ['Input Stop Loss in Pips', 'Enter the distance of your stop loss from your entry price, measured in pips.'],
                ['Select Currency Pair', 'Choose the forex pair you are trading so the calculator can apply correct pip values.'],
                ['Read Recommended Lot Size', 'The calculator shows the precise position size in lots that matches your risk parameters.'],
            ]),
        ]);
    }

    public function margin(Request $request): void
    {
        $this->render('calculators/margin', [
            'title'      => 'Margin Calculator | Required Margin for Forex Trades | Trader Gulf',
            'metaDesc'   => 'Calculate the margin required to open a forex position at any leverage level.',
            'canonical'  => url('calculators/margin'),
            'headSchemas'=> $this->calcSchemas('margin', 'How to Calculate Forex Margin Required', [
                ['Select Currency Pair', 'Choose the forex pair for which you want to calculate margin requirements.'],
                ['Enter Lot Size', 'Input the number of lots you plan to trade.'],
                ['Set Leverage', 'Enter the leverage your broker offers (e.g. 1:100, 1:200, 1:500).'],
                ['Read Required Margin', 'The calculator shows the minimum margin your broker requires to open this position.'],
            ]),
        ]);
    }

    public function profit(Request $request): void
    {
        $this->render('calculators/profit', [
            'title'      => 'Profit & Loss Calculator | Forex P&L Calculator | Trader Gulf',
            'metaDesc'   => 'Calculate potential profit or loss on a forex trade before you enter the market.',
            'canonical'  => url('calculators/profit'),
            'headSchemas'=> $this->calcSchemas('profit', 'How to Calculate Forex Profit or Loss', [
                ['Select Currency Pair', 'Choose the forex pair you traded or plan to trade.'],
                ['Enter Entry and Exit Prices', 'Input your entry price and the target or actual exit price for the trade.'],
                ['Enter Lot Size', 'Specify the position size in lots.'],
                ['Choose Direction', 'Select whether the trade is a Buy (long) or Sell (short).'],
                ['View Profit or Loss', 'The calculator instantly displays the expected profit or loss in pips and your account currency.'],
            ]),
        ]);
    }

    private function calcSchemas(string $calcSlug, string $howToName, array $steps): string
    {
        $schemaSteps = array_map(fn($s) => [
            '@type' => 'HowToStep',
            'name'  => $s[0],
            'text'  => $s[1],
        ], $steps);

        $howTo = json_encode([
            '@context'    => 'https://schema.org',
            '@type'       => 'HowTo',
            'name'        => $howToName,
            'description' => 'Free forex calculator tool on Trader Gulf',
            'step'        => $schemaSteps,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $breadcrumb = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url()],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Calculators', 'item' => url('calculators')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $howToName, 'item' => url('calculators/' . $calcSlug)],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return "<script type=\"application/ld+json\">$howTo</script>\n<script type=\"application/ld+json\">$breadcrumb</script>";
    }
}
