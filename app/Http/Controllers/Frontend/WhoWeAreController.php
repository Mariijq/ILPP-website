<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\History;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\WhatWeDo;
use App\Models\Document;

class WhoWeAreController extends Controller
{
    //
    public function about()
    {
        $about = AboutUs::get();

        return view('frontend.pages.about', compact('about'));
    }

    public function history()
    {
        $history = History::get();

        return view('frontend.pages.history', compact('history'));
    }

    public function whatWeDo()
    {
        $pillars = WhatWeDo::get();

        return view('frontend.pages.what-we-do', compact('pillars'));
    }

    public function team()
    {
        $members = TeamMember::all();

        return view('frontend.pages.our-team', compact('members'));
    }

    public function partners()
    {
        $partners = Partner::orderBy('order')->get(); // ordered by your `order` field

        return view('frontend.pages.partners', compact('partners'));
    }

    public function documents()
    {
        $documents = Document::latest()->get();

        return view('frontend.pages.documents', compact('documents'));
    }
}
