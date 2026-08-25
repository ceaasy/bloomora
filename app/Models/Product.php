<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'photo',
        'stock',
        'price_small',
        'price_medium',
        'price_large',
        'customization_options'
    ];

    protected $casts = [
        'customization_options'=> 'array'
    ];

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
