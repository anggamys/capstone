<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $blogId = $this->route('id');

        return [
            'blog_category_id' => ['required', 'exists:blog_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('blogs', 'slug')
                    ->ignore($blogId)
                    ->whereNull('deleted_at')
            ],
            'content' => ['required', 'string'],
            'image' => $blogId 
                ? ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'] 
                : ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'status' => ['required', 'in:published,draft'],
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
            'blog_category_id.required' => 'Kategori blog wajib dipilih.',
            'blog_category_id.exists' => 'Kategori blog yang dipilih tidak valid.',
            'title.required' => 'Judul blog wajib diisi.',
            'title.string' => 'Judul blog harus berupa teks.',
            'title.max' => 'Judul blog tidak boleh lebih dari 255 karakter.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.string' => 'Slug harus berupa teks.',
            'slug.max' => 'Slug tidak boleh lebih dari 255 karakter.',
            'slug.unique' => 'Slug sudah digunakan oleh blog lain.',
            'content.required' => 'Isi konten blog wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, svg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}
