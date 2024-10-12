<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLicenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id', // El user_id debe existir en la tabla de users
            'department_id' => 'required|exists:departments,id', // Debe existir en la tabla de departments
            'reason_id' => 'required|string|max:255', // Texto y con longitud máxima de 255 caracteres
            'boss_id' => 'required|string|max:255', // El nombre del jefe
            'beginning' => 'required|date|before_or_equal:end', // La fecha de inicio debe ser anterior o igual a la fecha de fin
            'end' => 'required|date|after_or_equal:beginning', // La fecha de fin debe ser posterior o igual a la de inicio
            'days' => 'required|integer|min:1', // Deben ser al menos 1 día
            'days_h' => 'required|integer|min:1', // Deben ser al menos 1 día habiles

        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El campo usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'department_id.required' => 'El campo departamento es obligatorio.',
            'department_id.exists' => 'El departamento seleccionado no existe.',
            'reason_id.required' => 'El campo motivo es obligatorio.',
            'boss_id.required' => 'El campo jefe es obligatorio.',
            'beginning.required' => 'La fecha de inicio es obligatoria.',
            'beginning.before_or_equal' => 'La fecha de inicio debe ser anterior o igual a la fecha de fin.',
            'end.required' => 'La fecha de fin es obligatoria.',
            'end.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
            'days.required' => 'El número de días es obligatorio.',
            'days.integer' => 'El número de días debe ser un número entero.',
            'days.min' => 'El número de días debe ser al menos 1.',
            'days_h.required' => 'El número de días habiles es obligatorio.',
            'days_h.integer' => 'El número de días habiles debe ser un número entero.',
            'days_h.min' => 'El número de días habiles debe ser al menos 1.',
        ];
    }
}
