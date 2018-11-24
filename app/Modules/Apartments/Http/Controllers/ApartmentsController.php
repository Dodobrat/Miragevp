<?php

namespace App\Modules\Apartments\Http\Controllers;

use App\Modules\Apartments\Models\Apartments;
use App\Modules\Apartments\Models\ApartmentsTranslation;
use App\Modules\Floors\Models\Floors;
use App\Modules\Floors\Models\FloorsTranslation;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ApartmentsController extends Controller
{
    public function index($slug){
        $apartments = Apartments::get();

        $selected_apartment =  Apartments::whereHas('translations',
            function ($query) use ($slug) {
                $query->where('locale', \Administration::getLanguage())
                    ->where('slug', $slug);})
            ->first();

        if (empty($selected_apartment)) {
            $exist = ApartmentsTranslation::where('slug', $slug)->first();
            if (!empty($exist)) {
                $selected_apartment = ApartmentsTranslation::where('apartment_id', $exist->apartment_id)->where('locale', \Administration::getLanguage())->first();
                return redirect(route('apartment', ['slug' => $selected_apartment->slug]));
            } else {
                abort(404);
            }
        }

        $similar = Apartments::where('id', '!=', $selected_apartment->id)->where('type', $selected_apartment->type)->where('position', $selected_apartment->position)->orderBy('id', 'desc')->take(5)->get();


        return view('apartments::index', compact('apartments','selected_apartment','similar'));
    }
}
