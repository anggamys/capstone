<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use Illuminate\Database\Seeder;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryBlog::firstOrCreate(['slug' => 'tips-trik'], ['name' => 'Tips & Trik', 'status' => 'active']);
        CategoryBlog::firstOrCreate(['slug' => 'wisata-alam'], ['name' => 'Wisata Alam', 'status' => 'active']);
        CategoryBlog::firstOrCreate(['slug' => 'kuliner'], ['name' => 'Kuliner', 'status' => 'active']);
        CategoryBlog::firstOrCreate(['slug' => 'budaya'], ['name' => 'Budaya', 'status' => 'active']);
        CategoryBlog::firstOrCreate(['slug' => 'event-festival'], ['name' => 'Event & Festival', 'status' => 'active']);
        CategoryBlog::firstOrCreate(['slug' => 'akomodasi'], ['name' => 'Akomodasi', 'status' => 'active']);
    }
}
