<?php

namespace App\Modules\Contacts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendRequestContact extends FormRequest
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
        $trans = [];

        $trans['names'] = 'required|string';
        $trans['email'] = 'required|email';
        $trans['phone'] = 'required|string';
        $trans['comment'] = 'required|string';
        $trans['contact_id'] = 'required|numeric';

        return $trans;
    }
}
