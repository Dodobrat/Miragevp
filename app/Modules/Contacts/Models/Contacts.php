<?php

namespace App\Modules\Contacts\Models;

use Dimsav\Translatable\Translatable;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class Contacts extends AdminModel
{
    use MediaManagerTrait, ValidationTrait, Translatable;

    public $translatedAttributes = [
        'title',
        'description',
        'email',
        'address',
        'phone',
    ];
    public $module = 'contacts';

    protected $fillable = [
        'lat',
        'long',
    ];


    protected $with = ['translations'];
}
