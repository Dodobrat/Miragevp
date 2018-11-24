<?php

namespace App\Modules\Index\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Apartments\Models\Apartments;
use App\Modules\Notifications\Models\Notifications;
use App\Modules\Contacts\Models\Contacts;
use App\Modules\Floors\Models\Floors;
use App\Notifications\ApartmentReserved;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use ProVision\Administration\Facades\Administration;

class HomeController extends Controller
{

    use Notifiable;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
        $user_apartments = Apartments::where('user_id', '=', $current_user->id)->get();
        $user_notifications = Notifications::where('user_id', '=', $current_user->id)->get();
        $all_notifications = Notifications::where('all_users', '=', true)->get();

        return view('home',compact('current_user','user_apartments', 'user_notifications', 'all_notifications'));
    }

    public function markUserNotificationsAsRead(){

        $current_user = Auth::user();
        $user_notifications = Notifications::where('user_id', '=', $current_user->id);
        $user_notifications->update(array('read' => true));

        return redirect()->back();
    }
    public function markAllNotificationsAsRead(){

        $all_notifications = Notifications::where('all_users', '=', true);
        $all_notifications->update(array('read' => true));

        return redirect()->back();
    }
}
