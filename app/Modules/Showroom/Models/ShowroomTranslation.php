<?php

namespace App\Modules\Showroom\Models;

use ProVision\Administration\AdminModelTranslations;
use ProVision\Administration\Traits\RevisionableTrait;

class ShowroomTranslation extends AdminModelTranslations
{
    use RevisionableTrait;

    protected $table = 'showroom_translations';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
    ];
}
