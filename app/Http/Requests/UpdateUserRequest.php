<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'gender'=> 'required',
            'email' => 'required|email',
            'dni' => 'required|min:13|numeric',
            'rtn' => 'required|min:13|numeric',
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
        'gender'=>'género',
        'email' => 'correo electrónico',
        'dni' => 'DNI',
        'dni' => 'RTN',
        'functional' => 'cargo funcional',
        'nominal' => 'cargo nominal',
        'type' => 'tipo de contratación',
        'password' => 'contraseña'
    ];
}
}
