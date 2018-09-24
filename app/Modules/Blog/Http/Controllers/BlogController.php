<?php

namespace App\Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index() {
        return view('blog::blog');
    }
}
