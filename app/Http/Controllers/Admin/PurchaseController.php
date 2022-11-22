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
            'expected_delivery' => $request->expected_delivery,
            'purchase_method' => $request->purchase_method
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
