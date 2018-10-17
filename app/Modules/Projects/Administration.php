<?php

namespace App\Modules\Projects;

use App\Modules\Projects\Http\Controllers\Admin\ProjectsController;
use App\Modules\Projects\Models\Projects;
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
            $menu->addItem('Add', [
                'url'=> \Administration::route('projects.create'),
                'icon' => 'plus'
            ]);
            $menu->addItem('View all', [
                'url'=> \Administration::route('projects.index'),
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
        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('projects::admin.dash_projects_linkbox_title'));
        $box->setValue(Projects::count());
        $box->setBoxBackgroundClass('bg-purple');
        $box->setIconClass('fa-file-o');
        $box->setLink(trans('projects::admin.dash_projects_linkbox'), \Administration::route('projects.index'));
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