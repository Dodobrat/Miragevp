<?php

namespace App\Modules\Blog\Http\Requests;

use App\Modules\Blog\Models\BlogCategoriesTranslation;
use App\Modules\Blog\Models\BlogTranslation;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locales = config('translatable.locales');

        $trans = [];

        foreach ($locales as $locale) {
            $trans[$locale . '.title'] = 'required|string';
            $trans[$locale . '.meta_title'] = 'nullable|string';
            $trans[$locale . '.meta_description'] = 'nullable|string';
            $trans[$locale . '.meta_keywords'] = 'nullable|string';
            $trans[$locale . '.description'] = 'nullable|string';

            if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
                $locale_alb = BlogCategoriesTranslation::where('blog_category_id', $this->route('blog_categories'))->where('locale', $locale)->first();
                if($this->has($locale.'.title') && !empty($locale_alb)) {
                    $trans[$locale . '.slug'] = 'nullable|string|unique:blog_categories_translations,slug,' . $locale_alb->id;
                }
            }else{
                $trans[$locale.'.slug'] = 'nullable|string|unique:blog_categories_translations,slug';
            }
        }

        $trans['visible'] = 'boolean';
        $trans['show_media'] = 'boolean';

        return $trans;
    }
}
