<?php

namespace App\Http\Controllers\Frontend;

use App\Models\GalleryImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(){

        $images = GalleryImage::latest()->get();

        return view('frontend.pages.gallery', compact('images'));

    }
}
