<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Contacts\Models\Contacts;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use ProVision\Administration\Facades\Administration;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $contacts_cache = Cache::remember('contacts_cache' . Administration::getLanguage(), env('CACHE_DEFAULT', 360), function () {
            return Contacts::get();
        });

        View::share('contacts_cache', $contacts_cache);


        $agent = new Agent();
        View::share('agent', $agent);
    }
}
