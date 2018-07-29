<?php

namespace App\Modules\Users;

use App\Modules\Users\Http\Controllers\Admin\UsersController;
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
        \Route::resource('users', UsersController::class);
    }

    /**
     * Init administration menu.
     *
     * @param $module
     * @return mixed
     */
    public function menu($module)
    {
        \AdministrationMenu::addModule(trans('users::admin.module_name'), [
            'icon' => 'users'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url'=> \Administration::route('users.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url'=> \Administration::route('users.create'),
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