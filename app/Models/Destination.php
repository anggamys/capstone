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
        'description',
        'address',
        'district',
        'latitude',
        'longitude',
        'google_maps_url',
        'main_image',
        'ticket_price',
        'operational_hours',
        'visit_duration_hours',
        'rating',
        'access_level',
        'generated_tags',
        'status',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'ticket_price' => 'integer',
        'operational_hours' => 'string',
        'visit_duration_hours' => 'integer',
        'rating' => 'decimal:1',
        'generated_tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(DestinationCategory::class, 'destination_category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(DestinationSubcategory::class, 'destination_subcategory_id');
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_destination');
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'destination_facility');
    }

    public function travelTypes()
    {
        return $this->belongsToMany(TravelType::class, 'destination_travel_type');
    }

    public function visitTimes()
    {
        return $this->belongsToMany(VisitTime::class, 'destination_visit_time');
    }

    public function transportations()
    {
        return $this->belongsToMany(Transportation::class, 'destination_transportation');
    }
}