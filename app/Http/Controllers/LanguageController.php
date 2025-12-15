<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        $available = ['en', 'mk', 'al'];

        if (in_array($locale, $available)) {
            // Save in session
            Session::put('locale', $locale);

            // Set cookie for 24 hours (1440 minutes)
            Cookie::queue('locale', $locale, 1440);

            // Set app locale immediately
            App::setLocale($locale);
        }

        return redirect()->back();
    }
}
