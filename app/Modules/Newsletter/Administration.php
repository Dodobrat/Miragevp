<?php

namespace App\Modules\Newsletter;

use App\Modules\Newsletter\Http\Controllers\Admin\NewsletterContentController;
use App\Modules\Newsletter\Http\Controllers\Admin\NewsletterSubscribersController;

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

    }

    /**
     * Init administration routes.
     *
     * @param $module
     * @return mixed
     */
    public function routes($module)
    {
        \Route::resource('newsletter', NewsletterSubscribersController::class);
        \Route::resource('newsletter_content', NewsletterContentController::class);
    }

    /**
     * Init administration menu.
     *
     * @param $module
     * @return mixed
     */
    public function menu($module)
    {
        \AdministrationMenu::addModule(trans('newsletter::admin.module_name'), [
            'icon' => 'envelope'
        ], function ($menu) {
            $menu->addItem('View all Subscribers', [
                'url' => \Administration::route('newsletter.index'),
                'icon' => 'list'
            ]);
            $menu->addItem('View all Emails', [
                'url' => \Administration::route('newsletter_content.index'),
                'icon' => 'list'
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