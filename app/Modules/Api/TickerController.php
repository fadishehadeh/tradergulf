<?php
declare(strict_types=1);

namespace App\Modules\Api;

use App\Core\Controller;
use App\Core\Request;

class TickerController extends Controller
{
    private const CACHE_TTL = 300; // 5 minutes

    // Yahoo Finance symbols for chart API
    private const YF_SYMBOLS = [
        'EURUSD=X' => ['label' => 'EUR/USD', 'decimals' => 5],
        'GBPUSD=X' => ['label' => 'GBP/USD', 'decimals' => 5],
        'USDJPY=X' => ['label' => 'USD/JPY', 'decimals' => 3],
        'USDSAR=X' => ['label' => 'USD/SAR', 'decimals' => 4],
        'USDAED=X' => ['label' => 'USD/AED', 'decimals' => 4],
        'GC=F'     => ['label' => 'Gold',    'decimals' => 2],
        'CL=F'     => ['label' => 'WTI Oil', 'decimals' => 2],
        'BTC-USD'  => ['label' => 'BTC/USD', 'decimals' => 0],
    ];

    public function rates(Request $request): never
    {
        header('Content-Type: application/json');
        header('Cache-Control: public, max-age=300');

        $cacheFile = sys_get_temp_dir() . '/tg_ticker.json';
        $cacheAge  = is_file($cacheFile) ? (time() - filemtime($cacheFile)) : PHP_INT_MAX;

        // Serve any cached data immediately (fresh or stale up to 20 minutes)
        if ($cacheAge < self::CACHE_TTL * 4) {
            echo file_get_contents($cacheFile);

            // Stale - refresh in background after response is flushed
            if ($cacheAge >= self::CACHE_TTL) {
                if (function_exists('fastcgi_finish_request')) fastcgi_finish_request();
                $data = $this->fetchFromYahoo();
                if (empty($data)) $data = $this->fetchFallback();
                if (!empty($data)) file_put_contents($cacheFile, json_encode($data));
            }

            exit;
        }

        // No usable cache - fetch synchronously
        $data = $this->fetchFromYahoo();
        if (empty($data)) $data = $this->fetchFallback();

        if (!empty($data)) {
            file_put_contents($cacheFile, json_encode($data));
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
        exit;
    }

    private function fetchFromYahoo(): array
    {
        $symbols = implode(',', array_keys(self::YF_SYMBOLS));
        $url = 'https://query2.finance.yahoo.com/v8/finance/spark?symbols='
             . urlencode($symbols)
             . '&range=1d&interval=1d';

        $body = $this->httpGet($url);
        if (!$body) return [];

        $json = json_decode($body, true);
        $spark = $json['spark']['result'] ?? null;
        if (!$spark) return [];

        $result = [];
        foreach ($spark as $entry) {
            $sym  = $entry['symbol'] ?? '';
            $meta = self::YF_SYMBOLS[$sym] ?? null;
            if (!$meta) continue;

            $response = $entry['response'][0] ?? null;
            if (!$response) continue;

            $closes  = $response['indicators']['quote'][0]['close'] ?? [];
            $closes  = array_values(array_filter($closes, fn($v) => $v !== null));
            if (count($closes) < 1) continue;

            $current  = end($closes);
            $previous = count($closes) > 1 ? $closes[count($closes) - 2] : $current;
            $change   = $current - $previous;
            $changePct = $previous != 0 ? ($change / $previous) * 100 : 0;

            $dec = $meta['decimals'];
            $result[] = [
                'label'     => $meta['label'],
                'price'     => number_format($current, $dec),
                'change'    => ($change >= 0 ? '+' : '') . number_format($change, $dec),
                'changePct' => ($changePct >= 0 ? '+' : '') . number_format($changePct, 2) . '%',
                'up'        => $change >= 0,
            ];
        }

        return $result;
    }

    private function fetchFallback(): array
    {
        // ExchangeRate-API (free, no key required)
        $url  = 'https://open.er-api.com/v6/latest/USD';
        $body = $this->httpGet($url);
        if (!$body) return [];

        $json  = json_decode($body, true);
        $rates = $json['rates'] ?? null;
        if (!$rates) return [];

        $pairs = [
            ['label' => 'EUR/USD', 'val' => 1 / ($rates['EUR'] ?? 0), 'dec' => 5],
            ['label' => 'GBP/USD', 'val' => 1 / ($rates['GBP'] ?? 0), 'dec' => 5],
            ['label' => 'USD/JPY', 'val' => $rates['JPY'] ?? 0,       'dec' => 3],
            ['label' => 'USD/SAR', 'val' => $rates['SAR'] ?? 0,       'dec' => 4],
            ['label' => 'USD/AED', 'val' => $rates['AED'] ?? 0,       'dec' => 4],
        ];

        // BTC from CoinGecko
        $btcBody = $this->httpGet('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd&include_24hr_change=true');
        if ($btcBody) {
            $btc = json_decode($btcBody, true)['bitcoin'] ?? null;
            if ($btc) {
                $pairs[] = ['label' => 'BTC/USD', 'val' => $btc['usd'] ?? 0, 'dec' => 0, 'pct' => $btc['usd_24h_change'] ?? 0];
            }
        }

        $result = [];
        foreach ($pairs as $p) {
            if (empty($p['val'])) continue;
            $pct = $p['pct'] ?? 0;
            $result[] = [
                'label'     => $p['label'],
                'price'     => number_format($p['val'], $p['dec']),
                'change'    => '',
                'changePct' => ($pct >= 0 ? '+' : '') . number_format($pct, 2) . '%',
                'up'        => $pct >= 0,
            ];
        }

        return $result;
    }

    private function httpGet(string $url): string|false
    {
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 8,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                CURLOPT_HTTPHEADER     => ['Accept: application/json, text/plain, */*'],
            ]);
            $body = curl_exec($ch);
            $err  = curl_errno($ch);
            curl_close($ch);
            return ($err === 0 && $body) ? $body : false;
        }

        $ctx = stream_context_create([
            'http' => ['timeout' => 8, 'ignore_errors' => true,
                       'header'  => "User-Agent: Mozilla/5.0\r\n"],
            'ssl'  => ['verify_peer' => false],
        ]);
        return @file_get_contents($url, false, $ctx);
    }
}
