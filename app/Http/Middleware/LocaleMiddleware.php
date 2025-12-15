<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Cookie::get('locale', Session::get('locale', config('app.locale')));

        App::setLocale($locale);
        Session::put('locale', $locale); // optional: keep session in sync

        return $next($request);
    }
}
