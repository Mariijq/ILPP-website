<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Testimonials;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $testimonials = Testimonials::latest()->take(6)->get();
    return view('frontend.pages.home', compact('testimonials'));
}


}
