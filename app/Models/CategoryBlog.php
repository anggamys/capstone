<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryBlog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    /**
     * Get the blogs for the category.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }
}
