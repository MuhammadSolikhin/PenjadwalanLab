<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequestUpdate extends FormRequest
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
            'spesification' => 'required|string|max:500',
            'description' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Barang wajib diisi',
            'name.string' => 'Nama Barang harus berupa string',
            'name.max' => 'Nama Barang tidak boleh lebih dari 150 karakter',
            'spesification.required' => 'Spesifikasi Barang wajib diisi',
            'spesification.string' => 'Spesifikasi Barang harus berupa string',
            'spesification.max' => 'Spesifikasi Barang tidak boleh lebih dari 500 karakter',
            'description.required' => 'Deskripsi Barang wajib diisi',
            'description.string' => 'Deskripsi Barang harus berupa string',
            'description.max' => 'Deskripsi Barang tidak boleh lebih dari 500 karakter',
        ];
    }
}
