<?php

namespace App\Http\Controllers\Admin;
use App\Purchaser;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $totalPurchases = Purchaser::where('status','Pending')->count();
        $totalReceiving = Purchaser::where('status','Recieved')->count();
        $totalCustomer = DB::table('customers')->count();
        return view('home',compact('totalPurchases','totalReceiving','totalCustomer'));
    }
}
