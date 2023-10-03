<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    // Validate 
    public function rules(): array
    {
        return [
            'name' => 'required|string',
             'email' => 'required|email|unique:users,email',
        ];
    }
}
