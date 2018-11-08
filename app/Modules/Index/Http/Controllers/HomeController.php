<?php

namespace App\Modules\Index\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contacts\Models\Contacts;
use App\Modules\Floors\Models\Floors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use ProVision\Administration\Facades\Administration;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $contacts_cache = Cache::remember('contacts_cache' . Administration::getLanguage(), env('CACHE_DEFAULT', 360), function () {
            return Contacts::get();
        });

        View::share('contacts_cache', $contacts_cache);

        $floor_plan = Floors::reversed()->get();
        View::share('floor_plan', $floor_plan);


        $agent = new Agent();
        View::share('agent', $agent);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
