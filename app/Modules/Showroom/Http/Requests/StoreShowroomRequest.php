<?php

namespace App\Modules\Showroom\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShowroomRequest extends FormRequest
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
            $trans[$locale . '.description'] = 'nullable|string';
        }

        $trans['show_media'] = 'boolean';

        return $trans;
    }
}
