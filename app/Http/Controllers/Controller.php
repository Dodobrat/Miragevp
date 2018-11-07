<?php

namespace App\Http\Controllers;

use App\Modules\Contacts\Models\Contacts;
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
        $contacts_cache = Cache::remember('contacts_cache' . Administration::getLanguage(), env('CACHE_DEFAULT', 360), function () {
            return Contacts::get();
        });

        View::share('contacts_cache', $contacts_cache);


        $agent = new Agent();
        View::share('agent', $agent);

        if (!\App::runningInConsole()) {
            \Breadcrumbs::register('floors_home', function ($breadcrumbs) {
                $breadcrumbs->push(trans('projects::front.vis-selection'), route('visual-selection'));
            });
        }

    }
}
