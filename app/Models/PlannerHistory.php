<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlannerHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_token',
        'categories',
        'activities',
        'travel_type_id',
        'transportation_id',
        'visit_times',
        'budget',
        'access_level',
        'crowd_level',
        'recommendations',
    ];

    protected $casts = [
        'categories' => 'array',
        'activities' => 'array',
        'visit_times' => 'array',
        'recommendations' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function travelType()
    {
        return $this->belongsTo(TravelType::class);
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }
}
