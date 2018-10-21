<?php

namespace App\Modules\Index\Http\Controllers;

use App\Modules\Showroom\Models\Showroom;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {
        $showrooms= Showroom::reversed()->get();
        return view('welcome',compact('showrooms'));

    }
}
