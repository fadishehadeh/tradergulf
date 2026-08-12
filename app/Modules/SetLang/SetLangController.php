<?php
declare(strict_types=1);

namespace App\Modules\SetLang;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class SetLangController extends Controller
{
    public function switch(Request $request, string $lang = 'en'): void
    {
        if (!in_array($lang, ['en', 'ar'], true)) $lang = 'en';

        session()->set('lang', $lang);

        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        $base    = rtrim(config('app.url', 'http://localhost'), '/');
        if (str_starts_with($referer, $base)) {
            $path = substr($referer, strlen($base)) ?: '/';
        } else {
            $path = '/';
        }

        Response::redirect($path);
    }
}
