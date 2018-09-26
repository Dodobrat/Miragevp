<?php

namespace App\Modules\Floors\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FloorsController extends Controller
{
    public function index(){
        return view('floors::floors');
    }
}
