<?php

namespace App\Modules\Floors;

use App\Modules\Floors\Http\Controllers\Admin\FloorsController;
use App\Modules\Floors\Models\Floors;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('floors', FloorsController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('floors::admin.module_name'), [
            'icon' => 'building'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url'=> \Administration::route('floors.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url'=> \Administration::route('floors.create'),
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
        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('floors::admin.dash_floors_linkbox_title'));
        $box->setValue(Floors::count());
        $box->setBoxBackgroundClass('bg-orange');
        $box->setIconClass('fa fa-building');
        $box->setLink(trans('floors::admin.dash_floors_linkbox'), \Administration::route('floors.index'));
        \Dashboard::add($box);


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