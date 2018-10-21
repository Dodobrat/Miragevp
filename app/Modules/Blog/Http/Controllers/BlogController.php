<?php

namespace App\Modules\Blog\Http\Controllers;


use App\Modules\Blog\Models\Blog;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index() {
        $blog = Blog::reversed()->with(['thumbnail_media','header_media'])->paginate(12);
        return view('blog::blog',compact('blog'));
    }
}
