<?php

namespace App\Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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

        return [
            'first_name' => 'required|max:50|min:2',
            'last_name' => 'required|max:50|min:2',
            'email' => 'required|unique:users,email,' . request()->route('user') . '|email',
            'password' => 'nullable|confirmed',
        ];
    }
}
