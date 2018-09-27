<?php

namespace App\Modules\Showroom;

use App\Modules\Showroom\Http\Controllers\Admin\ShowroomController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('showroom', ShowroomController::class);
    }

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
     * Init administration menu.
     *
     * @param $module
     * @return mixed
     */
    public function menu($module)
    {
        \AdministrationMenu::addModule(trans('showroom::admin.module_name'), [
            'icon' => 'picture-o'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url' => \Administration::route('showroom.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url' => \Administration::route('showroom.create'),
                'icon' => 'plus'
            ]);
        });
    }

    /**
     * Add settings in administration panel
     * @param $module
     * @param Form $form
     * @return mixed
     */
    public function settings($module, Form $form)
    {
        $form->add($module['slug'] . '_title', 'text', [
            'label' => trans($module['slug'] . '::admin.title'),
            'translate' => true
        ]);

    }
}