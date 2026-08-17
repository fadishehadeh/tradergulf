<?php
declare(strict_types=1);

namespace App\Modules\Api;

use App\Core\Controller;
use App\Core\Request;

class TickerController extends Controller
{
    private const CACHE_TTL = 300; // 5 minutes
    private const SYMBOLS = [
        'EURUSD=X' => ['label' => 'EUR/USD', 'decimals' => 5],
        'GBPUSD=X' => ['label' => 'GBP/USD', 'decimals' => 5],
        'USDJPY=X' => ['label' => 'USD/JPY', 'decimals' => 3],
        'USDSAR=X' => ['label' => 'USD/SAR', 'decimals' => 4],
        'USDAED=X' => ['label' => 'USD/AED', 'decimals' => 4],
        'GC=F'     => ['label' => 'XAU/USD', 'decimals' => 2],
        'CL=F'     => ['label' => 'WTI Oil', 'decimals' => 2],
        'BTC-USD'  => ['label' => 'BTC/USD', 'decimals' => 0],
    ];

    public function rates(Request $request): never
    {
        header('Content-Type: application/json');
        header('Cache-Control: public, max-age=300');
        header('Access-Control-Allow-Origin: *');

        $cacheFile = sys_get_temp_dir() . '/tg_ticker.json';

        if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < self::CACHE_TTL) {
            echo file_get_contents($cacheFile);
            exit;
        }

        $data = $this->fetchRates();

        if ($data !== null) {
            file_put_contents($cacheFile, json_encode($data));
        } elseif (is_file($cacheFile)) {
            // Return stale cache rather than failing
            echo file_get_contents($cacheFile);
            exit;
        } else {
            $this->json(['error' => 'unavailable'], 503);
        }

        echo json_encode($data);
        exit;
    }

    private function fetchRates(): ?array
    {
        $symbols = implode(',', array_keys(self::SYMBOLS));
        $url = 'https://query1.finance.yahoo.com/v7/finance/quote?symbols='
             . urlencode($symbols)
             . '&fields=symbol,regularMarketPrice,regularMarketChange,regularMarketChangePercent';

        $ctx = stream_context_create([
            'http' => [
                'timeout'        => 8,
                'ignore_errors'  => true,
                'header'         => "User-Agent: Mozilla/5.0\r\n",
            ],
            'ssl' => ['verify_peer' => false],
        ]);

        $body = @file_get_contents($url, false, $ctx);
        if (!$body) return null;

        $json = json_decode($body, true);
        $quotes = $json['quoteResponse']['result'] ?? null;
        if (!$quotes) return null;

        $result = [];
        foreach ($quotes as $q) {
            $sym  = $q['symbol'] ?? '';
            $meta = self::SYMBOLS[$sym] ?? null;
            if (!$meta) continue;

            $price   = round((float)($q['regularMarketPrice'] ?? 0), $meta['decimals']);
            $change  = round((float)($q['regularMarketChange'] ?? 0), $meta['decimals']);
            $changePct = round((float)($q['regularMarketChangePercent'] ?? 0), 2);

            $result[] = [
                'label'     => $meta['label'],
                'price'     => number_format($price, $meta['decimals']),
                'change'    => ($change >= 0 ? '+' : '') . number_format($change, $meta['decimals']),
                'changePct' => ($changePct >= 0 ? '+' : '') . $changePct . '%',
                'up'        => $change >= 0,
            ];
        }

        return $result;
    }
}
