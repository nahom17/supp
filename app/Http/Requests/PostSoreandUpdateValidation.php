<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSoreandUpdateValidation extends FormRequest
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

            'content.required' => "Een inhoud is verplicht",
        ];
    }
}
