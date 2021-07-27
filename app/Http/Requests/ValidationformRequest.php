<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationformRequest extends FormRequest
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
            //
            'name'  => 'required|min:1|max:30',
            'email' => 'required|email|unique:users,email',

            
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => 'Es obligatorio que coloques el nombre',
            'name.min'        => 'El :attribute debe contener mas de una letra.',
            'name.max'        => 'El :attribute debe contener max 30 letras.',

            'email.required'    => 'El correo es un campo obligatorio',
            'email.unique'    => 'Este correo ya esta registrado',
        ];
    }


    public function attributes()
    {
        return [
        ];
    }
}
