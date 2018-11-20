<?php

namespace App\Modules\Notifications\Models;

use ProVision\Administration\AdminModelTranslations;
use ProVision\Administration\Traits\RevisionableTrait;

class NotificationsTranslation extends AdminModelTranslations
{
    use RevisionableTrait;

    protected $table = 'notifications_translations';

    public $timestamps = false;

    protected $fillable = [
        'message',
    ];
}
