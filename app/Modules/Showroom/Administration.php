<?php

namespace App\Modules\Showroom;

use App\Modules\Showroom\Http\Controllers\Admin\ShowroomController;
use App\Modules\Showroom\Models\Showroom;
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
        $box = new \ProVision\Administration\Dashboard\RecentListBox();
        $box->setTitle(trans('showroom::admin.dash_showrooms_linkbox_title'));
        $box->setBoxClass('col-lg-6 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setIconBoxBackgroundClass('bg-white');
        $showrooms = Showroom::take(5)->orderBy('id','desc')->get();

        foreach ($showrooms as $showroom) {
            $box->addItem($showroom->title . ' | ' . ' Attached pictures : ' . $showroom->media->count(), \Administration::route('showroom.edit', $showroom->id), substr(strip_tags($showroom->description), 0, 90), $showroom->updated_at);
        }
        $box->setFooterButton(trans('showroom::admin.dash_showroom_linkbox'), \Administration::route('showroom.index'));
        \Dashboard::add($box);
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
        $form->add($module['slug'] . '_page_title', 'text', [
            'label' => trans($module['slug'] . '::admin.page_title'),
            'translate' => true
        ]);

    }
}