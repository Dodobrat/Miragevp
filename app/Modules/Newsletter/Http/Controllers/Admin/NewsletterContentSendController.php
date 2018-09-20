<?php

namespace App\Modules\Newsletter\Http\Controllers\Admin;

use App\Mail\Newsletter;
use App\Modules\Newsletter\Forms\NewsletterContentSendForm;
use App\Modules\Newsletter\Http\Requests\SendNewsletterContentRequest;
use App\Modules\Newsletter\Models\NewsletterContent;
use App\Modules\Newsletter\Models\NewsletterSubscribers;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Kris\LaravelFormBuilder\FormBuilder;
use Form;
use ProVision\Administration\Facades\Administration;
use ProVision\Administration\Http\Controllers\BaseAdministrationController;

class NewsletterContentSendController extends BaseAdministrationController
{


    /**
     * Display the specified resource.
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function show(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(NewsletterContentSendForm::class, [
                'method' => 'POST',
                'url' => Administration::route('newsletter_content_send.send'),
                'role' => 'form',
                'id' => 'formID'
            ]
        );
        Administration::setTitle(trans('newsletter::admin.send'));

        Breadcrumbs::register('admin_final', function ($breadcrumbs) {
            $breadcrumbs->parent('admin_home');
            $breadcrumbs->push(trans('newsletter::admin.module_name'), Administration::route('newsletter_content.index'));
            $breadcrumbs->push(trans('newsletter::admin.send'), Administration::route('newsletter_content_send.send'));
        });

        return view('administration::empty-form', compact('form'));
    }

    public function send(SendNewsletterContentRequest $request)
    {
        $newsletter = NewsletterContent::where('id',$request->newsletter_id)->first();
        $subscribers = DB::table('newsletter_subscriber')->where('active', true)->get();

        foreach($subscribers as $subscriber){
            Mail::to($subscriber)->send(new Newsletter($newsletter));
        }

        return Redirect::route(Administration::routeName('newsletter_content.index'));
    }
}
