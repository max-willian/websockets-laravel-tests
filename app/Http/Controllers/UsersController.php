<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('onlineUsers');
    }

    public function onlineUsers(){
        echo User::select('name')->where('online_status', 1)->get();
    }

    public function setOnline(){
        Auth::user()->online_status = 1;
        Auth::user()->save();
    }

    public function setOffline(){
        Auth::user()->online_status = 0;
        Auth::user()->save();
    }
}
