<?php
declare(strict_types=1);

namespace App\Modules\Chat;

use App\Core\Controller;
use App\Core\Request;

class ChatController extends Controller
{
    public function respond(Request $request): void
    {
        header('Content-Type: application/json');

        $raw = file_get_contents('php://input');
        $body = json_decode($raw, true);
        $message = trim((string)($body['message'] ?? ''));

        if ($message === '') {
            echo json_encode(['reply' => "Hi! How can I help you? Ask me about forex brokers, trading conditions, or how to use our tools."]);
            exit;
        }

        // If Claude API key is configured, use it
        $apiKey = setting('claude_api_key', '');
        if ($apiKey !== '') {
            $reply = $this->claudeReply($message, $apiKey);
            echo json_encode(['reply' => $reply]);
            exit;
        }

        // Fallback: keyword-based DB-powered answers
        $reply = $this->keywordReply(strtolower($message));
        echo json_encode(['reply' => $reply]);
        exit;
    }

    private function claudeReply(string $message, string $apiKey): string
    {
        $siteName = setting('site_name', 'Trader Gulf');
        $systemPrompt = "You are a helpful assistant for {$siteName}, an independent forex broker review website. "
            . "Answer questions about forex brokers, trading, regulations, spreads, leverage, and how to use the site's tools. "
            . "Keep answers concise (2-4 sentences). Do not give personalized financial advice. "
            . "If asked about a specific broker, focus on objective facts like regulation, spreads, and minimum deposit. "
            . "Always recommend the user consult a licensed financial advisor for investment decisions.";

        $payload = json_encode([
            'model' => 'claude-haiku-4-5-20251001',
            'max_tokens' => 300,
            'system' => $systemPrompt,
            'messages' => [['role' => 'user', 'content' => $message]],
        ]);

        $ch = curl_init('https://api.anthropic.com/v1/messages');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => [
                'x-api-key: ' . $apiKey,
                'anthropic-version: 2023-06-01',
                'content-type: application/json',
            ],
            CURLOPT_TIMEOUT        => 10,
        ]);

        $res  = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code !== 200 || !$res) {
            return $this->keywordReply(strtolower($message));
        }

        $data = json_decode($res, true);
        return $data['content'][0]['text'] ?? $this->keywordReply(strtolower($message));
    }

    private function keywordReply(string $msg): string
    {
        $db = $this->db();

        // Islamic accounts
        if (str_contains($msg, 'islamic') || str_contains($msg, 'halal') || str_contains($msg, 'swap free') || str_contains($msg, 'swap-free')) {
            $brokers = $db->fetchAll(
                "SELECT name, min_deposit, max_leverage FROM brokers WHERE has_islamic = 1 AND is_active = 1 ORDER BY overall_rating DESC LIMIT 5"
            );
            if ($brokers) {
                $names = implode(', ', array_column($brokers, 'name'));
                return "We track the following brokers with Islamic (swap-free) accounts: {$names}. Visit our <a href='/islamic-forex-brokers'>Islamic Forex Brokers</a> page for detailed comparisons.";
            }
        }

        // Best broker / recommendation
        if (preg_match('/best broker|top broker|recommend|which broker/i', $msg)) {
            $brokers = $db->fetchAll(
                "SELECT name, overall_rating, regulation FROM brokers WHERE is_active = 1 ORDER BY overall_rating DESC LIMIT 3"
            );
            if ($brokers) {
                $list = array_map(fn($b) => "{$b['name']} ({$b['overall_rating']}/10)", $brokers);
                return "Our top-rated brokers are: " . implode(', ', $list) . ". Use our <a href='/broker-quiz'>Broker Quiz</a> to get a personalised match, or <a href='/compare'>Compare Brokers</a> side-by-side.";
            }
        }

        // Low minimum deposit
        if (str_contains($msg, 'low deposit') || str_contains($msg, 'minimum deposit') || str_contains($msg, 'min deposit') || str_contains($msg, '$1') || str_contains($msg, '10 dollar')) {
            $brokers = $db->fetchAll(
                "SELECT name, min_deposit FROM brokers WHERE is_active = 1 AND min_deposit > 0 ORDER BY min_deposit ASC LIMIT 4"
            );
            if ($brokers) {
                $list = array_map(fn($b) => "{$b['name']} (\${$b['min_deposit']})", $brokers);
                return "The brokers with the lowest minimum deposits on our site are: " . implode(', ', $list) . ".";
            }
        }

        // High leverage
        if (str_contains($msg, 'leverage') || str_contains($msg, '1:500') || str_contains($msg, '1:1000')) {
            $brokers = $db->fetchAll(
                "SELECT name, max_leverage FROM brokers WHERE is_active = 1 AND max_leverage != '' ORDER BY CAST(REPLACE(max_leverage,'1:','') AS UNSIGNED) DESC LIMIT 4"
            );
            if ($brokers) {
                $list = array_map(fn($b) => "{$b['name']} ({$b['max_leverage']})", $brokers);
                return "Brokers offering high leverage: " . implode(', ', $list) . ". Note: high leverage increases both potential profit and risk.";
            }
        }

        // Spread / EUR/USD
        if (str_contains($msg, 'spread') || str_contains($msg, 'eurusd') || str_contains($msg, 'eur/usd')) {
            $brokers = $db->fetchAll(
                "SELECT name, spread_eurusd FROM brokers WHERE is_active = 1 AND spread_eurusd > 0 ORDER BY spread_eurusd ASC LIMIT 4"
            );
            if ($brokers) {
                $list = array_map(fn($b) => "{$b['name']} ({$b['spread_eurusd']} pips)", $brokers);
                return "Lowest EUR/USD spreads: " . implode(', ', $list) . ". Compare all brokers on our <a href='/compare'>Compare Tool</a>.";
            }
        }

        // MT4 / MT5
        if (str_contains($msg, 'mt4') || str_contains($msg, 'metatrader 4')) {
            $brokers = $db->fetchAll("SELECT name FROM brokers WHERE is_active=1 AND platforms LIKE '%MT4%' LIMIT 5");
            if ($brokers) return "Brokers offering MetaTrader 4: " . implode(', ', array_column($brokers, 'name')) . ".";
        }
        if (str_contains($msg, 'mt5') || str_contains($msg, 'metatrader 5')) {
            $brokers = $db->fetchAll("SELECT name FROM brokers WHERE is_active=1 AND platforms LIKE '%MT5%' LIMIT 5");
            if ($brokers) return "Brokers offering MetaTrader 5: " . implode(', ', array_column($brokers, 'name')) . ".";
        }

        // UAE / Saudi / Kuwait
        if (str_contains($msg, 'uae') || str_contains($msg, 'dubai') || str_contains($msg, 'abu dhabi') || str_contains($msg, 'united arab')) {
            return "We have a dedicated page for UAE traders: <a href='/best/best-forex-brokers-in-uae'>Best Forex Brokers in UAE</a>. It covers DFSA-regulated brokers and UAE-specific trading conditions.";
        }
        if (str_contains($msg, 'saudi') || str_contains($msg, 'ksa') || str_contains($msg, 'riyadh')) {
            return "See our <a href='/best/best-forex-brokers-in-saudi-arabia'>Best Forex Brokers in Saudi Arabia</a> page for brokers accepting Saudi residents and CMA regulatory info.";
        }
        if (str_contains($msg, 'kuwait')) {
            return "Check our <a href='/best/best-forex-brokers-in-kuwait'>Best Forex Brokers in Kuwait</a> page for brokers serving Kuwaiti traders.";
        }

        // Currency converter
        if (str_contains($msg, 'currency') || str_contains($msg, 'convert') || str_contains($msg, 'exchange rate') || str_contains($msg, 'aed') || str_contains($msg, 'sar')) {
            return "Use our free <a href='/currency-converter'>Currency Converter</a> for live exchange rates on AED, SAR, USD, EUR, GBP, and 150+ currencies powered by the European Central Bank.";
        }

        // Economic calendar
        if (str_contains($msg, 'calendar') || str_contains($msg, 'nfp') || str_contains($msg, 'fomc') || str_contains($msg, 'cpi') || str_contains($msg, 'event')) {
            return "Check our <a href='/economic-calendar'>Economic Calendar</a> for upcoming high-impact forex events including NFP, FOMC, CPI releases and central bank decisions.";
        }

        // Calculator
        if (str_contains($msg, 'pip') || str_contains($msg, 'calculator') || str_contains($msg, 'position size') || str_contains($msg, 'margin')) {
            return "We offer four free trading calculators: <a href='/calculators/pip'>Pip</a>, <a href='/calculators/position-size'>Position Size</a>, <a href='/calculators/margin'>Margin</a>, and <a href='/calculators/profit'>Profit</a>. Visit <a href='/calculators'>Calculators</a> to get started.";
        }

        // Compare
        if (str_contains($msg, 'compare') || str_contains($msg, 'versus') || str_contains($msg, ' vs ')) {
            return "Use our <a href='/compare'>Broker Comparison Tool</a> to select up to 4 brokers and compare spreads, leverage, regulation, platforms, and more side-by-side.";
        }

        // Regulation / safety
        if (str_contains($msg, 'regulat') || str_contains($msg, 'safe') || str_contains($msg, 'fca') || str_contains($msg, 'cysec') || str_contains($msg, 'asic')) {
            return "We only review regulated brokers. Key regulators include FCA (UK), ASIC (Australia), CySEC (Cyprus), DFSA (UAE), and FSCA (South Africa). Regulation details are shown on every broker review page.";
        }

        // Advertise / partnership
        if (str_contains($msg, 'advertise') || str_contains($msg, 'partnership') || str_contains($msg, 'sponsor') || str_contains($msg, 'ad space')) {
            return "Interested in advertising with Trader Gulf? Visit our <a href='/advertise'>Advertise With Us</a> page for media kit, ad formats, and pricing. Or use our <a href='/contact'>Contact Form</a> to reach us directly.";
        }

        // About / contact
        if (str_contains($msg, 'about') || str_contains($msg, 'who are you') || str_contains($msg, 'who is')) {
            return setting('site_name', 'Trader Gulf') . " is an independent forex broker review platform. We review and compare brokers for transparency and safety. Read more on our <a href='/about'>About</a> page.";
        }
        if (str_contains($msg, 'contact') || str_contains($msg, 'email') || str_contains($msg, 'reach')) {
            return "You can reach us via our <a href='/contact'>Contact Form</a>. We typically respond within 1–2 business days.";
        }

        // Greetings
        if (preg_match('/^(hi|hello|hey|salam|مرحبا)/i', $msg)) {
            return "Hello! I'm the Trader Gulf assistant. Ask me about forex brokers, trading tools, or anything else on this site. How can I help?";
        }

        // Default
        $brokerCount = (int)$db->fetchValue("SELECT COUNT(*) FROM brokers WHERE is_active=1");
        return "I can help you find the right forex broker from our database of {$brokerCount} reviewed brokers. Try asking about: <em>best brokers, Islamic accounts, low spreads, MT4, or specific countries like UAE or Saudi Arabia</em>. Or use our <a href='/broker-quiz'>Broker Quiz</a> for a personalised recommendation.";
    }
}
