<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'destination_category_id',
        'destination_subcategory_id',
        'name',
        'slug',
        'short_description',
        'description',
        'address',
        'district',
        'latitude',
        'longitude',
        'google_maps_url',
        'main_image',
        'ticket_price',
        'opening_time',
        'closing_time',
        'visit_duration_hours',
        'rating',
        'crowd_level',
        'access_level',
        'activity_level',
        'generated_tags',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'ticket_price' => 'integer',
        'visit_duration_hours' => 'decimal:1',
        'rating' => 'decimal:1',
        'generated_tags' => 'array',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    public function category()
    {
        return $this->belongsTo(DestinationCategory::class, 'destination_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(DestinationSubcategory::class, 'destination_subcategory_id');
    }
}