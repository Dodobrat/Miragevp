<?php

namespace App\Modules\Showroom\Http\Controllers;

use App\Modules\Showroom\Models\Showroom;

use App\Http\Controllers\Controller;

class ShowroomController extends Controller
{
    public function index() {
        $showrooms = Showroom::reversed()->with('media')->get();
        return view('showroom::showroom', compact('showrooms'));

    }
}
