<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->query('lang', Session::get('locale', config('app.locale')));
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }
        Session::put('locale', $locale);
        App::setLocale($locale);
        view()->share('dir', $locale === 'ar' ? 'rtl' : 'ltr');
        return $next($request);
    }
}


