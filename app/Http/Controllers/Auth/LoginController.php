<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Contacts\Models\Contacts;
use App\Modules\Floors\Models\Floors;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use Laravel\Socialite\Facades\Socialite;
use ProVision\Administration\Facades\Administration;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $contacts_cache = Cache::remember('contacts_cache' . Administration::getLanguage(), env('CACHE_DEFAULT', 360), function () {
            return Contacts::get();
        });

        View::share('contacts_cache', $contacts_cache);

        $floor_plan = Floors::reversed()->get();
        View::share('floor_plan', $floor_plan);

        $agent = new Agent();
        View::share('agent', $agent);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param $service
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param $service
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($service)
    {
        $user = Socialite::driver($service)->user();
        $name = explode(' ', $user->getName());

        $socialUser = User::firstOrCreate(
        [
            'first_name' => $name[0],
            'last_name' => $name[1],
            'provider' => $service,
            'email' => $user->getEmail()
        ]);
        // $user->token;
        $socialUser->save();
        Auth::login($socialUser, true);
        return redirect('home');
    }
}
