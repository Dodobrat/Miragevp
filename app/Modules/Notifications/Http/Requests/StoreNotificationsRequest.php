<?php

namespace App\Modules\Notifications\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationsRequest extends FormRequest
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
            $trans[$locale . '.message'] = 'required|string';
        }

        $trans['user_id'] = 'nullable|integer';
        $trans['all_users'] = 'boolean';

        return $trans;
    }
}
