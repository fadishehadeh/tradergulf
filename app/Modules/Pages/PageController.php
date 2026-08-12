<?php
declare(strict_types=1);

namespace App\Modules\Pages;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class PageController extends Controller
{
    private function showPage(string $slug): void
    {
        $page = $this->db()->fetch('SELECT * FROM pages WHERE slug = ?', [$slug]);
        if (!$page) $this->notFound();
        $this->render('pages/show', [
            'title'   => $page['meta_title'] ?? $page['title'] . ' | Trader Gulf',
            'metaDesc'=> $page['meta_description'] ?? '',
            'page'    => $page,
        ]);
    }

    public function about(Request $request): void        { $this->showPage('about'); }
    public function riskDisclaimer(Request $request): void { $this->showPage('risk-disclaimer'); }
    public function privacyPolicy(Request $request): void  { $this->showPage('privacy-policy'); }

    public function contact(Request $request): void
    {
        $this->render('pages/contact', [
            'title'   => 'Contact Trader Gulf | Forex Broker Experts',
            'metaDesc'=> 'Get in touch with the Trader Gulf team. We respond to all broker questions, partnership enquiries, and feedback.',
            'canonical' => url('contact'),
        ]);
    }

    public function contactSubmit(Request $request): void
    {
        $name    = trim($request->input('name', ''));
        $email   = trim($request->input('email', ''));
        $subject = trim($request->input('subject', ''));
        $message = trim($request->input('message', ''));

        if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$message) {
            session()->flash('error', 'Please fill in all required fields with a valid email address.');
            Response::redirect('contact');
        }

        $this->db()->execute(
            'INSERT INTO contact_messages (name, email, subject, message, ip) VALUES (?, ?, ?, ?, ?)',
            [$name, $email, substr($subject, 0, 255), substr($message, 0, 5000),
             $_SERVER['REMOTE_ADDR'] ?? null]
        );

        $to = setting('contact_email', '');
        if ($to) {
            $headers = "From: noreply@tradergulf.com\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
            $mailSubject = '[Trader Gulf Contact] ' . ($subject ?: '(no subject)');
            $body = "Name: $name\nEmail: $email\nSubject: $subject\n\n$message";
            @mail($to, $mailSubject, $body, $headers);
        }

        session()->flash('success', 'Your message has been sent. We\'ll reply within 2 business days.');
        Response::redirect('contact');
    }

    public function team(Request $request): void
    {
        $members = [];
        for ($i = 1; $i <= 5; $i++) {
            $raw = setting("team_bio_$i");
            if ($raw && $decoded = json_decode($raw, true)) {
                $members[] = $decoded;
            }
        }

        $this->render('pages/team', [
            'title'   => 'Meet the Team | Trader Gulf',
            'metaDesc'=> 'The experts behind Trader Gulf — independent forex analysts, traders, and researchers dedicated to unbiased broker reviews.',
            'canonical' => url('team'),
            'members' => $members,
        ]);
    }

    public function methodology(Request $request): void
    {
        $this->render('pages/methodology', [
            'title'   => 'How We Rate Forex Brokers — Our Methodology | Trader Gulf',
            'metaDesc'=> 'Learn how Trader Gulf rates and ranks forex brokers. Our transparent methodology covers regulation, spreads, platforms, deposits, and more.',
            'canonical' => url('methodology'),
        ]);
    }

    public function disclosure(Request $request): void
    {
        $this->render('pages/disclosure', [
            'title'   => 'Affiliate Disclosure | Trader Gulf',
            'metaDesc'=> 'Trader Gulf earns commissions from some brokers we list. This disclosure explains how we maintain independence and transparency.',
            'canonical' => url('affiliate-disclosure'),
        ]);
    }

    public function terms(Request $request): void
    {
        $this->render('pages/terms', [
            'title'   => 'Terms of Service | Trader Gulf',
            'metaDesc'=> 'Read the Trader Gulf terms of service governing use of our website, tools, and broker review content.',
            'canonical' => url('terms-of-service'),
        ]);
    }

    public function islamicBrokers(Request $request): void
    {
        $brokers = $this->db()->fetchAll(
            'SELECT * FROM brokers WHERE is_active = 1 AND has_islamic = 1 ORDER BY overall_rating DESC'
        );

        $seoPage = $this->db()->fetch(
            "SELECT * FROM seo_pages WHERE slug = 'islamic-forex-brokers' AND is_published = 1"
        );

        $faqs = [];
        if ($seoPage && !empty($seoPage['faq_json'])) {
            $faqs = json_decode($seoPage['faq_json'], true) ?: [];
        }

        $faqSchema = null;
        if ($faqs) {
            $faqSchema = json_encode([
                '@context' => 'https://schema.org',
                '@type'    => 'FAQPage',
                'mainEntity' => array_map(fn($f) => [
                    '@type'          => 'Question',
                    'name'           => $f['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
                ], $faqs),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        $this->render('pages/islamic-brokers', [
            'title'   => 'Best Islamic Forex Brokers 2025 | Halal Swap-Free Accounts | Trader Gulf',
            'metaDesc'=> 'Compare the best Islamic forex brokers with genuine swap-free halal accounts. No riba, no interest. Suitable for UAE, Saudi Arabia, Kuwait traders.',
            'canonical' => url('islamic-forex-brokers'),
            'brokers' => $brokers,
            'seoPage' => $seoPage,
            'faqs'    => $faqs,
            'headSchemas' => $faqSchema ? "<script type=\"application/ld+json\">$faqSchema</script>" : '',
        ]);
    }

    public function advertise(Request $request): void
    {
        $this->render('pages/advertise', [
            'title'     => 'Advertise With Trader Gulf — Reach MENA Forex Traders',
            'metaDesc'  => 'Reach thousands of active forex traders in UAE, Saudi Arabia, and Kuwait. View our ad formats, pricing, and media kit.',
            'canonical' => url('advertise'),
        ]);
    }

    public function robotsTxt(Request $request): void
    {
        $content = setting('robots_txt');
        if (empty($content)) {
            $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /go/\n";
        }
        if (!str_contains($content, 'Disallow: /go/')) {
            $content = rtrim($content) . "\nDisallow: /go/\n";
        }
        if (!str_contains($content, 'Sitemap:')) {
            $content = rtrim($content) . "\n\nSitemap: " . url('sitemap.xml') . "\n";
        }
        header('Content-Type: text/plain; charset=UTF-8');
        echo $content;
        exit;
    }
}
