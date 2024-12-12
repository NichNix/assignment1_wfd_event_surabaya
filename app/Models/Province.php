<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public function Regency()
    {
        return $this->hasMany(Regency::class);
    }

    public function Event()
    {
        return $this->hasMany(Event::class);
    }
}
