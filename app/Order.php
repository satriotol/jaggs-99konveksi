<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = [
        'judul', 'cust_name', 'cust_phone', 'cust_email', 'start_date', 'end_date', 'user_id', 'subtotal'
    ];
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public static function getOrders($request)
    {
        $user_id = $request->user_id;
        $judul = '%' . $request->judul . '%';
        $cust_name = '%' . $request->cust_name . '%';

        $order = Order::orderBy('id', 'desc');
        if ($user_id) {
            $order->where('user_id', $user_id);
        }
        if ($request->judul) {
            $order->where('judul', 'LIKE', $judul);
        }
        if ($request->cust_name) {
            $order->where('cust_name', 'LIKE', $cust_name);
        }

        if (Auth::user()->role != 'admin') {
            return $order->where('user_id', Auth::user()->id)->paginate(10);
        } else {

            return $order->paginate(10);
        }
    }
    public function getQty()
    {
        return $this->orderdetail()->sum('qty');
    }
    public function getTotalPrice()
    {
        $sumPrice = 0;
        foreach ($this->orderdetail as $od) {
            $sumPrice += $od->getTotalPriceItem();
        }
        return $sumPrice;
    }
    public function getStatusPayment()
    {
        $status = $this->getTotalPrice() - $this->payment->sum('pay');
        return $status;
    }
}
