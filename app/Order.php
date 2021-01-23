<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'judul','cust_name','cust_phone','cust_email','start_date','end_date','user_id','subtotal'
    ];
    public function orderdetail(){
        return $this->hasMany(OrderDetail::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
