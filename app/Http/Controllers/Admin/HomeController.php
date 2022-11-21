<?php

namespace App\Http\Controllers\Admin;
use App\Purchaser;

class HomeController
{
    public function index()
    {
        $totalPurchases = Purchaser::where('status','pending')->count();
        $totalReceiving = Purchaser::where('status','success')->count();
        return view('home',compact('totalPurchases','totalReceiving'));
    }
}
