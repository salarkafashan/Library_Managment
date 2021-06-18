<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class AgeRequest extends FormRequest
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
        if($this->method() !== 'POST')
        {
            return [
                "title"     => 'required|string|min:3',
                "range"     => 'required|string|min:2',
            ];
        }
        else{
            return [
                "title"     => 'required|unique:ages|string|min:3',
                "range"     => 'required|unique:ages|string|min:2',
            ];
        }
        
    }
}
