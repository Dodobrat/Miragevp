<?php

namespace App\Modules\Floors\Http\Controllers;

use App\Modules\Floors\Models\Floors;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FloorsController extends Controller
{
    public function index(){
        $floors = Floors::reversed()->get();
        return view('floors::floors',compact('floors'));
    }

//    public function view($slug){
//        return view('floors::view');
//    }
}
