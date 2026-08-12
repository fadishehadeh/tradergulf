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
            'title'   => 'Pip Calculator | Forex Pip Value Calculator | Trader Gulf',
            'metaDesc'=> 'Calculate the pip value for any forex pair and lot size. Supports all major and minor currency pairs.',
        ]);
    }

    public function positionSize(Request $request): void
    {
        $this->render('calculators/position-size', [
            'title'   => 'Position Size Calculator | Forex Risk Calculator | Trader Gulf',
            'metaDesc'=> 'Calculate the correct position size based on your account balance, risk percentage, and stop loss in pips.',
        ]);
    }

    public function margin(Request $request): void
    {
        $this->render('calculators/margin', [
            'title'   => 'Margin Calculator | Required Margin for Forex Trades | Trader Gulf',
            'metaDesc'=> 'Calculate the margin required to open a forex position at any leverage level.',
        ]);
    }

    public function profit(Request $request): void
    {
        $this->render('calculators/profit', [
            'title'   => 'Profit & Loss Calculator | Forex P&L Calculator | Trader Gulf',
            'metaDesc'=> 'Calculate potential profit or loss on a forex trade before you enter the market.',
        ]);
    }
}
