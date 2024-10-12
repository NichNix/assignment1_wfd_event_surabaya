<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'venue',
        'date',
        'start_time',
        'description',
        'tags',
        'booking_url',
        'organizer_id', 
        'event_category_id', 
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
