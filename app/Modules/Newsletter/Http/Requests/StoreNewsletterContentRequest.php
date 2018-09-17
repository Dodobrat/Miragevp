<?php

namespace App\Modules\Newsletter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterContentRequest extends FormRequest
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
            $trans[$locale . '.subject'] = 'required|string';
            $trans[$locale . '.content'] = 'required|string';
        }

        $trans['show_media'] = 'boolean';
        $trans['title'] = 'required|string';

        return $trans;

    }
}
