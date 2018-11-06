<?php

namespace App\Modules\Floors\Http\Requests;

use App\Modules\Floors\Models\Floors;
use App\Modules\Floors\Models\FloorsTranslation;
use Illuminate\Foundation\Http\FormRequest;

class StoreFloorsRequest extends FormRequest
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
            $trans[$locale . '.floor_num'] = 'required|string';
            $trans[$locale . '.title'] = 'required|string';
            $trans[$locale . '.description'] = 'nullable|string';

            if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
                $locale_alb = FloorsTranslation::where('floor_id', $this->route('floors'))->where('locale', $locale)->first();
                if($this->has($locale.'.title') && !empty($locale_alb)) {
                    $trans[$locale . '.slug'] = 'nullable|string|unique:floors_translations,slug,' . $locale_alb->id;
                }
            }else{
                $trans[$locale.'.slug'] = 'nullable|string|unique:floors_translations,slug';
            }
        }

        $trans['project_id'] = 'required|integer';
        $trans['show_media'] = 'boolean';

        return $trans;
    }
}
