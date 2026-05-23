<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinationCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function subcategories()
    {
        return $this->hasMany(
            DestinationSubcategory::class,
            'destination_category_id'
        );
    }

    public function destinations()
    {
        return $this->hasMany(
            Destination::class,
            'destination_category_id'
        );
    }
}