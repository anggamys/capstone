<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    protected $appends = [
        'image_url',
    ];

    protected $fillable = [
        'blog_category_id',
        'admin_id',
        'title',
        'slug',
        'content',
        'image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/bg-login.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Get the category that owns the blog.
     */
    public function category()
    {
        return $this->belongsTo(CategoryBlog::class, 'blog_category_id');
    }

    /**
     * Get the admin author that owns the blog.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
