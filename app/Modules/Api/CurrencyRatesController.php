<?php
declare(strict_types=1);

namespace App\Modules\Api;

use App\Core\Controller;
use App\Core\Request;

class CurrencyRatesController extends Controller
{
    private const CACHE_TTL = 3600; // 1 hour — ECB rates update once daily
    private const API_URL   = 'https://api.frankfurter.app/latest?base=EUR';

    public function rates(Request $request): never
    {
        header('Content-Type: application/json');
        header('Cache-Control: public, max-age=3600');
        header('Access-Control-Allow-Origin: *');

        $cacheFile = sys_get_temp_dir() . '/tg_currency_rates.json';

        if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < self::CACHE_TTL) {
            echo file_get_contents($cacheFile);
            exit;
        }

        $ch = curl_init(self::API_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_USERAGENT      => 'TraderGulf/1.0',
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($body && $code === 200) {
            file_put_contents($cacheFile, $body);
            echo $body;
        } elseif (is_file($cacheFile)) {
            echo file_get_contents($cacheFile); // serve stale cache on failure
        } else {
            http_response_code(503);
            echo json_encode(['error' => 'Rate data unavailable']);
        }
        exit;
    }
}
