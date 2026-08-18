<?php
declare(strict_types=1);

namespace App\Modules\Api;

use App\Core\Controller;
use App\Core\Request;

class EconomicCalendarController extends Controller
{
    private const CACHE_TTL = 900; // 15 minutes
    private const FEED_URL  = 'https://nfs.faireconomy.media/ff_calendar_thisweek.json?version=latest';

    public function feed(Request $request): never
    {
        header('Content-Type: application/json');
        header('Cache-Control: public, max-age=900');
        header('Access-Control-Allow-Origin: *');

        $cacheFile = sys_get_temp_dir() . '/tg_econ_calendar.json';

        if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < self::CACHE_TTL) {
            echo file_get_contents($cacheFile);
            exit;
        }

        $ch = curl_init(self::FEED_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_USERAGENT      => 'TraderGulf/1.0',
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ]);
        $body = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($body && $code === 200) {
            // Filter to relevant currencies only and clean up
            $events = json_decode($body, true) ?: [];
            $relevant = ['USD', 'EUR', 'GBP', 'JPY', 'AUD', 'CAD', 'CHF', 'NZD', 'AED', 'SAR'];
            $filtered = array_values(array_filter($events, fn($e) => in_array($e['currency'] ?? '', $relevant)));
            $out = json_encode($filtered, JSON_UNESCAPED_UNICODE);
            file_put_contents($cacheFile, $out);
            echo $out;
        } elseif (is_file($cacheFile)) {
            echo file_get_contents($cacheFile);
        } else {
            http_response_code(503);
            echo json_encode(['error' => 'Calendar data unavailable']);
        }
        exit;
    }
}
