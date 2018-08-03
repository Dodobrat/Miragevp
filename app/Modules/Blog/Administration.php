<?php

namespace App\Modules\Blog;

use App\Modules\Blog\Http\Controllers\Admin\BlogCategoriesController;
use App\Modules\Blog\Http\Controllers\Admin\BlogController;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;

class Administration implements Module {

    public function routes($module) {
        \Route::resource('blog', BlogController::class);
        \Route::resource('blog_categories', BlogCategoriesController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('blog::admin.module_name'), [
            'icon' => 'newspaper-o'
        ], function ($menu) {
            $menu->addItem(trans('blog::admin.blog_categories'), [
                'icon' => 'arrow-right'
            ], function ($submenu)
            {
                $submenu->addItem(trans('blog::admin.add'), [
                    'url' => \Administration::route('blog_categories.create'),
                    'icon' => 'plus'
                ]);
                $submenu->addItem(trans('blog::admin.list'), [
                    'url' => \Administration::route('blog_categories.index'),
                    'icon' => 'list'
                ]);
            });
            $menu->addItem(trans('blog::admin.add'), [
                'url' => \Administration::route('blog.create'),
                'icon' => 'plus'
            ]);
            $menu->addItem(trans('blog::admin.list'), [
                'url' => \Administration::route('blog.index'),
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