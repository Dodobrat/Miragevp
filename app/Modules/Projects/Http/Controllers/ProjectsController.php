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
        $floors = Floors::get();
        return view('projects::project',compact('projects','floors'));
    }
}
