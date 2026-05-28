<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacilityRequest extends FormRequest
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
                \Illuminate\Validation\Rule::unique('facilities', 'slug')
                    ->ignore($id)
                    ->whereNull('deleted_at')
            ],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama fasilitas wajib diisi.',
            'name.string' => 'Nama fasilitas harus berupa teks.',
            'name.max' => 'Nama fasilitas tidak boleh lebih dari 255 karakter.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.string' => 'Slug harus berupa teks.',
            'slug.max' => 'Slug tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug sudah digunakan oleh fasilitas lain.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
