<?php

namespace App\Modules\Showroom\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ShowroomController extends Controller
{
    public function index() {
//        $apartments= Apartments::get();
        return view('showroom::showroom');

    }
}
