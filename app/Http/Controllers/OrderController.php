<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrdersRequest;
use App\Mail\InvoiceMail;
use App\Order;
use App\OrderDetail;
use App\Payment;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
    public function indexinvoice()
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
        return view('order.show')->with('order',$order)->with('orderdetails', OrderDetail::all())->with('payments', Payment::all());
    }
    public function printpdf($id)
    {
        $order = Order::with('orderdetail')->find($id);
        $pdf = PDF::loadview('pdf_test',compact('order'));
        return $pdf->download("INV-".$order->id.".pdf");
    }

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
    public function destroy(Order $order)
    {
        $order->delete();
        $order->orderdetail()->delete();
        $order->payment()->delete();
        session()->flash('success','Order Deleted Successfully');
        return redirect(route('orders.index'));
    }
    public function sendemail($id)
    {
        $order = Order::with('orderdetail')->find($id);
        $pdf = PDF::loadview('pdf_test',compact('order'))->setPaper('a4');
        Mail::to($order->cust_email)->send(new InvoiceMail($order,$pdf));
        session()->flash('success','Send Email Successfully');
        return redirect()->back();
    }
}
