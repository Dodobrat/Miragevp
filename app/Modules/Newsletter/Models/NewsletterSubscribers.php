<?php

namespace App\Modules\Newsletter\Models;

use ProVision\Administration\AdminModel;

class NewsletterSubscribers extends AdminModel
{
    protected $table = 'newsletter_subscriber';

    protected $fillable = [
        'email','active','locale'
    ];
}
