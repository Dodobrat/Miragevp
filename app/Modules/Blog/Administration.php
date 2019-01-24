<?php

namespace App\Modules\Blog;

use App\Modules\Blog\Http\Controllers\Admin\BlogController;
use App\Modules\Blog\Models\Blog;
use Kris\LaravelFormBuilder\Form;
use ProVision\Administration\Contracts\Module;

class Administration implements Module {

    public function routes($module) {
        \Route::resource('blog', BlogController::class);
    }

    public function menu($module) {

        \AdministrationMenu::addModule(trans('blog::admin.module_name'), [
            'icon' => 'rss'
        ], function ($menu) {
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
        $box = new \ProVision\Administration\Dashboard\RecentListBox();
        $box->setTitle(trans('blog::admin.dash_blog_linkbox_title'));
        $box->setBoxClass('col-lg-6 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setIconBoxBackgroundClass('bg-white');
        $articles = Blog::take(5)->orderBy('id','desc')->get();

        foreach ($articles as $article) {
            $box->addItem($article->title . ' | '. $article->author, \Administration::route('blog.edit', $article->id), substr(strip_tags($article->description), 0, 100), $article->updated_at);
        }
        $box->setFooterButton(trans('blog::admin.dash_blog_linkbox'), \Administration::route('blog.index'));
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
        $form->add($module['slug'] . '_page_title', 'text', [
            'label' => trans($module['slug'] . '::admin.page_title'),
            'translate' => true
        ]);
        $form->add($module['slug'] . '_page_description', 'editor', [
            'label' => trans($module['slug'] . '::admin.page_description'),
            'translate' => true
        ]);

    }
}