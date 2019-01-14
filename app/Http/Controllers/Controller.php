<?php

namespace App\Http\Controllers;

use App\Modules\Contacts\Models\Contacts;
use App\Modules\Floors\Models\Floors;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use ProVision\Administration\Facades\Administration;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $floor_plan = Floors::reversed()->get();
        View::share('floor_plan', $floor_plan);

        $agent = new Agent();
        View::share('agent', $agent);

        if (!\App::runningInConsole()) {
            \Breadcrumbs::register('floors_home', function ($breadcrumbs) {
                $breadcrumbs->push(trans('projects::front.vis-selection'), route('visual-selection'));
            });
        }

    }
}
