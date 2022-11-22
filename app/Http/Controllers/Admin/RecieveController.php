<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchaser;
use Illuminate\Foundation\Console\Presets\React;

class RecieveController extends Controller
{
    public function list(){

        $purchases = Purchaser::all();
        return view('admin.reciever.index',compact('purchases'));

    }

    public function searchPurchases(Request $request){
        
        $purchases = Purchaser::where('tracking_number','LIKE','%'.$request->tracking_number.'%')
                ->orWhere('part_number','LIKE','%'.$request->part_number.'%')
                ->get();
                
        return view('admin.reciever.index',compact('purchases'));
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
                    'date_recieved' => $request->edit_date_recieved,
                    'order_number' => $request->edit_order_number,
                    'serial_number' => $request->edit_serial_number,
                    'status' => $request->edit_status,
                    'notes' => $request->editnotes,
                    'quality' => $request->edit_quality,
                    'quantity_recieved' => $request->edit_quantity_recieved,
                    'quantity_missing' => $request->edit_quantity_missing,
                    'purchased_from' => $request->edit_purchased_from,
                    'purchase_method' => $request->edit_purchase_method,
                    'company_purchased_from' => $request->edit_company_purchased_from,
                    
                    
                 ]);
        $purchases = Purchaser::all();          
        return view('admin.reciever.index',compact('purchases'));
    }
}
