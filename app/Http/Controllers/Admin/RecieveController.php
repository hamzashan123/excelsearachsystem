<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchaser;

class RecieveController extends Controller
{
    public function list(){

        $purchases = Purchaser::all();
        return view('admin.reciever.index',compact('purchases'));

    }
}
