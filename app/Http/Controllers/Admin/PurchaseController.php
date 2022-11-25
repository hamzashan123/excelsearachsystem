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

    public function customers(){
        $customers = DB::table('customers')->get();
        return view('admin.customers.index', compact('customers'));
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

    public function edit(Request $request){
        $data = Purchaser::where('id','=' ,$request->id)
        ->get();
        if(!empty($data)){
            return response()->json(['status' => 200 ,'data' => $data]);
        }else{
            return response()->json(['status' => 500 ,'data' => null]);
        }
        
    }

    public function update(Request $request){
        //dd($request);
        Purchaser::where('id' ,$request->edit_data_id)
                ->update([

                    'part_number' => $request->edit_part_number,
                    'cost' => $request->edit_cost,
                    'manufacturer' => $request->edit_manufacturer,
                    'selling_price' => $request->edit_selling_price,
                    'currency' => $request->edit_currency,
                    'tracking_number' => $request->edit_tracking_number,
                    'order_number' => $request->edit_order_number,
                    'serial_number' => $request->edit_serial_number,
                    'purchase_date' => $request->edit_date_purchased,
                    'purchase_method' => $request->edit_purchase_method,
                    'description' => $request->edit_description,
                    'notes' => $request->edit_notes,
                    'expected_delivery' => $request->edit_expected_delivery
                 ]);
        return redirect()->route('admin.purchaser.list');
    }

    public function createCustomer(Request $request){
        $data = DB::table('customers')->insertGetId([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'vat_number' => $request->vat_number,
            'website' => $request->website,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);
        
        $created_customer = DB::table('customers')->where('id',$data)->first();
        session()->forget('created_customer');
        session()->put('created_customer', $created_customer);

        return Redirect()->back();
    }

    
}
