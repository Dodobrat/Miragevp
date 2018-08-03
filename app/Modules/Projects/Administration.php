<?php

namespace App\Modules\Projects;

use App\Modules\Projects\Http\Controllers\Admin\ProjectsController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('projects', ProjectsController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('projects::admin.module_categories_name'), [
            'icon' => 'file-o'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url'=> \Administration::route('projects.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url'=> \Administration::route('projects.create'),
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