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
        $now = Carbon::now();
        $startDateTime = Carbon::parse($this->date . ' ' . $this->start_time);

        // If event has not started yet
        if ($now->isBefore($startDateTime)) {
            $diffInDays = $now->diffInDays($startDateTime);
            $diffInHours = $now->diffInHours($startDateTime);
            $diffInMinutes = $now->diffInMinutes($startDateTime);
            $diffInSeconds = $now->diffInSeconds($startDateTime);

            // Return remaining days, hours, minutes or seconds
            if ($diffInDays > 0) {
                return "$diffInDays hari lagi";
            } else {
                $remainingHours = $diffInHours;
                $remainingMinutes = $diffInMinutes - ($remainingHours * 60);
                $remainingSeconds = $diffInSeconds - ($remainingMinutes * 60 + $remainingHours * 3600);

                $timeString = "";

                if ($remainingHours > 0) {
                    $timeString .= "$remainingHours jam ";
                }
                if ($remainingMinutes > 0) {
                    $timeString .= "$remainingMinutes menit ";
                }
                if ($remainingSeconds > 0) {
                    $timeString .= "$remainingSeconds detik ";
                }

                return $timeString . "lagi";
            }
        }

        // Event has finished (1 day after start time)
        elseif ($now->isAfter($startDateTime->addDay())) {
            return 'Selesai';
        }

        // Event is ongoing
        else {
            return 'Sedang berlangsung';
        }
    }
}
