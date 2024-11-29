<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'venue',
        'date', // Tanggal event (YYYY-MM-DD)
        'start_time', // Waktu mulai event (HH:mm:ss)
        'end_time', // Waktu selesai event (HH:mm:ss)
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
        'status_event',
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

    // Getter untuk status event
    public function getStatusAttribute()
    {
        // Ensure the timezone is correct (set to Asia/Jakarta)
        $now = Carbon::now('Asia/Jakarta');  // Current time in Asia/Jakarta timezone
        $startDateTime = Carbon::parse($this->date . ' ' . $this->start_time, 'Asia/Jakarta');  // Event start time in Asia/Jakarta timezone
    
        // Check if end_time is set, otherwise, return default status
        if (empty($this->end_time)) {
            // If no end_time is provided, fallback to only checking the start time
            if ($now->isBefore($startDateTime)) {
                return 'Event belum dimulai';
            } elseif ($now->isAfter($startDateTime)) {
                return 'Sedang berlangsung';
            }
        }
    
        // Event end time (assuming end_time is set)
        $endDateTime = Carbon::parse($this->date . ' ' . $this->end_time, 'Asia/Jakarta');  // Event end time in Asia/Jakarta timezone
    
        // If event has not started yet
        if ($now->isBefore($startDateTime)) {
            // Get the difference in seconds between now and the event start time
            $diffInSeconds = $now->diffInSeconds($startDateTime);
    
            // Calculate the difference in days, hours, minutes, and seconds
            $diffInDays = floor($diffInSeconds / (24 * 3600));  // Days
            $diffInSeconds %= (24 * 3600);  // Remaining seconds after full days
            $diffInHours = floor($diffInSeconds / 3600);  // Hours
            $diffInSeconds %= 3600;  // Remaining seconds after full hours
            $diffInMinutes = floor($diffInSeconds / 60);  // Minutes
            $diffInSeconds %= 60;  // Remaining seconds
    
            // Return the remaining time as days, hours, minutes, and seconds
            $timeString = '';
            if ($diffInDays > 0) {
                $timeString .= "$diffInDays hari ";
            }
            if ($diffInHours > 0) {
                $timeString .= "$diffInHours jam ";
            }
            if ($diffInMinutes > 0) {
                $timeString .= "$diffInMinutes menit ";
            }
            if ($diffInSeconds > 0) {
                $timeString .= "$diffInSeconds detik ";
            }
    
            return $timeString . "lagi"; // Countdown until event starts
        }
    
        // Event is ongoing (between start and end time)
        elseif ($now->isBetween($startDateTime, $endDateTime)) {
            // Get the difference in seconds between now and the event end time
            $diffInSeconds = $now->diffInSeconds($endDateTime);
    
            // Calculate the difference in days, hours, minutes, and seconds
            $diffInDays = floor($diffInSeconds / (24 * 3600));  // Days
            $diffInSeconds %= (24 * 3600);  // Remaining seconds after full days
            $diffInHours = floor($diffInSeconds / 3600);  // Hours
            $diffInSeconds %= 3600;  // Remaining seconds after full hours
            $diffInMinutes = floor($diffInSeconds / 60);  // Minutes
            $diffInSeconds %= 60;  // Remaining seconds
    
            // Return the remaining time until the event finishes
            $timeString = '';
            if ($diffInDays > 0) {
                $timeString .= "$diffInDays hari ";
            }
            if ($diffInHours > 0) {
                $timeString .= "$diffInHours jam ";
            }
            if ($diffInMinutes > 0) {
                $timeString .= "$diffInMinutes menit ";
            }
            if ($diffInSeconds > 0) {
                $timeString .= "$diffInSeconds detik ";
            }
    
            return 'Sedang berlangsung - ' . $timeString . "lagi"; // Ongoing event and countdown until it finishes
        }
    
        // Event has finished (after the event end time)
        else {
            return 'Selesai'; // Event finished
        }
    }    
}
