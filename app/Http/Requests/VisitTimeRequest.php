<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitTimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 
                'string', 
                'max:255', 
                \Illuminate\Validation\Rule::unique('visit_times', 'slug')
                    ->ignore($id)
                    ->whereNull('deleted_at')
            ],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama waktu kunjungan wajib diisi.',
            'name.string' => 'Nama waktu kunjungan harus berupa teks.',
            'name.max' => 'Nama waktu kunjungan tidak boleh lebih dari 255 karakter.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.string' => 'Slug harus berupa teks.',
            'slug.max' => 'Slug tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug sudah digunakan oleh waktu kunjungan lain.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
