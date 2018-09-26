<?php

namespace App\Modules\Contacts\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        return view('contacts::contact');
    }
}
