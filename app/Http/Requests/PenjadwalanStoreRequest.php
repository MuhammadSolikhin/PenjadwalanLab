<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjadwalanStoreRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'lab_id' => 'required|exists:laboratoria,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'keperluan' => 'required|string|max:255',
            'status' => 'in:pending,disetujui,ditolak',
        ];
    }
}
