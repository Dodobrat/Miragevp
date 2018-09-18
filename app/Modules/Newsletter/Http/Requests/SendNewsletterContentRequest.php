<?php

namespace App\Modules\Newsletter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendNewsletterContentRequest extends FormRequest
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

        $trans['newsletter_id'] = 'required|integer';

        return $trans;
    }
}
