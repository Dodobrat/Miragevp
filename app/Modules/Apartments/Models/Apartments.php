<?php

namespace App\Modules\Apartments\Models;

use App\Modules\Floors\Models\Floors;
use App\Modules\Projects\Models\Projects;
use App\User;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class Apartments extends AdminModel
{
    use NodeTrait, MediaManagerTrait, ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'apartment_id';
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
    protected $table = 'apartments';
    /**
     * @var array
     */
    protected $fillable = [
        'show_media',
        'project_id',
        'floor_id',
        'user_id',
        'type',
        'position',
        'price'
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_media' => 'boolean'
    ];

    protected $with = ['translations'];

    public function project() {
        return $this->hasOne(Projects::class, 'id', 'project_id');
    }

    public function floor() {
        return $this->hasOne(Floors::class, 'id', 'floor_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('apartments.visible', 1);
    }

    public function header_media()
    {
        return $this->media('header');
    }
}
