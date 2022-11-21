<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchaser;

class PurchaseController extends Controller
{
    public function list(){
        $purchases = Purchaser::all();

        return view('admin.purchase.index',compact('purchases'));
    }

    public function create(Request $request){
        Purchaser::create([
            'customer_name' => $request->customer_name,
            'part_number' => $request->part_number,
            'purchase_date' => $request->purchase_date,
            'cost' => $request->cost,
            'quantity' => $request->quantity,
            'manufacturer' => $request->manufacturer,
            'status' => 'pending',
            'selling_price' => $request->selling_price,
            'currency' => $request->currency,
            'tracking_number' => $request->tracking_number,
            'description' => $request->description,
            'notes' => $request->notes,
            'expected_delivery' => $request->expected_delivery
        ]);


        return redirect()->route('admin.purchaser.list');

    }
}
