<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'token',
    ];

    protected $hidden = [
        'password',
        'token',
        'remember_token',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
