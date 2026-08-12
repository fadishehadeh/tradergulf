<?php
declare(strict_types=1);

namespace App\Modules\Admin\Glossary;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminGlossaryController extends AdminBaseController
{
    public function index(Request $request): void
    {
        $this->requireAuth();

        $terms = $this->db()->fetchAll(
            'SELECT id, term, slug FROM glossary ORDER BY term ASC'
        );

        $this->render('admin/glossary/index', [
            'pageTitle' => 'Glossary',
            'terms'     => $terms,
        ]);
    }

    public function create(Request $request): void
    {
        $this->requireAuth();

        $this->render('admin/glossary/form', [
            'pageTitle' => 'New Term',
            'term'      => [],
            'action'    => url('admin/glossary/create'),
        ]);
    }

    public function store(Request $request): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $data = $this->sanitize($_POST);

        $this->db()->execute(
            'INSERT INTO glossary (term, slug, letter, definition_html) VALUES (?,?,?,?)',
            [$data['term'], $data['slug'], $data['letter'], $data['definition_html']]
        );

        session()->flash('success', "Term \"{$data['term']}\" added.");
        Response::redirect('/admin/glossary');
    }

    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();

        $term = $this->db()->fetch('SELECT * FROM glossary WHERE id = ?', [(int) $id]);
        if (!$term) $this->notFound();

        $this->render('admin/glossary/form', [
            'pageTitle' => 'Edit Term',
            'term'      => $term,
            'action'    => url("admin/glossary/{$id}/edit"),
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $data = $this->sanitize($_POST);

        $this->db()->execute(
            'UPDATE glossary SET term=?, slug=?, letter=?, definition_html=? WHERE id=?',
            [$data['term'], $data['slug'], $data['letter'], $data['definition_html'], (int) $id]
        );

        session()->flash('success', "Term \"{$data['term']}\" updated.");
        Response::redirect('/admin/glossary');
    }

    public function destroy(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $term = $this->db()->fetch('SELECT term FROM glossary WHERE id = ?', [(int) $id]);
        if (!$term) $this->notFound();

        $this->db()->execute('DELETE FROM glossary WHERE id = ?', [(int) $id]);

        session()->flash('success', "Term \"{$term['term']}\" deleted.");
        Response::redirect('/admin/glossary');
    }

    private function sanitize(array $post): array
    {
        $termName = trim($post['term'] ?? '');
        $slug     = trim($post['slug'] ?? '');
        if ($slug === '') {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $termName));
            $slug = trim($slug, '-');
        }

        $letter = strtoupper(substr(ltrim($termName, '#0-9'), 0, 1) ?: '#');

        return [
            'term'            => $termName,
            'slug'            => $slug,
            'letter'          => $letter,
            'definition_html' => trim($post['definition_html'] ?? ''),
        ];
    }
}
