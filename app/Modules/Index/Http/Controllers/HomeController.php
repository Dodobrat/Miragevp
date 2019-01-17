<?php

namespace App\Modules\Index\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Apartments\Models\Apartments;
use App\Modules\Index\Http\Requests\editUserRequest;
use App\Modules\Notifications\Models\Notifications;
use App\Modules\Contacts\Models\Contacts;
use App\Modules\Floors\Models\Floors;
//use App\Notifications\ApartmentReserved;
use App\Modules\Timeline\Models\Timeline;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
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
        $user_apartments = Apartments::where('user_id', $current_user->id)->get();
        $user_notifications = Notifications::where('user_id', $current_user->id)->orderBy('read')->get();
        $all_notifications = Notifications::where('all_users', true)->orderBy('created_at','desc')->get();
        $timeline = Timeline::where('user_id', $current_user->id)->get();

        return view('home',compact('current_user','user_apartments', 'user_notifications', 'all_notifications','timeline'));
    }

    public function updateUser(editUserRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'nullable|max:50|min:2',
            'last_name' => 'nullable|max:50|min:2',
            'email' => 'nullable|unique:users|email',
            'mobile' => 'nullable|unique:users',
            'password' => 'nullable|confirmed',
            'password_confirmation' => 'nullable',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $current_user = Auth::user();
        $data = $request->validated();
        unset($data['password']);
        unset($data['password_confirmation']);
        unset($data['first_name']);
        unset($data['last_name']);
        unset($data['email']);
        unset($data['mobile']);

        $current_user->fill($data);

        if ($request->filled('password')) {
            $current_user->password = Hash::make($request->get('password'));
        }
        if ($request->filled('mobile')) {
            $current_user->mobile = $request->get('mobile');
        }
        if ($request->filled('first_name')) {
            $current_user->first_name = $request->get('first_name');
        }
        if ($request->filled('last_name')) {
            $current_user->last_name = $request->get('last_name');
        }
        if ($request->filled('email')) {
            $current_user->email = $request->get('email');
        }

        $current_user->save();

        return response()->json(['success'=>'Successfully updated']);
    }

    public function markUserNotificationsAsRead($id){
        $user_notifications = Notifications::where('user_id', Auth::id())->where('id', $id);
        $user_notifications->update(['read' => true]);

        return redirect()->back();
    }
    public function markAllNotificationsAsRead(){

        $all_notifications = Notifications::where('all_users', true);
        $all_notifications->update(['read' => true]);

        return redirect()->back();
    }
}
