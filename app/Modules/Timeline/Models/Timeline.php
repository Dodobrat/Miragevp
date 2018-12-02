<?php

namespace App\Modules\Timeline\Models;

use Dimsav\Translatable\Translatable;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\Administration\Traits\RevisionableTrait;

class Timeline extends AdminModel
{
    use ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'timeline_id';
    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'message',
    ];
    protected $table = 'timeline';
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    protected $with = ['translations'];
}
