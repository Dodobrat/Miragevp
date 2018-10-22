<?php

namespace App\Modules\Projects\Http\Controllers;

use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Projects::with('media')->get();
        $floors = Floors::reversed()->with(['thumbnail_media','media','plan_media','apartments' => function($q) {
            return $q->where('user_id',null)->orderBy('price', 'asc');
        }])->get();
        return view('projects::project',compact('projects','floors'));
    }
}
