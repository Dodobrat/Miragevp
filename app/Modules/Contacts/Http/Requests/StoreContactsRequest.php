<?php

namespace App\Modules\Contacts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactsRequest extends FormRequest
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
            $trans[$locale . '.email'] = 'required|email';
            $trans[$locale . '.address'] = 'required|string';
            $trans[$locale . '.phone'] = 'required|string';
        }

        $trans['map'] = 'nullable|array';
        $trans['show_map'] = 'boolean';

        return $trans;
    }
}
