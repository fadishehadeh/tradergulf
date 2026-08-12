<?php
declare(strict_types=1);

use App\Modules\Home\HomeController;
use App\Modules\Brokers\BrokerController;
use App\Modules\Compare\CompareController;
use App\Modules\Calculators\CalculatorController;
use App\Modules\Glossary\GlossaryController;
use App\Modules\Guides\GuideController;
use App\Modules\Pages\PageController;
use App\Modules\Tools\ToolsController;
use App\Modules\Newsletter\NewsletterController;
use App\Modules\SetLang\SetLangController;
use App\Modules\Admin\Auth\AdminAuthController;
use App\Modules\Admin\Dashboard\AdminDashboardController;
use App\Modules\Admin\Brokers\AdminBrokerController;
use App\Modules\Admin\Reviews\AdminReviewController;
use App\Modules\Admin\Articles\AdminArticleController;
use App\Modules\Admin\Glossary\AdminGlossaryController;
use App\Modules\Admin\Pages\AdminPagesController;
use App\Modules\Admin\Settings\AdminSettingsController;
use App\Modules\Admin\Banners\AdminBannerController;
use App\Modules\Admin\Seo\AdminSeoController;
use App\Modules\Admin\Sitemap\AdminSitemapController;
use App\Modules\Admin\Newsletter\AdminNewsletterController;
use App\Modules\SeoPages\SeoPageController;
use App\Modules\Chat\ChatController;
use App\Modules\Affiliate\AffiliateController;
use App\Modules\Rss\RssController;
use App\Modules\Admin\Contacts\AdminContactController;
use App\Modules\Admin\Analytics\AdminAnalyticsController;

$router = $app->router();

// ── Public routes ──────────────────────────────────────────────

// Home
$router->get('/', [HomeController::class, 'index']);

// Language switcher
$router->get('/set-lang/{lang}', [SetLangController::class, 'switch']);

// Brokers
$router->get('/brokers', [BrokerController::class, 'index']);
$router->get('/brokers/{slug}', [BrokerController::class, 'show']);

// Compare
$router->get('/compare', [CompareController::class, 'index']);
$router->get('/compare/data', [CompareController::class, 'data']);

// Calculators
$router->get('/calculators/pip', [CalculatorController::class, 'pip']);
$router->get('/calculators/position-size', [CalculatorController::class, 'positionSize']);
$router->get('/calculators/margin', [CalculatorController::class, 'margin']);
$router->get('/calculators/profit', [CalculatorController::class, 'profit']);
$router->get('/calculators', [CalculatorController::class, 'index']);

// Glossary
$router->get('/glossary', [GlossaryController::class, 'index']);
$router->get('/glossary/{slug}', [GlossaryController::class, 'show']);

// Guides / News
$router->get('/guides', [GuideController::class, 'index']);
$router->get('/guides/{slug}', [GuideController::class, 'show']);
$router->get('/news', [GuideController::class, 'news']);
$router->get('/news/{slug}', [GuideController::class, 'showNews']);

// SEO landing pages
$router->get('/best/{slug}', [SeoPageController::class, 'show']);

// Tools (Phase 4)
$router->get('/currency-converter', [ToolsController::class, 'currencyConverter']);
$router->get('/economic-calendar', [ToolsController::class, 'economicCalendar']);
$router->get('/broker-quiz', [ToolsController::class, 'brokerQuiz']);

// Newsletter (Phase 4)
$router->post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);

// Static pages
$router->get('/about', [PageController::class, 'about']);
$router->get('/risk-disclaimer', [PageController::class, 'riskDisclaimer']);
$router->get('/privacy-policy', [PageController::class, 'privacyPolicy']);
$router->get('/contact', [PageController::class, 'contact']);
$router->post('/contact', [PageController::class, 'contactSubmit']);
$router->get('/robots.txt', [PageController::class, 'robotsTxt']);

// Trust / Legal pages (Phase 1)
$router->get('/team', [PageController::class, 'team']);
$router->get('/methodology', [PageController::class, 'methodology']);
$router->get('/affiliate-disclosure', [PageController::class, 'disclosure']);
$router->get('/terms-of-service', [PageController::class, 'terms']);

// MENA / Gulf pages (Phase 2)
$router->get('/islamic-forex-brokers', [PageController::class, 'islamicBrokers']);

// Advertise page
$router->get('/advertise', [PageController::class, 'advertise']);

// AI Chat endpoint
$router->post('/api/chat', [ChatController::class, 'respond']);

