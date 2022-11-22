<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchaser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    public function list(){
        $purchases = Purchaser::all();
        $customers = DB::table('customers')->get();
        return view('admin.purchase.index',compact('purchases','customers'));
    }

    public function create(Request $request){
        Purchaser::create([
            'customer_name' => $request->customer_name,
            'purchase_date' => $request->purchase_date,
            'date_recieved' => $request->date_recieved,
            'order_number' => $request->order_number,
            'part_number' => $request->part_number,
            'manufacturer' => $request->manufacturer,
            'cost' => $request->cost,
            'purchased_from' => $request->purchased_from,
            'purchase_method' => $request->purchase_method,
            'quantity' => $request->quantity,
            'quantity_recieved' => $request->quantity_recieved,
            'quantity_missing' => $request->quantity_missing,
            'status' => 'pending',
            'quality' => $request->quality,
            'selling_price' => $request->selling_price,
            'description' => $request->description,
            'serial_number' => $request->serial_number,
            'tracking_number' => $request->tracking_number,
            'currency' => $request->currency,
            'company_purchased_from' => $request->company_purchased_from,
            'notes' => $request->notes,
            'expected_delivery' => $request->expected_delivery
        ]);


        return redirect()->route('admin.purchaser.list');

    }

    public function createCustomer(Request $request){
        DB::table('customers')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'website' => $request->website,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);

        return Redirect()->back();
    }

    
}
