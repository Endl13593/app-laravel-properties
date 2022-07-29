<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email:filter',
            'password' => 'required',
            'device_name' => 'required',
        ];
    }
}
