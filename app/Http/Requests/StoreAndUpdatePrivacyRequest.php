<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdatePrivacyRequest extends FormRequest
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

            'privacy_name' => [
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
            'privacy_name.required' => "Het privacy_naam is verplicht",
            'description.required' => "het beschrijving is verplicht",
        ];
    }
}
