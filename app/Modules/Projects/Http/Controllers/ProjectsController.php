<?php

namespace App\Modules\Projects\Http\Controllers;

use App\Modules\Apartments\Models\Apartments;
use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;

use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;

class ProjectsController extends Controller
{
    public function index() {
        $agent = new Agent();
        $projects = Projects::with(
            [
                'layer_one_media',
                'layer_two_media',
                'layer_three_media',
                'base_media',
                'floors' => function($q) {
                return $q->reversed();
                },
                'floors.plan_media',
                'floors.thumbnail_media',
                'floors.apartments' => function($q) {
                    return $q->where('user_id',null)->orderBy('price', 'asc');
                },

            ])->get();
        $apartments = Apartments::get();
        return view('projects::project',compact('projects','floors','apartments','agent'));
    }
}
