<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //  Backend
        if ($request->is('backend/*')) {
            App::setLocale('en');
            return $next($request);
        }

        // Frontend locale
        $locale = Cookie::get('locale', Session::get('locale', config('app.locale')));

        if (! in_array($locale, ['en', 'mk', 'al'])) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
