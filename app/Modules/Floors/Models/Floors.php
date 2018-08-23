<?php

namespace App\Modules\Floors\Models;

use App\Modules\Projects\Models\Projects;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class Floors extends AdminModel
{
    use NodeTrait, MediaManagerTrait, ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'floor_id';
    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'description',
        'slug',
    ];
    protected $table = 'floors';
    /**
     * @var array
     */
    protected $fillable = [
        'show_media',
        'project_id'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_media' => 'boolean',
    ];

    protected $with = ['translations'];

    public function project() {
        return $this->hasOne(Projects::class, 'id', 'project_id');
    }


//    public function level()
//    {
//        return $this->hasOne(Projects::class, 'id', 'project_id');
//    }

    //тука трябва да се направи релацията

    /**
     * Scope a query to only include active users.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('floors.visible', 1);
    }

    public function header_media()
    {
        return $this->media('header');
    }
}
