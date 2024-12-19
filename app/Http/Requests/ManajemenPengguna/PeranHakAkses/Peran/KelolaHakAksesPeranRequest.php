<?php

namespace App\Http\Requests\ManajemenPengguna\PeranHakAkses\Peran;

use Illuminate\Foundation\Http\FormRequest;

class KelolaHakAksesPeranRequest extends FormRequest
{
    protected $errorBag = 'kelolaHakAkses';

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
            'hak_akses'   => 'array',
            'hak_akses.*' => 'exists:permissions,name'
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
            'hak_akses'   => 'Hak Akses',
            'hak_akses.*' => 'Hak Akses'
        ];
    }
}
