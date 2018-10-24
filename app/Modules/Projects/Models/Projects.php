<?php

namespace App\Modules\Projects\Models;

use App\Modules\Apartments\Models\Apartments;
use App\Modules\Floors\Models\Floors;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class Projects extends AdminModel
{
    use NodeTrait, MediaManagerTrait, ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'projects_id';
    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'slug',
    ];
    protected $table = 'projects';
    /**
     * @var array
     */
    protected $fillable = [
        'visible',
        'show_media'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
        'show_media' => 'boolean',
    ];

    protected $with = ['translations'];

    public function floors()
    {
        $this->hasMany(Floors::class, 'project_id', 'id');
    }

    public function apartments()
    {
        $this->hasMany(Apartments::class, 'project_id', 'id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('projects.visible', 1);
    }

    public function layer_one_media()
    {
        return $this->media('layer_one');
    }

    public function layer_two_media()
    {
        return $this->media('layer_two');
    }

    public function layer_three_media()
    {
        return $this->media('layer_three');
    }
}
