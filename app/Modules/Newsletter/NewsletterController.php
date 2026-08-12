<?php
declare(strict_types=1);

namespace App\Modules\Newsletter;

use App\Core\Controller;
use App\Core\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): void
    {
        if ($request->method() !== 'POST') {
            http_response_code(405);
            echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
            exit;
        }

        $email  = trim($request->input('email', ''));
        $source = trim($request->input('source', 'footer'));
        $source = substr(preg_replace('/[^a-z0-9_\-]/', '', $source), 0, 80);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'error' => 'Invalid email address']);
            exit;
        }

        try {
            $this->db()->execute(
                'INSERT IGNORE INTO newsletter_subscribers (email, source) VALUES (?, ?)',
                [$email, $source]
            );
            header('Content-Type: application/json');
            echo json_encode(['ok' => true]);
        } catch (\Throwable $e) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['ok' => false, 'error' => 'Server error']);
        }
        exit;
    }
}
