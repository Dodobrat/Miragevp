<?php

namespace App\Modules\Timeline;

use App\Modules\Timeline\Http\Controllers\Admin\TimelineController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('timeline', TimelineController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('timeline::admin.module_name'), [
            'icon' => 'list-alt'
        ], function ($menu) {
            $menu->addItem('Add', [
                'url'=> \Administration::route('timeline.create'),
                'icon' => 'plus'
            ]);
            $menu->addItem('View all', [
                'url'=> \Administration::route('timeline.index'),
                'icon' => 'list'
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

    }
}