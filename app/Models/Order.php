<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'recipient_name',
        'recipient_phone',
        'pickup_method',
        'shipping_address',
        'delivery_date',
        'order_notes',
        'reference_photo',
        'greeting_card',
        'subtotal',
        'shipping_cost',
        'total_price',
        'status'
    ];
    
    protected $casts = [
        'delivery_date' =>'date'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function shipment() {
        return $this->hasOne(Shipment::class);
    }
}
