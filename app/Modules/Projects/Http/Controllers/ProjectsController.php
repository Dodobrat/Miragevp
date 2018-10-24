<?php

namespace App\Modules\Projects\Http\Controllers;

use App\Modules\Apartments\Models\Apartments;
use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Projects::with(['layer_one_media','layer_two_media','layer_three_media'])->get();
        $floors = Floors::reversed()->with(['thumbnail_media','media','plan_media','apartments' => function($q) {
            return $q->where('user_id',null)->orderBy('price', 'asc');
        }])->get();
        $apartments = Apartments::get();
        return view('projects::project',compact('projects','floors','apartments'));
    }
}