// Affiliate link cloaking
$router->get('/go/{slug}', [AffiliateController::class, 'go']);

// RSS feed
$router->get('/feed', [RssController::class, 'feed']);

// ── Admin routes ───────────────────────────────────────────────

// Auth
$router->get('/admin/login', [AdminAuthController::class, 'loginForm']);
$router->post('/admin/login', [AdminAuthController::class, 'login']);
$router->post('/admin/logout', [AdminAuthController::class, 'logout']);

// Dashboard
$router->get('/admin', [AdminDashboardController::class, 'index']);

// Analytics
$router->get('/admin/analytics', [AdminAnalyticsController::class, 'index']);

// Brokers
$router->get('/admin/brokers', [AdminBrokerController::class, 'index']);
$router->get('/admin/brokers/create', [AdminBrokerController::class, 'create']);
$router->post('/admin/brokers/create', [AdminBrokerController::class, 'store']);
$router->get('/admin/brokers/{id}/edit', [AdminBrokerController::class, 'edit']);
$router->post('/admin/brokers/{id}/edit', [AdminBrokerController::class, 'update']);
$router->post('/admin/brokers/{id}/delete', [AdminBrokerController::class, 'destroy']);

// Broker reviews
$router->get('/admin/brokers/{id}/review', [AdminReviewController::class, 'edit']);
$router->post('/admin/brokers/{id}/review', [AdminReviewController::class, 'update']);

// Articles
$router->get('/admin/articles', [AdminArticleController::class, 'index']);
$router->get('/admin/articles/create', [AdminArticleController::class, 'create']);
$router->post('/admin/articles/create', [AdminArticleController::class, 'store']);
$router->get('/admin/articles/{id}/edit', [AdminArticleController::class, 'edit']);
$router->post('/admin/articles/{id}/edit', [AdminArticleController::class, 'update']);
$router->post('/admin/articles/{id}/delete', [AdminArticleController::class, 'destroy']);

// Glossary
$router->get('/admin/glossary', [AdminGlossaryController::class, 'index']);
$router->get('/admin/glossary/create', [AdminGlossaryController::class, 'create']);
$router->post('/admin/glossary/create', [AdminGlossaryController::class, 'store']);
$router->get('/admin/glossary/{id}/edit', [AdminGlossaryController::class, 'edit']);
$router->post('/admin/glossary/{id}/edit', [AdminGlossaryController::class, 'update']);
$router->post('/admin/glossary/{id}/delete', [AdminGlossaryController::class, 'destroy']);

// Static pages
$router->get('/admin/pages', [AdminPagesController::class, 'index']);
$router->get('/admin/pages/{id}/edit', [AdminPagesController::class, 'edit']);
$router->post('/admin/pages/{id}/edit', [AdminPagesController::class, 'update']);

// Banners
$router->get('/admin/banners', [AdminBannerController::class, 'index']);
$router->get('/admin/banners/{id}/edit', [AdminBannerController::class, 'edit']);
$router->post('/admin/banners/{id}/edit', [AdminBannerController::class, 'update']);

// SEO Pages
$router->get('/admin/seo', [AdminSeoController::class, 'index']);
$router->get('/admin/seo/create', [AdminSeoController::class, 'create']);
$router->post('/admin/seo/create', [AdminSeoController::class, 'store']);
$router->get('/admin/seo/{id}/edit', [AdminSeoController::class, 'edit']);
$router->post('/admin/seo/{id}/edit', [AdminSeoController::class, 'update']);
$router->post('/admin/seo/{id}/delete', [AdminSeoController::class, 'destroy']);

// Settings
$router->get('/admin/settings', [AdminSettingsController::class, 'index']);
$router->post('/admin/settings', [AdminSettingsController::class, 'update']);

// Sitemap generator
$router->get('/admin/sitemap', [AdminSitemapController::class, 'index']);
$router->post('/admin/sitemap/generate', [AdminSitemapController::class, 'generate']);
$router->post('/admin/sitemap/ping', [AdminSitemapController::class, 'ping']);

// Newsletter admin
$router->get('/admin/newsletter', [AdminNewsletterController::class, 'index']);
$router->post('/admin/newsletter/{id}/delete', [AdminNewsletterController::class, 'delete']);

// Contact messages admin
$router->get('/admin/contacts', [AdminContactController::class, 'index']);
$router->get('/admin/contacts/{id}', [AdminContactController::class, 'show']);
$router->post('/admin/contacts/{id}/delete', [AdminContactController::class, 'delete']);
