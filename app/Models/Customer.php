<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'password',
        'profile_photo'
    ];

    protected $hidden=[
        'password',
        'remember_token'
    ];

    protected function casts() : array
    {
        return [
            'password'=>'hashed',
        ];
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
