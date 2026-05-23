<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DestinationSubcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'destination_category_id',
        'name',
        'slug',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(
            DestinationCategory::class,
            'destination_category_id'
        );
    }

    public function destinations()
    {
        return $this->hasMany(
            Destination::class,
            'destination_subcategory_id'
        );
    }
}