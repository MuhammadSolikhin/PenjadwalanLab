<?php

namespace App\Http\Requests\LaboratoriumTypes;

use Illuminate\Foundation\Http\FormRequest;

class LabTypeStoreRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'description' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Jenis Laboratorium wajib diisi',
            'name.string' => 'Nama Jenis Laboratorium harus berupa string',
            'name.max' => 'Nama Jenis Laboratorium tidak boleh lebih dari 150 karakter',
            'description.required' => 'Deskripsi Jenis Laboratorium wajib diisi',
            'description.string' => 'Deskripsi Jenis Laboratorium harus berupa string',
            'description.max' => 'Deskripsi Jenis Laboratorium tidak boleh lebih dari 500 karakter',
        ];
    }
}
