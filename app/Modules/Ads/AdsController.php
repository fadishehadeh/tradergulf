<?php
declare(strict_types=1);

namespace App\Modules\Ads;

use App\Core\Controller;
use App\Core\Request;

class AdsController extends Controller
{
    public function click(Request $request, string $id): void
    {
        $ad = $this->db()->fetch(
            'SELECT click_url FROM ads WHERE id = ? AND is_active = 1',
            [(int) $id]
        );

        if ($ad) {
            $this->db()->execute(
                'UPDATE ads SET clicks = clicks + 1 WHERE id = ?',
                [(int) $id]
            );
            header('Location: ' . $ad['click_url'], true, 302);
        } else {
            header('Location: ' . url(), true, 302);
        }
        exit;
    }
}
