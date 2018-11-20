<?php

namespace App\Modules\Notifications;

use App\Modules\Notifications\Http\Controllers\Admin\NotificationsController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('notifications', NotificationsController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('notifications::admin.module_name'), [
            'icon' => 'bell'
        ], function ($menu) {
            $menu->addItem('Add', [
                'url'=> \Administration::route('notifications.create'),
                'icon' => 'plus'
            ]);
            $menu->addItem('View all', [
                'url'=> \Administration::route('notifications.index'),
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