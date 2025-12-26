<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;

class TestimonialsController extends Controller
{
    public function index()
    {
        $voices = Testimonials::latest()->paginate(10);

        return view('frontend.pages.voices', compact('voices'));
    }
}
