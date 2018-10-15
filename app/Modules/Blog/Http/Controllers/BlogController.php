<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Blog\Models\BlogCategories;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index() {
        $blog_categories = BlogCategories::with('media')->get();
        return view('blog::blog',compact('blog_categories'));
    }
}
