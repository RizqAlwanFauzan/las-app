<?php

namespace App\Http\Requests\Auth\Masuk;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateMasukRequest extends FormRequest
{
    protected $errorBag = 'authenticate';

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
    public function rules(): array
    {
        return [
            'email'            => 'required|string|email',
            'password'         => 'required|string'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'email'            => 'Email',
            'password'         => 'Password'
        ];
    }
}
