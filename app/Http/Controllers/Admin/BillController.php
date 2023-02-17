<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index(){
        $bills = DB::table('bills')->where('user_id',Auth::user()->id)->get();

        return view('admin.bills.index',compact('bills'));
    }

    public function create(){
        
        return view('admin.bills.create');
    }

    

    

    public function store(Request $request){
        
        if($request->fieldset == 'one'){
            $types = $request->type;
            $Id = DB::table('bills')->insertGetId([
                'title' => $request->title,
                'user_id' => Auth::user()->id,
                'default_service' => $request->default_service
            ]);
            
            if(count($types) > 0){
                foreach($types as $key => $type){
                    DB::table('discount_types')->insertGetId([
                        'bill_id' => $Id,
                        'type' => $type,
                        'discount' => $request->discount[$key]
                    ]);
                }
                
            }
    
            return response()->json([
                'success' => true,
                'bill_id' => $Id,
                'msg' => "Bill Saved!"
            ]);
        }elseif($request->fieldset == 'two'){

            $hostId = DB::table('hosts')->insertGetId([
                'bill_id' => $request->bill_id,
                'name' => $request->host_name,
                'deposit' => $request->deposit
            ]);

            $guests = $request->guests;
            if(count($guests) > 0){
                foreach($guests as $key => $guest){
                    DB::table('guests')->insertGetId([
                        'bill_id' => $request->bill_id,
                        'host_id' => $hostId,
                        'name' => $guest,
                        'deposit' => $request->guest_deposits[$key]
                    ]);
                } 
            }

            return response()->json([
                'success' => true,
                'msg' => "Guest saved!"
            ]);

        }
            
    }


    public function getDiscountTypes(Request $request){
        if(!empty($request->bill_id) && !empty($request->type) ){
            $discountTypes = DB::table('discount_types')
                            ->where('bill_id',$request->bill_id)
                            ->where('type',$request->type)
                            ->first();
            $servicePrice = DB::table('bills')->where('id',$request->bill_id)->first()->default_service;
            return response()->json([
                'data' => $discountTypes,
                'servicePrice' => $servicePrice,
                'success' => true,
                'msg' => "Data found!"
            ]);
        }else{
                $discountTypes = DB::table('discount_types')
                                ->where('bill_id',$request->bill_id)
                                ->get();
    
                return response()->json([
                    'data' => $discountTypes,
                    'success' => true,
                    'msg' => "Data found!"
                ]);
        }
        
        
    }

    public function getHostGuest(Request $request){

        if(!empty($request->bill_id)){
            $host = DB::table('hosts')
            ->where('bill_id',$request->bill_id)
            ->first();
            $guests = DB::table('guests')
                    ->where('bill_id',$request->bill_id)
                    ->get();

            return response()->json([
                        'host' => $host,
                        'guests' => $guests,
                        'success' => true,
                        'msg' => "Data found!"
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => "No Data found!"
                ]);
        }
        
    }

    public function Items(){
        // $items = DB::table('items')
        // ->where('bill_id',66)
        // ->get();
       $items =  DB::table('items')->select(DB::raw('COUNT(category) as count'), 'category')
        ->groupBy('category')
        ->having('count', '>', 0)
        ->get();
        return $items;
    }
    public function saveItems(Request $request){
        if(!empty($request->item_description)){
            $Id = DB::table('items')->insertGetId([
                'bill_id' => $request->bill_id,
                'item_description' => $request->item_description,
                'item_price' => $request->item_price,
                'category' => $request->category,
                'quantity' => $request->quantity,
                'item_saving' => $request->item_saving,
            ]);
            
            $items = DB::table('items')
                    ->where('bill_id',$request->bill_id)
                    ->get();

            return response()->json([
                'data' => $items,
                'success' => true,
                'bill_id' => $Id,
                'msg' => "Item Saved!"
            ]);
        }
    }

    public function deleteBill(int $id){
        try{
            DB::table('bills')
            ->where('id',$id)
            ->delete();
        }catch(Exception $e){

        }

        try{
            DB::table('discount_types')
            ->where('bill_id',$id)
            ->delete();
        }catch(Exception $e){
            
        }

        try{
            DB::table('hosts')
            ->where('bill_id',$id)
            ->delete();
        }catch(Exception $e){
            
        }

        try{
            DB::table('guests')
            ->where('bill_id',$id)
            ->delete();
        }catch(Exception $e){
            
        }
        
        try{
            DB::table('items')
            ->where('bill_id',$id)
            ->delete();
        }catch(Exception $e){
            
        }
                   

        return redirect()->back()->with('success','Bill Deleted');
    }


}
