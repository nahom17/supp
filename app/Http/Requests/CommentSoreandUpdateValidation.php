<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentSoreandUpdateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =
            [
                'content' => [
                    'required',
                    'string'
                ]
            ];
        return $rules;
    }
    public function messages()
    {
        return [

            'content.required' => "Het beschrijving is verplicht ",
        ];
    }
}
