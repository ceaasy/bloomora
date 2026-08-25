<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'size',
        'quantity',
        'customization_selected',
        'unit_price',
        'subtotal'
    ];

    protected $casts = [
        'customization_selected'=>'array'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
