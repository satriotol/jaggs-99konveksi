<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $orders = Order::getOrders($request);
        $users = User::all()->count();
        return view('home')->with('orders', $orders)->with('users', $users);
    }
    public function profile()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->simplePaginate(5);
        return view('profile')->with('orders', $orders);
    }
}
