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

        $contacts = Contacts::withTranslation()->get();

        if (empty($contacts)) {
            return redirect()->back();
        }
        return view('contacts::contact', compact('contacts'));
    }

    public function store(SendRequestContact $request)
    {
        $requestData = $request->validated();
        $contact_id = $request->input('contact_id');

        $contactInfo = Contacts::whereHas('translations', function ($query) use ($contact_id) {
            $query->where('locale', Administration::getLanguage())
                ->where('contacts_id', $contact_id);
        })->first();

        if (empty($contactInfo)) {
            return redirect()->back();
        }

        Mail::send('contacts::emails.send_contacts', ['data' => $requestData], function ($m) use ($requestData, $contactInfo) {
            $m->subject(trans('contacts::front.mail_subject'));
            $m->to($contactInfo->email, $contactInfo->title);
        });

        return back()->with('status', trans('contacts::front.email-success'));

    }
}
