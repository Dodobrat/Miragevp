<?php

namespace App\Modules\Contacts;

use App\Modules\Contacts\Http\Controllers\Admin\ContactsController;
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
        // TODO: Implement dashboard() method.
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
        \AdministrationMenu::addModule(trans('contacts::contacts.module_contacts'), [
            'icon' => 'envelope'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url'=> \Administration::route('contacts.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url'=> \Administration::route('contacts.create'),
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
    public function settings($module, \Kris\LaravelFormBuilder\Form $form)
    {
        // TODO: Implement settings() method.
    }
}