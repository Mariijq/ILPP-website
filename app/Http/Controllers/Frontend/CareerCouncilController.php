<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CareerCouncil;
use App\Models\CouncilMember;

class CareerCouncilController extends Controller
{
    public function index()
    {

        $careerCouncil = CareerCouncil::first();
        $members = CouncilMember::all();

        return view('frontend.pages.career-council', compact('careerCouncil','members'));
    }
}

