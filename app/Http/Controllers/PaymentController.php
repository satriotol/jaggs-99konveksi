<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdateOrderPaymentRequest;
use Illuminate\Http\Request;
use App\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function index_income()
    {
        $incomes = Payment::where('type','=','income')->get();
        return view('payment.index_income')->with('incomes',$incomes);
    }
    public function index_outcome()
    {
        $outcomes = Payment::where('type','=','outcome')->get();
        return view('payment.index_outcome')->with('outcomes',$outcomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function create_outcome()
    {
        return view('payment.create_outcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentRequest $request)
    {
        Payment::create([
            'order_id' => $request->order_id,
            'pay' => $request->pay,
            'type' => $request->type,
            'date' => $request->date,
            'description'=> $request->description
        ]);
        session()->flash('success','Payment Create Successfully');
        return redirect()->back();
    }
    public function store_outcome(CreatePaymentRequest $request)
    {
        Payment::create([
            'order_id' => $request->order_id,
            'pay' => $request->pay,
            'type' => $request->type,
            'date' => $request->date,
            'description'=> $request->description
        ]);
        session()->flash('success','Payment Create Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('payment.create')->with('payment',$payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderPaymentRequest $request, Payment $payment)
    {
        $payment->update([
            'pay' => $request['pay'],
            'description' => $request['description'],
            'date' => $request['date']
        ]);
        session()->flash('success','Payment Update Successfully');
        return redirect()->route('orders.show',$payment->order_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        session()->flash('success','Payment Deleted Successfully');
        return redirect()->back();
    }
}
