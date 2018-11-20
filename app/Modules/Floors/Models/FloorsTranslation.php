<?php

namespace App\Modules\Floors\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use ProVision\Administration\AdminModelTranslations;
use ProVision\Administration\Traits\RevisionableTrait;

class FloorsTranslation extends AdminModelTranslations
{
    use Sluggable, RevisionableTrait;

    protected $table = 'floors_translations';

    public $timestamps = false;

    protected $fillable = [
        'floor_num',
        'title',
        'description',
        'slug',
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
