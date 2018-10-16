<?php

namespace App\Modules\Showroom\Models;

use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class Showroom extends AdminModel
{
    use NodeTrait, MediaManagerTrait, ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'showroom_id';

    public $translatedAttributes = [
        'title',
        'description',
    ];

    protected $table = 'showroom';

    protected $fillable = [
        'show_media',
    ];

    protected $casts = [
      'show_media' => 'boolean',
    ];

    protected $with = ['translations'];

}
