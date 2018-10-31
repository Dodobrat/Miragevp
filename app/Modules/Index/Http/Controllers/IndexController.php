<?php

namespace App\Modules\Index\Http\Controllers;

use App\Modules\Showroom\Models\Showroom;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

class IndexController extends Controller
{
    public function index() {
        $agent = new Agent();
        $showrooms= Showroom::reversed()->with('media')->get();
        return view('welcome',compact('showrooms','agent'));

    }
}
