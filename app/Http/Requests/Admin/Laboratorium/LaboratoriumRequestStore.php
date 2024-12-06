<?php

namespace App\Http\Requests\Admin\Laboratorium;

use Illuminate\Foundation\Http\FormRequest;

class LaboratoriumRequestStore extends FormRequest
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
            'name' => 'required|string|max:150|unique:laboratoria,name',
            'lokasi' => 'required|string|max:150',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|string|max:150|in:aktif,tidak aktif',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Laboratorium wajib diisi',
            'name.string' => 'Nama Laboratorium harus berupa string',
            'name.max' => 'Nama Laboratorium tidak boleh lebih dari 150 karakter',
            'name.unique' => 'Nama Laboratorium sudah digunakan',
            'lokasi.required' => 'Lokasi Laboratorium wajib diisi',
            'lokasi.string' => 'Lokasi Laboratorium harus berupa string',
            'lokasi.max' => 'Lokasi Laboratorium tidak boleh lebih dari 150 karakter',
            'kapasitas.required' => 'Kapasitas Laboratorium wajib diisi',
            'kapasitas.integer' => 'Kapasitas Laboratorium harus berupa integer',
            'kapasitas.min' => 'Kapasitas Laboratorium harus lebih dari 1',
            'status.required' => 'Status Laboratorium wajib diisi',
            'status.string' => 'Status Laboratorium harus berupa string',
            'status.max' => 'Status Laboratorium tidak boleh lebih dari 150 karakter',
            'status.in' => 'Status Laboratorium harus salah satu dari: aktif, tidak aktif',
        ];
    }
}
