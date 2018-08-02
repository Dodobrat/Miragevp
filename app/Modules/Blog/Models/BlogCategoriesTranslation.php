<?php

namespace App\Modules\Blog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use ProVision\Administration\AdminModelTranslations;
use ProVision\Administration\Traits\RevisionableTrait;

class BlogCategoriesTranslation extends AdminModelTranslations
{
    use Sluggable, RevisionableTrait;

    protected $table = 'blog_categories_translations';

    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
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
