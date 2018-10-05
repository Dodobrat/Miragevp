<?php

namespace App\Modules\Contacts;

use App\Modules\Contacts\Http\Controllers\Admin\ContactsController;
use App\Modules\Contacts\Models\Contacts;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;

class Administration implements Module
{


    /**
     * Init Dashboard boxes.
     *
     * @param $module
     * @return mixed
     */
    public function dashboard($module)
    {
        $box = new \ProVision\Administration\Dashboard\RecentListBox();
        $box->setTitle(trans('contacts::admin.dash_contacts_linkbox_title'));
        $box->setBoxClass('col-lg-6 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setIconBoxBackgroundClass('bg-white');
        $contacts = Contacts::take(5)->orderBy('id','desc')->get();

        foreach ($contacts as $contact) {
            $box->addItem($contact->email, \Administration::route('contacts.edit', $contact->id), substr(strip_tags($contact->mobile), 0, 20), $contact->updated_at);
        }
        $box->setFooterButton(trans('contacts::admin.dash_contacts_linkbox'), \Administration::route('blog.index'));
        \Dashboard::add($box);
    }

    /**
     * Init administration routes.
     *
     * @param $module
     * @return mixed
     */
    public function routes($module)
    {
        \Route::resource('contacts', ContactsController::class);
    }

    /**
     * Init administration menu.
     *
     * @param $module
     * @return mixed
     */
    public function menu($module)
    {
        \AdministrationMenu::addModule(trans('contacts::admin.module_name'), [
            'icon' => 'envelope'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url' => \Administration::route('contacts.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url' => \Administration::route('contacts.create'),
                'icon' => 'plus'
            ]);
        });

    }

    /**
     * Add settings in administration panel
     * @param $module
     * @param \Kris\LaravelFormBuilder\Form $form
     * @return mixed
     */
    public function settings($module, Form $form)
    {
        $form->add($module['slug'] . '_title', 'text', [
            'label' => trans($module['slug'] . '::admin.title'),
            'translate' => true
        ]);
        $form->add($module['slug'] . '_lat', 'number', [
            'label' => trans($module['slug'] . '::admin.lat'),
        ]);
        $form->add($module['slug'] . '_long', 'number', [
            'label' => trans($module['slug'] . '::admin.long'),
        ]);
        $form->add($module['slug'] . '_zoom', 'number', [
            'label' => trans($module['slug'] . '::admin.zoom'),
        ]);
        $form->add($module['slug'] . '_pin_icon', 'file', [
            'label' => trans($module['slug'] . '::admin.pin-icon'),
        ]);

    }
}