<?php

namespace App\Modules\Users;

use App\Modules\Users\Http\Controllers\Admin\UsersController;
use App\User;
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
    }

    /**
     * Init administration routes.
     *
     * @param $module
     * @return mixed
     */
    public function routes($module)
    {
        \Route::resource('users', UsersController::class);
    }

    /**
     * Init administration menu.
     *
     * @param $module
     * @return mixed
     */
    public function menu($module)
    {
        \AdministrationMenu::addModule(trans('users::admin.module_name'), [
            'icon' => 'users'
        ], function ($menu) {
            $menu->addItem('View all', [
                'url'=> \Administration::route('users.index'),
                'icon' => 'list'
            ]);

            $menu->addItem('Add', [
                'url'=> \Administration::route('users.create'),
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