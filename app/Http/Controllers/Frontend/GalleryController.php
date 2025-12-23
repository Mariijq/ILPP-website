<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {

        $images = GalleryImage::latest()->get(); // fetch all images

        return view('frontend.pages.sections.gallery', compact('images'));

    }
}
