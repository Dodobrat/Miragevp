<?php

namespace App\Modules\Index;

use App\Modules\Index\Http\Controllers\IndexController;
use App\Modules\Projects\Models\Projects;
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
        $box = new \ProVision\Administration\Dashboard\HtmlBox();
        $box->setBoxClass('col-lg-12 col-md-12 col-sm-12 col-xs-12'); //set boostrap column class
        $box->setHtml('

');
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

        $form->add($module['slug'].'_logo', 'file', [
            'label' => trans($module['slug'].'::admin.logo'),
            'path' => '/uploads/settings/'.$module['slug'].'_logo'
        ]);

        $form->add($module['slug'].'_landing_image', 'file', [
            'label' => trans($module['slug'].'::admin.landing_image'),
            'path' => '/uploads/settings/'.$module['slug'].'_landing_image'
        ]);

    }
}