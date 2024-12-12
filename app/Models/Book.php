<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'nomor_hp',
        'id_event',
        'status_bayar',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }
}
