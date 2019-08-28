<?php

namespace App\Http\Controllers;

use App\Events\NewOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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
}
