<?php

namespace App\Modules\Projects\Http\Requests;

use App\Modules\Projects\Models\Projects;
use App\Modules\Projects\Models\ProjectsTranslation;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectsRequest extends FormRequest
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

            if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
                $locale_alb = ProjectsTranslation::where('projects_id', $this->route('projects'))->where('locale', $locale)->first();
                if($this->has($locale.'.title') && !empty($locale_alb)) {
                    $trans[$locale . '.slug'] = 'nullable|string|unique:projects_translations,slug,' . $locale_alb->id;
                }
            }else{
                $trans[$locale.'.slug'] = 'nullable|string|unique:projects_translations,slug';
            }
        }

        $trans['visible'] = 'boolean';
        $trans['show_media'] = 'boolean';

        return $trans;
    }
}
