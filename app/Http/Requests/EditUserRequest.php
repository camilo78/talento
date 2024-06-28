<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => 'required',
            'department_id'=> 'required',
            'last_name' => 'required',
            'gender'=> 'required',
            'email' => 'required|email',
            'dni' => 'required|min:13|numeric',
            'functional' => 'nullable',
            'nominal' => 'nullable',
            'type' => 'required',
            'password' => 'min:8|nullable'
        ];

    }

    public function attributes(): array
{
    return
    [
        'name' => 'nombres',
        'last_name' => 'apellidos',
        'gender'=>'género',
        'email' => 'correo electrónico',
        'dni' => 'DNI',
        'department_id'=> 'departamento o unidad',
        'functional' => 'cargo funcional',
        'nominal' => 'cargo nominal',
        'type' => 'tipo de contratación',
        'password' => 'contraseña'
    ];
}
}
