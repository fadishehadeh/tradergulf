<?php
declare(strict_types=1);

namespace App\Modules\Admin\Reviews;

use App\Core\Request;
use App\Core\Response;
use App\Modules\Admin\AdminBaseController;

class AdminReviewController extends AdminBaseController
{
    public function edit(Request $request, string $id): void
    {
        $this->requireAuth();

        $broker = $this->db()->fetch('SELECT id, name, slug FROM brokers WHERE id = ?', [(int) $id]);
        if (!$broker) $this->notFound();

        $review = $this->db()->fetch(
            'SELECT * FROM broker_reviews WHERE broker_id = ?', [(int) $id]
        ) ?: [];

        if ($review) {
            $pros = json_decode($review['pros'] ?? '[]', true) ?: [];
            $cons = json_decode($review['cons'] ?? '[]', true) ?: [];
            $review['pros_text'] = implode("\n", $pros);
            $review['cons_text'] = implode("\n", $cons);
        }

        $this->render('admin/reviews/edit', [
            'pageTitle' => "Review: {$broker['name']}",
            'broker'    => $broker,
            'review'    => $review,
            'action'    => url("admin/brokers/{$id}/review"),
        ]);
    }

    public function update(Request $request, string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $broker = $this->db()->fetch('SELECT id FROM brokers WHERE id = ?', [(int) $id]);
        if (!$broker) $this->notFound();

        $pros = array_filter(array_map('trim', explode("\n", $_POST['pros_text'] ?? '')));
        $cons = array_filter(array_map('trim', explode("\n", $_POST['cons_text'] ?? '')));

        $fields = [
            'intro_html'         => $_POST['intro_html'] ?? '',
            'overview_html'      => $_POST['overview_html'] ?? '',
            'regulation_html'    => $_POST['regulation_html'] ?? '',
            'account_types_html' => $_POST['account_types_html'] ?? '',
            'platforms_html'     => $_POST['platforms_html'] ?? '',
            'spreads_html'       => $_POST['spreads_html'] ?? '',
            'deposits_html'      => $_POST['deposits_html'] ?? '',
            'support_html'       => $_POST['support_html'] ?? '',
            'verdict_html'       => $_POST['verdict_html'] ?? '',
            'pros'               => json_encode(array_values($pros)),
            'cons'               => json_encode(array_values($cons)),
            'meta_title'         => trim($_POST['meta_title'] ?? ''),
            'meta_description'   => trim($_POST['meta_description'] ?? ''),
            'last_updated'       => date('Y-m-d'),
        ];

        $existing = $this->db()->fetch(
            'SELECT id FROM broker_reviews WHERE broker_id = ?', [(int) $id]
        );

        if ($existing) {
            $sets   = implode(', ', array_map(fn($k) => "$k = ?", array_keys($fields)));
            $values = array_values($fields);
            $values[] = (int) $id;
            $this->db()->execute("UPDATE broker_reviews SET $sets WHERE broker_id = ?", $values);
        } else {
            $fields['broker_id'] = (int) $id;
            $cols = implode(', ', array_keys($fields));
            $phs  = implode(', ', array_fill(0, count($fields), '?'));
            $this->db()->execute(
                "INSERT INTO broker_reviews ($cols) VALUES ($phs)",
                array_values($fields)
            );
        }

        session()->flash('success', 'Review saved.');
        Response::redirect("/admin/brokers/{$id}/review");
    }
}
