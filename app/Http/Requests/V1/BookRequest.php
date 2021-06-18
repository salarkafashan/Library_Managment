<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            "author_id"     => 'sometimes|nullable|integer',
            "publisher_id"  => 'sometimes|nullable|integer',
            "category_id"   => 'required|integer',
            "age_id"        => 'required|integer',
            "shelf_id"      => 'sometimes|nullable|integer',
            "title"         => 'required|string|min:1',
            "description"   => 'required|string|min:30|max:300',
            "tags"          => 'sometimes|nullable|string',
            "pages"         => 'required|string|min:1',
            "stock"         => 'required|min:1',
            "Language"      => 'required|string',
            "weight"        => 'sometimes|nullable|min:1',
            "Dimensions"    => 'sometimes|nullable|min:3',
            "reward"        => 'sometimes|nullable|string',
            "release_date"  => 'sometimes|nullable|date',
            "cover_image"   => 'sometimes|nullable|string',
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'title.required' => 'Title is required!',
    //         'name.required' => 'Name is required!',
    //         'password.required' => 'Password is required!'
    //     ];
    // }
}
