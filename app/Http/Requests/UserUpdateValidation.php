<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateValidation extends FormRequest
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
        $rules = [

            'name' => [
                'required',
                'string',
                'unique:users,name,' . $this->route('user')->name . ',name',

            ],
            'image' => [
                'nullable',
                'image'
            ],

            'email' => [
                'string',
                'email',
                'unique:users,email,' . $this->route('user')->email . ',email',
            ],
            'password' => [
                'nullable',
                'string',
                'confirmed'
            ],
            'password_confirmation' => [
                'nullable',
                'string'
            ]
        ];
        return $rules;
    }

    public function messages()
    {
        return [


            'name.required' => "Het gebruikersnaam is verplicht",
            'name.unique' => "Het gebruikersnaam bestaat al kies andere naam",
            'image.image' => "Het formaat van het bestaand niet toegestaan kies andere bestand",
            'email.unique' => "Het email is al bestaat",
            'email.required' => "Het email is verplicht",
            'password.required' => "Het wachtwoord is verplicht",
            'password.confirmed' => "Het wachtwoord bevestiging komt niet overeen",

        ];
    }
}
