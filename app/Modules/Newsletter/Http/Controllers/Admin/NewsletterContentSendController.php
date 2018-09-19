<?php

namespace App\Modules\Newsletter\Http\Controllers\Admin;

use App\Modules\Newsletter\Forms\NewsletterContentSendForm;
use App\Modules\Newsletter\Http\Requests\SendNewsletterContentRequest;
use App\Modules\Newsletter\Models\NewsletterContent;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
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

        //tuka vzimash id-to na teksta
        //izprashtash emaili na vsichki subscriberi
        // a kak da advam subscribers ot blade kak taka da gi advash kude
        //nali trqbva da si napishat emaila v blade za da mogat da se subsclrllaikbkknkakt i da po
        //qsno mi pravish si formichka vuv frontenda koqto choveka si pishe emaila pravish si pak edna fuknciq i storevash emaila v tablicata

    }
}
