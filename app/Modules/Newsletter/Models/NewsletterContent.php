<?php

namespace App\Modules\Newsletter\Models;

use Dimsav\Translatable\Translatable;
use ProVision\Administration\AdminModel;

class NewsletterContent extends AdminModel
{

    use Translatable;
    public $translationForeignKey = 'newsletter_id';
    protected $table = 'newsletter_content';

    protected $fillable = [
        'title',
    ];

    public $translatedAttributes = [
        'subject',
        'content',
    ];

    protected $with = ['translations'];
}