<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'last_name' => 'required',
            'gender'=>'required',
            'email' => 'required|email',
            'dni' => 'required|min:13|numeric',
            'functional' => 'nullable',
            'nominal' => 'nullable',
            'type' => 'required',
            'password' => 'min:8'
        ];
    }
}
