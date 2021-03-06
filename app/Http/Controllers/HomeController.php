<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends AuthController
{

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $wishlistItems = Auth::user()->wishlistItems->toArray();

        return view('home', compact('wishlistItems'));
    }
}
