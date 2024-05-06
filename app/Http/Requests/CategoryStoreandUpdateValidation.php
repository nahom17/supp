<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreandUpdateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('isAdmin', User::class);
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

            'name' => [
                'required',
                'string'

            ],
            'description' => [
                'required',
                'string',
            ]
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "Het naam is verplicht",
            'description.required' => "het beschrijving is verplicht",
        ];
    }
}
