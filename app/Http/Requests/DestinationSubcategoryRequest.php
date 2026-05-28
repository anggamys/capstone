<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DestinationSubcategoryRequest extends FormRequest
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
        $subcategoryId = $this->route('id');

        return [
            'destination_category_id' => ['required', 'exists:destination_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 
                'string', 
                'max:255', 
                \Illuminate\Validation\Rule::unique('destination_subcategories', 'slug')
                    ->ignore($subcategoryId)
                    ->whereNull('deleted_at')
            ],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'destination_category_id.required' => 'Kategori induk wajib dipilih.',
            'destination_category_id.exists' => 'Kategori induk tidak valid.',
            'name.required' => 'Nama subkategori wajib diisi.',
            'name.string' => 'Nama subkategori harus berupa teks.',
            'name.max' => 'Nama subkategori tidak boleh lebih dari 255 karakter.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.string' => 'Slug harus berupa teks.',
            'slug.max' => 'Slug tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug sudah digunakan oleh subkategori lain.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}

