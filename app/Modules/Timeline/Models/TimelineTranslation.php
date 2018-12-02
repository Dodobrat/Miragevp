<?php

namespace App\Modules\Timeline\Models;

use ProVision\Administration\AdminModelTranslations;
use ProVision\Administration\Traits\RevisionableTrait;

class TimelineTranslation extends AdminModelTranslations
{
    use RevisionableTrait;

    protected $table = 'timeline_translations';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'message',
    ];
}
