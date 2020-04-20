<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUp extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'country_id' => 'required|exists:countries,id',
            'password' => 'required',
            'startup_type_id' => 'required|exists:startup_types,id',
            'user_type_id' => 'required|exists:user_types,id'
        ];
    }
}
