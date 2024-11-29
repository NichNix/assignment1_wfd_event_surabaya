<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Database\Eloquent\Model;

class Organizer extends Authenticatable 
{
    use HasFactory;
    
    protected $table = 'organizers';
    protected $fillable = [
        'name',
        'email',          // Add email field
        'password',       // Add password field
        'description',
        'facebook_link',
        'x_link',         // Assuming this is for Twitter or X links
        'website_link',
    ];

    protected $hidden = [
        'password' , 'remember_token',
    ];
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
