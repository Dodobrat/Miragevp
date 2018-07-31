<?php

namespace App\Modules\Contacts\Models;

use ProVision\Administration\AdminModel;

class Contacts extends AdminModel
{
    protected $fillable = [
        'mobile','phone', 'email', 'address',
    ];
}
