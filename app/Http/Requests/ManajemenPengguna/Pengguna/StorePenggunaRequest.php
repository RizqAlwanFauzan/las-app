<?php

namespace App\Http\Requests\ManajemenPengguna\Pengguna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StorePenggunaRequest extends FormRequest
{
    protected $errorBag = 'store';

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
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'peran'    => 'required|array',
            'peran.*'  => 'required|string|exists:roles,name'
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
            'name'     => 'Nama Lengkap',
            'email'    => 'Email',
            'password' => 'Password',
            'peran'    => 'Peran',
            'peran.*'  => 'Peran'
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this->merge([
            'password' => Hash::make($this->input('password')),
        ]);
    }
}
