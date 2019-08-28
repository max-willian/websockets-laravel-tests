<?php

namespace App\Http\Controllers;

use App\Events\NewOrder;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('newOrder');
    }

    public function index(){
        return view('orders');
    }

    public function newOrder(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'description' => 'required',
            'value' => 'required',
        ]);

        $r =\App\Order::create($validated);

        broadcast(new NewOrder($r));

        dd($r);
    }

    public function fetchOrders(){
        echo Order::where('user_id', Auth::user()->id)->get();
    }
}
