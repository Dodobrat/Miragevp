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
//        $box = new \ProVision\Administration\Dashboard\InfoBox();
//        $box->setTitle(trans('contacts::admin.dash_contacts_linkbox_title'));
//        $box->setBoxClass('col-lg-12 col-md-12 col-sm-12 col-xs-12'); //set boostrap column class
//        $box->setValue(Contacts::count());
//        $box->setIconBoxBackgroundClass('bg-blue');
//        $box->setIconClass('fa-envelope');
//        \Dashboard::add($box);

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
            $menu->addItem('Add', [
                'url' => \Administration::route('contacts.create'),
                'icon' => 'plus'
            ]);
            $menu->addItem('View all', [
                'url' => \Administration::route('contacts.index'),
                'icon' => 'list'
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
        $form->add($module['slug'] . '_page_title', 'text', [
            'label' => trans($module['slug'] . '::admin.page_title'),
            'translate' => true
        ]);
    }
}