<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestinationRequest extends FormRequest
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
        $destinationId = $this->route('id');

        return [
            'destination_category_id' => ['required', 'exists:destination_categories,id'],
            'destination_subcategory_id' => ['nullable', 'exists:destination_subcategories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('destinations', 'slug')
                    ->ignore($destinationId)
                    ->whereNull('deleted_at')
            ],
            'description' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'district' => ['nullable', 'string', 'max:255'],
            'google_maps_url' => ['nullable', 'string'],
            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'ticket_price' => ['required', 'integer', 'min:0'],
            'operational_hours' => ['nullable', 'string', 'max:255'],
            'visit_duration_hours' => ['nullable', 'integer', 'min:0'],
            'rating' => ['required', 'numeric', 'between:0,5'],
            'access_level' => ['required', 'in:Mudah,Sedang,Sulit'],
            'generated_tags' => ['nullable', 'array'],
            'status' => ['required', 'in:active,inactive'],
            'activities' => ['nullable', 'array'],
            'activities.*' => ['exists:activities,id'],
            'facilities' => ['nullable', 'array'],
            'facilities.*' => ['exists:facilities,id'],
            'travel_types' => ['nullable', 'array'],
            'travel_types.*' => ['exists:travel_types,id'],
            'visit_times' => ['nullable', 'array'],
            'visit_times.*' => ['exists:visit_times,id'],
            'transportations' => ['nullable', 'array'],
            'transportations.*' => ['exists:transportations,id'],
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
            'destination_category_id.required' => 'Kategori wajib dipilih.',
            'destination_category_id.exists' => 'Kategori tidak valid.',
            'destination_subcategory_id.exists' => 'Subkategori tidak valid.',
            'name.required' => 'Nama destinasi wajib diisi.',
            'name.string' => 'Nama destinasi harus berupa teks.',
            'name.max' => 'Nama destinasi tidak boleh lebih dari 255 karakter.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.string' => 'Slug harus berupa teks.',
            'slug.max' => 'Slug tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug sudah digunakan oleh destinasi lain.',
            'main_image.image' => 'Gambar utama harus berupa file gambar.',
            'main_image.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'main_image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'ticket_price.required' => 'Harga tiket wajib diisi.',
            'ticket_price.integer' => 'Harga tiket harus berupa angka bulat.',
            'ticket_price.min' => 'Harga tiket tidak boleh kurang dari 0.',
            'rating.required' => 'Rating wajib diisi.',
            'rating.numeric' => 'Rating harus berupa angka.',
            'rating.between' => 'Rating harus di antara 0 dan 5.',
            'access_level.required' => 'Tingkat aksesibilitas wajib dipilih.',
            'access_level.in' => 'Tingkat aksesibilitas tidak valid.',
            'status.required' => 'Status keaktifan wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
