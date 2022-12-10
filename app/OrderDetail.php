<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'product_name', 'price', 'qty'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function getTotalPriceItem()
    {
        $qty = $this->qty;
        $price = $this->price;
        return $qty * $price;
    }
}
