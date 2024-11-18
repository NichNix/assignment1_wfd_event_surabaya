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
        'booking_url', 
        'tags', 
        'max_tickets',  
        'sold_tickets',
        'status',
        'image',
        'price',
        'province_id',
        'regency_id',
        'organizer_id',
        'event_category_id',
        'active',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Book::class, 'id_event');
    }
}
