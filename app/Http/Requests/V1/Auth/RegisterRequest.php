<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name"              => 'required|string',
            "email"             => 'required|email|unique:users',
            "phone"             => 'required|nullable|integer',
            "address"           => 'required|string|nullable',
            "birthday"          => 'required|string|min:10|max:10|before:today',
            "password"          => 'required|string|min:10| regex:/[a-z]/ | regex:/[A-Z]/ | regex:/[0-9]/ | regex:/[@$!%*#?&]/',
            "password_confirm"  => 'required|same:password'
        ];
    }
}
