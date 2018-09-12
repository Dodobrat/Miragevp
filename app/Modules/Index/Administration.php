<?php

namespace App\Modules\Index;

use App\Modules\Index\Http\Controllers\IndexController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;
use ProVision\Administration\Facades\Settings;

//use ProVision\Administration\Settings;

//use ProVision\Administration\Models\Settings;


class Administration implements Module {

    public function routes($module) {
        \Route::resource('index', IndexController::class);
    }

    public function menu($module) {}


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

        $form->add($module['slug'].'_landing_image', 'file', [
            'label' => trans($module['slug'].'::admin.landing_image'),
            'path' => '/uploads/settings/'.$module['slug'].'_landing_image'
        ]);

    }
}