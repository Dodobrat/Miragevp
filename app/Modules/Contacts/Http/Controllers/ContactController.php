<?php

namespace App\Modules\Contacts\Http\Controllers;

use App\Modules\Contacts\Http\Requests\SendRequestContact;
use App\Modules\Contacts\Models\Contacts;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use ProVision\Administration\Facades\Administration;
use ProVision\Administration\Facades\Settings;

class ContactController extends Controller
{
    public function index(){

        $contacts = Contacts::withTranslation()->with('contact_media')->get();

        if (empty($contacts)) {
            return redirect()->back();
        }
        return view('contacts::contact', compact('contacts'));
    }

    public function store(SendRequestContact $request)
    {
        $validator = \Validator::make($request->all(), [
            'names' => 'required|max:50|min:2',
            'email' => 'required|email',
            'phone' => 'required|min:5|max:14',
            'comment' => 'required|max:300',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $contact_id = $request->input('contact_id');

        $contactInfo = Contacts::whereHas('translations', function ($query) use ($contact_id) {
            $query->where('locale', Administration::getLanguage())
                ->where('contacts_id', $contact_id);
        })->first();

        Mail::send('contacts::emails.send_contacts', ['data' => $validator], function ($m) use ($validator, $contactInfo) {
            $m->subject(trans('contacts::front.mail_subject'));
            $m->to($contactInfo->email, $contactInfo->title);
        });

        return response()->json(['success'=>'E-mail successfully sent'], 200);
    }
}
