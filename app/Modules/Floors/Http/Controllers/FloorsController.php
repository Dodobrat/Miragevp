<?php

namespace App\Modules\Floors\Http\Controllers;

use App\Modules\Floors\Models\Floors;
use App\Modules\Floors\Models\FloorsTranslation;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use ProVision\Administration\Facades\Settings;

class FloorsController extends Controller
{
//    public function index(){
//        $floors = Floors::reversed()->get();
//        return view('floors::floors',compact('floors'));
//    }

    public function show($slug){

        $floors = Floors::with('apartments')->reversed()->get();

        $current_floor =  Floors::whereHas('translations',
            function ($query) use ($slug) {
                $query->where('locale', \Administration::getLanguage())
                ->where('slug', $slug);})
            ->first();

        if (empty($current_floor)) {
            $exist = FloorsTranslation::where('slug', $slug)->first();
            if (!empty($exist)) {
                $current_floor = FloorsTranslation::where('floor_id', $exist->floor_id)->where('locale', \Administration::getLanguage())->first();
                return redirect(route('floor', ['slug' => $current_floor->slug]));
            } else {
                abort(404);
            }
        }

        Breadcrumbs::register('index', function ($breadcrumbs) use ($current_floor) {
            $breadcrumbs->parent('floors_home');
            $breadcrumbs->push(trans('floors::front.floor-plans'), route('floor', ['slug' => $current_floor->first()->slug]));
            $breadcrumbs->push(trans('floors::front.floor-indicator') . ' ' . $current_floor->floor_num, route('floor', ['slug' => $current_floor->slug]));
        });

        return view('floors::show', compact('current_floor','floors'));
    }
}
