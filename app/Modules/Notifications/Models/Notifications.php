<?php

namespace App\Modules\Notifications\Models;

use Dimsav\Translatable\Translatable;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;

class Notifications extends AdminModel
{
    use ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'notification_id';
    /**
     * @var array
     */
    public $translatedAttributes = [
        'message',
    ];
    protected $table = 'notifications';
    /**
     * @var array
     */
    protected $fillable = [];

    protected $with = ['translations'];
}
