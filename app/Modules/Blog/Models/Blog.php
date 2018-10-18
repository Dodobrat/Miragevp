<?php

namespace App\Modules\Blog\Models;

use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class Blog extends AdminModel
{
    use NodeTrait, MediaManagerTrait, ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'blog_id';
    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'author',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'slug',
    ];
    protected $table = 'blog';
    /**
     * @var array
     */
    protected $fillable = [
        'visible',
        'show_media',
        'date_made',
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

    /**
     * Scope a query to only include active users.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('blog.visible', 1);
    }

    public function thumbnail_media()
    {
        return $this->media('thumbnails');
    }

    public function header_media()
    {
        return $this->media('header');
    }
}
