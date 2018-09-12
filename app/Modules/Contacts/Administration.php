<?php

namespace App\Modules\Contacts;

use App\Modules\Apartments\Models\Apartments;
use App\Modules\Blog\Models\Blog;
use App\Modules\Blog\Models\BlogTranslation;
use App\Modules\Contacts\Http\Controllers\Admin\ContactsController;
use App\Modules\Contacts\Models\Contacts;
use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;
use App\User;
use Illuminate\Support\Facades\Auth;
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
        $box = new \ProVision\Administration\Dashboard\HtmlBox();
        $box->setBoxClass('col-lg-12 col-md-12 col-sm-12 col-xs-12'); //set boostrap column class
        $box->setHtml('
<style>
.welcome {float: right;padding: 0px 10px 25px 0px;margin-top: -44px;}
.date{display: inline;font-size: 18px;padding-right: 10px;color: #777777;}
.time{display: inline;font-weight: 600;font-size: 23px;color: #444444;}
@media (max-width: 1200px) {.welcome{
float: left;
text-align: center;
padding: 40px 0px 20px 15px;
}}
</style>            
<div class="welcome">
    <div class="datetime">        
        <div class="date"></div>
        <div class="time"></div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script >
$(function() {App.init();});
var App = {	init: function() {this.datetime(), setInterval("App.datetime();", 1e3)},datetime: function() {var e = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"),t = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"),a = new Date,i = a.getYear();1e3 > i && (i += 1900);var s = a.getDay(),n = a.getMonth(),r = a.getDate();10 > r && (r = "0" + r);var l = a.getHours(),c = a.getMinutes(),h = a.getSeconds(),o = "AM";l >= 12 && (o = "PM"), l > 12 && (l -= 12), 0 == l && (l = 12), 9 >= c && (c = "0" + c), 9 >= h && (h = "0" + h), $(".welcome .datetime .day").text(e[s]), $(".welcome .datetime .time").text(l + ":" + c + ":" + h + " " + o), $(".welcome .datetime .date").text(t[n] + " " + r + ", " + i)}};
</script>
');
        \Dashboard::add($box);


        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('users::admin.dash_users_linkbox_title'));
        $box->setValue(User::whereDoesntHave('roles')->count());
        $box->setBoxBackgroundClass('bg-aqua');
        $box->setIconClass('fa-users');
        $box->setLink(trans('users::admin.dash_users_linkbox'), \Administration::route('users.index'));
        \Dashboard::add($box);


        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('projects::admin.dash_projects_linkbox_title'));
        $box->setValue(Projects::count());
        $box->setBoxBackgroundClass('bg-purple');
        $box->setIconClass('fa-file-o');
        $box->setLink(trans('projects::admin.dash_projects_linkbox'), \Administration::route('projects.index'));
        \Dashboard::add($box);


        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('floors::admin.dash_floors_linkbox_title'));
        $box->setValue(Floors::count());
        $box->setBoxBackgroundClass('bg-orange');
        $box->setIconClass('fa fa-building');
        $box->setLink(trans('floors::admin.dash_floors_linkbox'), \Administration::route('floors.index'));
        \Dashboard::add($box);

        $box = new \ProVision\Administration\Dashboard\LinkBox();
        $box->setBoxClass('col-lg-3 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setTitle(trans('apartments::admin.dash_apartments_linkbox_title'));
        $box->setValue(Apartments::count());
        $box->setBoxBackgroundClass('bg-green');
        $box->setIconClass('fa fa-building-o');
        $box->setLink(trans('apartments::admin.dash_apartments_linkbox'), \Administration::route('apartments.index'));
        \Dashboard::add($box);

        $box = new \ProVision\Administration\Dashboard\RecentListBox();
        $box->setTitle(trans('blog::admin.dash_blog_linkbox_title'));
        $box->setBoxClass('col-lg-6 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setIconBoxBackgroundClass('bg-white');
        $articles = Blog::take(5)->orderBy('id','desc')->get();

        foreach ($articles as $article) {
            $box->addItem($article->title . ' | '. $article->category->title, \Administration::route('blog.edit', $article->id), substr(strip_tags($article->description), 0, 100), $article->updated_at);
        }
        $box->setFooterButton(trans('blog::admin.dash_blog_linkbox'), \Administration::route('blog.index'));
        \Dashboard::add($box);

        $box = new \ProVision\Administration\Dashboard\RecentListBox();
        $box->setTitle(trans('contacts::contacts.dash_contacts_linkbox_title'));
        $box->setBoxClass('col-lg-6 col-md-6 col-sm-6 col-xs-12'); //set boostrap column class
        $box->setIconBoxBackgroundClass('bg-white');
        $contacts = Contacts::take(5)->orderBy('id','desc')->get();

        foreach ($contacts as $contact) {
            $box->addItem($contact->email, \Administration::route('contacts.edit', $contact->id), substr(strip_tags($contact->mobile), 0, 20), $contact->updated_at);
        }
        $box->setFooterButton(trans('contacts::contacts.dash_contacts_linkbox'), \Administration::route('blog.index'));
        \Dashboard::add($box);

    }

    /**
     * Init administration routes.
     *
     * @param $module
     * @return mixed
     */
    public function routes($module)
    {
        \Route::resource('contacts', ContactsController::class);
    }

    /**
     * Init administration menu.
     *
     * @param $module
     * @return mixed
     */
    public function menu($module)
    {
        \AdministrationMenu::addModule(trans('contacts::contacts.module_contacts'), [
            'icon' => 'envelope'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url' => \Administration::route('contacts.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url' => \Administration::route('contacts.create'),
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