<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Publication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicationsController extends Controller
{
    public function index(){

        $publications = Publication::get();
        return view('frontend.pages.publications', compact('publications'));
    }

    public function show($id){

        $publications = Publication::findOrFail($id);
        return view('frontend.pages.publication-details', compact('publications'));
    }
}
