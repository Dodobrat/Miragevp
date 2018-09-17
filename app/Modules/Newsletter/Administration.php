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
        \Route::resource('newsletter_subscriber', NewsletterSubscribersController::class);
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
            'icon' => 'newspaper-o'
        ], function ($menu) {
            $menu->addItem('View all Subscribers', [
                'url' => \Administration::route('newsletter_subscriber.index'),
                'icon' => 'list'
            ]);
            $menu->addItem(trans('newsletter::admin.newsletter_view_emails'), [
                'icon' => 'arrow-right'
            ], function ($submenu)
            {
                $submenu->addItem('View all Emails', [
                    'url' => \Administration::route('newsletter_content.index'),
                    'icon' => 'list'
                ]);
                $submenu->addItem('Add Email', [
                    'url' => \Administration::route('newsletter_content.create'),
                    'icon' => 'plus'
                ]);
            });

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