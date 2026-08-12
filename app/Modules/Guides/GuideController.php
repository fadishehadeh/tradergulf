<?php
declare(strict_types=1);

namespace App\Modules\Guides;

use App\Core\Controller;
use App\Core\Request;

class GuideController extends Controller
{
    public function index(Request $request): void
    {
        $guides = $this->db()->fetchAll(
            "SELECT id, slug, title, excerpt, featured_image, published_at
             FROM articles WHERE category = 'guide' AND is_published = 1
             ORDER BY published_at DESC"
        );

        $this->render('guides/index', [
            'title'   => 'Forex Trading Guides | Learn to Trade | Trader Gulf',
            'metaDesc'=> 'Beginner-friendly forex trading guides. Learn the basics of forex, risk management, platforms, and strategy.',
            'guides'  => $guides,
        ]);
    }

    public function show(Request $request, string $slug): void
    {
        $guide = $this->db()->fetch(
            "SELECT * FROM articles WHERE slug = ? AND category = 'guide' AND is_published = 1",
            [$slug]
        );

        if (!$guide) $this->notFound();

        $related = $this->db()->fetchAll(
            "SELECT slug, title, excerpt, published_at FROM articles
             WHERE category = 'guide' AND is_published = 1 AND slug != ?
             ORDER BY published_at DESC LIMIT 3",
            [$slug]
        );

        $this->render('guides/show', [
            'title'   => ($guide['meta_title'] ?? $guide['title']) . ' | Trader Gulf',
            'metaDesc'=> $guide['meta_description'] ?? $guide['excerpt'] ?? '',
            'guide'   => $guide,
            'related' => $related,
        ]);
    }

    public function news(Request $request): void
    {
        $news = $this->db()->fetchAll(
            "SELECT id, slug, title, excerpt, featured_image, published_at
             FROM articles WHERE category = 'news' AND is_published = 1
             ORDER BY published_at DESC LIMIT 20"
        );

        $this->render('guides/news', [
            'title'   => 'Forex Market News | Trader Gulf',
            'metaDesc'=> 'Latest forex market news, analysis, and updates from around the globe.',
            'news'    => $news,
        ]);
    }

    public function showNews(Request $request, string $slug): void
    {
        $article = $this->db()->fetch(
            "SELECT * FROM articles WHERE slug = ? AND category = 'news' AND is_published = 1",
            [$slug]
        );

        if (!$article) $this->notFound();

        $related = $this->db()->fetchAll(
            "SELECT slug, title, excerpt, published_at FROM articles
             WHERE category = 'news' AND is_published = 1 AND slug != ?
             ORDER BY published_at DESC LIMIT 3",
            [$slug]
        );

        $this->render('guides/show', [
            'title'   => ($article['meta_title'] ?? $article['title']) . ' | Trader Gulf',
            'metaDesc'=> $article['meta_description'] ?? $article['excerpt'] ?? '',
            'guide'   => $article,
            'related' => $related,
        ]);
    }
}
