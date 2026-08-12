<?php
declare(strict_types=1);

namespace App\Modules\Admin\Articles;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminArticleController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $articles = $this->db()->fetchAll(
            'SELECT id, title, category, is_published, published_at FROM articles ORDER BY id DESC'
        );

        $this->render('admin/articles/index', [
            'pageTitle' => 'Articles',
            'articles'  => $articles,
        ]);
    }

    public function create(Request $request): void
    {
        $this->requireAuth();

        $this->render('admin/articles/form', [
            'pageTitle' => 'New Article',
            'article'   => [],
            'action'    => url('admin/articles/create'),
        ]);
    }

    public function store(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $data = $this->sanitize($_POST);

        $this->db()->execute(
            'INSERT INTO articles (category, title, slug, excerpt, content_html, meta_title,
             meta_description, is_published, published_at)
             VALUES (?,?,?,?,?,?,?,?,?)',
            [
                $data['category'], $data['title'], $data['slug'], $data['excerpt'],
                $data['content_html'], $data['meta_title'], $data['meta_description'],
                $data['is_published'], $data['published_at'],
            ]
        );

        session()->flash('success', "Article \"{$data['title']}\" created.");
        Response::redirect('/admin/articles');
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();

        $article = $this->db()->fetch('SELECT * FROM articles WHERE id = ?', [(int) $id]);
        if (!$article) $this->notFound();

        $this->render('admin/articles/form', [
            'pageTitle' => 'Edit Article',
            'article'   => $article,
            'action'    => url("admin/articles/{$id}/edit"),
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $data = $this->sanitize($_POST);

        $this->db()->execute(
            'UPDATE articles SET category=?, title=?, slug=?, excerpt=?, content_html=?,
             meta_title=?, meta_description=?, is_published=?, published_at=? WHERE id=?',
            [
                $data['category'], $data['title'], $data['slug'], $data['excerpt'],
                $data['content_html'], $data['meta_title'], $data['meta_description'],
                $data['is_published'], $data['published_at'], (int) $id,
            ]
        );

        session()->flash('success', "Article \"{$data['title']}\" updated.");
        Response::redirect('/admin/articles');
    }

    public function destroy(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $article = $this->db()->fetch('SELECT title FROM articles WHERE id = ?', [(int) $id]);
        if (!$article) $this->notFound();

        $this->db()->execute('DELETE FROM articles WHERE id = ?', [(int) $id]);

        session()->flash('success', "Article \"{$article['title']}\" deleted.");
        Response::redirect('/admin/articles');
    }

    private function sanitize(array $post): array
    {
        $title = trim($post['title'] ?? '');
        $slug  = trim($post['slug'] ?? '');
        if ($slug === '') {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $title));
            $slug = trim($slug, '-');
        }

        $isPublished = isset($post['is_published']) ? 1 : 0;
        $publishedAt = $post['published_at'] ?? '';
        if ($publishedAt === '' && $isPublished) {
            $publishedAt = date('Y-m-d H:i:s');
        }

        return [
            'category'         => in_array($post['category'] ?? '', ['guide', 'news']) ? $post['category'] : 'guide',
            'title'            => $title,
            'slug'             => $slug,
            'excerpt'          => trim($post['excerpt'] ?? ''),
            'content_html'     => $post['content_html'] ?? '',
            'meta_title'       => trim($post['meta_title'] ?? ''),
            'meta_description' => trim($post['meta_description'] ?? ''),
            'is_published'     => $isPublished,
            'published_at'     => $publishedAt ?: null,
        ];
    }
}
