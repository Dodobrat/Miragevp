<?php

namespace App\Modules\Blog\Models;

use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use ProVision\Administration\AdminModel;
use ProVision\Administration\Traits\RevisionableTrait;
use ProVision\Administration\Traits\ValidationTrait;
use ProVision\MediaManager\Traits\MediaManagerTrait;

class BlogCategories extends AdminModel
{
    use NodeTrait, MediaManagerTrait, ValidationTrait, Translatable, RevisionableTrait;

    public $translationForeignKey = 'blog_category_id';
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
    protected $table = 'blog_categories';
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

    public function news()
    {
        $this->hasMany(Blog::class, 'category_id', 'id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('blog_categories.visible', 1);
    }
}
