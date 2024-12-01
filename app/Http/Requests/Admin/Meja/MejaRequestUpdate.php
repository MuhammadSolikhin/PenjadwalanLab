<?php

namespace App\Http\Requests\Admin\Meja;

use Illuminate\Foundation\Http\FormRequest;

class MejaRequestUpdate extends FormRequest
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
    public function rules(): array
    {
        return [
            'no' => 'required|string|max:3|unique:mejas,no,' . $this->meja->id,
        ];
    }

    public function messages(): array
    {
        return [
            'no.required' => 'Nomor Meja wajib diisi.',
            'no.string' => 'Nomor Meja harus berupa string.',
            'no.max' => 'Nomor Meja tidak boleh lebih dari 3 digit.',
            'no.unique' => 'Nomor Meja sudah digunakan.',
        ];
    }
}
