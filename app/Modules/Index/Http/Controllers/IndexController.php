<?php

namespace App\Modules\Index\Http\Controllers;

use App\Modules\Apartments\Models\Apartments;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {
//        $apartments= Apartments::get();
        return view('welcome');

    }
}
