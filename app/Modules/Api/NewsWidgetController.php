<?php
declare(strict_types=1);

namespace App\Modules\Api;

use App\Core\Controller;
use App\Core\Request;

class NewsWidgetController extends Controller
{
    private const CACHE_TTL = 900; // 15 minutes
    private const RSS_URLS = [
        'https://feeds.finance.yahoo.com/rss/2.0/headline?s=^GSPC,^IXIC,^DJI,EURUSD=X&region=US&lang=en-US',
        'https://feeds.finance.yahoo.com/rss/2.0/headline?region=US&lang=en-US',
    ];
    private const MAX_ITEMS = 6;

    public function feed(Request $request): never
    {
        header('Content-Type: application/json');
        header('Cache-Control: public, max-age=900');

        $cacheFile = sys_get_temp_dir() . '/tg_news.json';
        $cacheAge  = is_file($cacheFile) ? (time() - filemtime($cacheFile)) : PHP_INT_MAX;

        // Serve any cached data immediately (fresh or stale up to 1 hour)
        if ($cacheAge < self::CACHE_TTL * 4) {
            echo file_get_contents($cacheFile);

            // Stale — refresh in background after response is flushed
            if ($cacheAge >= self::CACHE_TTL) {
                if (function_exists('fastcgi_finish_request')) fastcgi_finish_request();
                $items = $this->fetchNews();
                if (!empty($items)) file_put_contents($cacheFile, json_encode($items));
            }

            exit;
        }

        // No usable cache — fetch synchronously
        $items = $this->fetchNews();
        if (!empty($items)) {
            file_put_contents($cacheFile, json_encode($items));
            echo json_encode($items);
        } else {
            echo '[]';
        }
        exit;
    }

    private function fetchNews(): array
    {
        $ctx = stream_context_create([
            'http' => [
                'timeout'       => 8,
                'ignore_errors' => true,
                'header'        => "User-Agent: Mozilla/5.0\r\n",
            ],
            'ssl' => ['verify_peer' => false],
        ]);

        foreach (self::RSS_URLS as $rssUrl) {
            $body = @file_get_contents($rssUrl, false, $ctx);
            if (!$body) continue;

            $items = $this->parseRss($body);
            if (!empty($items)) return $items;
        }

        return [];
    }

    private function parseRss(string $xml): array
    {
        libxml_use_internal_errors(true);
        $feed = simplexml_load_string($xml);
        if (!$feed) return [];

        $items = [];
        $entries = $feed->channel->item ?? [];

        foreach ($entries as $item) {
            if (count($items) >= self::MAX_ITEMS) break;

            $title = trim((string)$item->title);
            $link  = trim((string)$item->link);
            $date  = trim((string)$item->pubDate);
            $desc  = trim(strip_tags((string)($item->description ?? '')));

            if (!$title || !$link) continue;

            $ts = $date ? strtotime($date) : time();

            $items[] = [
                'title'   => $title,
                'url'     => $link,
                'excerpt' => mb_strimwidth($desc, 0, 120, '…'),
                'date'    => date('M j, Y', $ts ?: time()),
                'ts'      => $ts,
            ];
        }

        return $items;
    }
}
