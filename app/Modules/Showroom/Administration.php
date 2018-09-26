<?php

namespace App\Modules\Showroom;

use App\Modules\Showroom\Http\Controllers\ShowroomController;
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
        // TODO: Implement menu() method.
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

        $form->add($module['slug'].'_showroom_image_1', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_1'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_1'
        ]);
        $form->add($module['slug'] . '_desc_1', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_1'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_2', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_2'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_2'
        ]);
        $form->add($module['slug'] . '_desc_2', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_2'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_3', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_3'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_3'
        ]);
        $form->add($module['slug'] . '_desc_3', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_3'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_4', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_4'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_4'
        ]);
        $form->add($module['slug'] . '_desc_4', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_4'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_5', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_5'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_5'
        ]);
        $form->add($module['slug'] . '_desc_5', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_5'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_6', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_6'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_6'
        ]);
        $form->add($module['slug'] . '_desc_6', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_6'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_7', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_7'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_7'
        ]);
        $form->add($module['slug'] . '_desc_7', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_7'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_8', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_8'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_8'
        ]);
        $form->add($module['slug'] . '_desc_8', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_8'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_9', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_9'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_9'
        ]);
        $form->add($module['slug'] . '_desc_9', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_9'),
            'translate' => true
        ]);
        $form->add($module['slug'].'_showroom_image_10', 'file', [
            'label' => trans($module['slug'].'::admin.showroom_image_10'),
            'path' => '/uploads/settings/'.$module['slug'].'_showroom_image_10'
        ]);
        $form->add($module['slug'] . '_desc_10', 'text', [
            'label' => trans($module['slug'] . '::admin.desc_10'),
            'translate' => true
        ]);

    }
}