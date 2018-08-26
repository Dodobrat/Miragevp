<?php

namespace App\Modules\Apartments;

use App\Modules\Apartments\Http\Controllers\Admin\ApartmentsController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('apartments', ApartmentsController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('apartments::admin.module_name'), [
            'icon' => 'building-o'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url'=> \Administration::route('apartments.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url'=> \Administration::route('apartments.create'),
                'icon' => 'plus'
            ]);
        });
    }


    /**
     * Init Dashboard boxes.
     *
     * @param $module
     *
     * @return mixed
     */
    public function dashboard($module) {
        // TODO: Implement dashboard() method.
    }

    /**
     * Add settings in administration panel
     *
     * @param      $module
     * @param Form $form
     *
     * @return mixed
     */
    public function settings($module, Form $form) {

        $form->add($module['slug'] . '_title', 'text', [
            'label' => trans($module['slug'] . '::admin.title'),
            'translate' => true
        ]);

    }
}