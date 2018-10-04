<?php

namespace App\Modules\Contacts\Models;

use ProVision\Administration\AdminModelTranslations;
use ProVision\Administration\Traits\RevisionableTrait;

class ContactsTranslation extends AdminModelTranslations
{
    use RevisionableTrait;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'email',
        'address',
        'phone'
    ];
}
