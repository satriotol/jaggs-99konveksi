<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrdersRequest;
use App\Order;
use App\OrderDetail;
use App\Payment;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index')->with('orders', Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrdersRequest $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'judul' => $request->judul,
            'cust_name'=> $request->cust_name,
            'cust_email'=> $request->cust_email,
            'cust_phone'=> $request->cust_phone,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
        ]);
        session()->flash('success','Order Create Successfully');
        return redirect(route('orders.show',$order->id));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // $pdf = PDF::
        return view('order.show')->with('order',$order)->with('orderdetails', OrderDetail::all())->with('payments', Payment::all());
    }
    // public function printpdf(Order $order)
    // {
    //     $pdf = PDF::loadview('order.show');
    //     return view('order.show')->with('order',$order)->with('orderdetails', OrderDetail::all())->with('payments', Payment::all());
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
