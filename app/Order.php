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
        $columnsToSearch = ['judul', 'cust_name', 'cust_phone', 'cust_email', 'start_date', 'end_date', 'user_id', 'subtotal'];
        $searchQuery = '%' . $request->search . '%';
        $order = Order::orderBy('id', 'desc');
        foreach ($columnsToSearch as $column) {
            $order = $order->orWhere($column, 'LIKE', $searchQuery);
        }
        if (Auth::user()->role != 'admin') {
            return $order->where('user_id', Auth::user()->id);
        }
        return $order->paginate(10);
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
