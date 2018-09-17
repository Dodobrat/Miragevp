<?php

namespace App\Modules\Newsletter\Models;

use ProVision\Administration\AdminModelTranslations;

class NewsletterContentTranslation extends AdminModelTranslations
{

    protected $table = 'newsletter_content_translations';

    public $timestamps = false;

    protected $fillable = [
        'subject',
        'content',
    ];

}