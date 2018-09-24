<?php

namespace App\Modules\Projects\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index() {
        return view('projects::project');
    }
}
