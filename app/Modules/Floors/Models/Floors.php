<?php

namespace App\Modules\Floors\Models;

use App\Modules\Apartments\Models\Apartments;
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
        'floor_num',
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
        'project_id',
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

    public function apartments() {
        return $this->hasMany(Apartments::class, 'floor_id', 'id');
    }

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

    public function thumbnail_media()
    {
        return $this->media('thumbnails');
    }
    public function plan_media()
    {
        return $this->media('plans');
    }
}
