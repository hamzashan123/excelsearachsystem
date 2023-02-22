<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Items;
use App\ItemsPurchases;

class NewBillController extends Controller
{
    public function index(){
        $bills = DB::table('bills')->where('user_id',Auth::user()->id)->get();

        return view('admin.bills.index',compact('bills'));
    }

    public function getFormOne(){
        if(isset($_GET['bill_id'])){
            $bill_id = $_GET['bill_id'];
        }
        
        if(!empty($bill_id)){
            $bill = DB::table('bills')->where('id',$bill_id)->first();
            $discountTypes = DB::table('discount_types')->where('bill_id',$bill_id)->get();
            
            return view('admin.bills.formOne',compact('bill','discountTypes'));
        }else{
            return view('admin.bills.formOne');
        }   
    }

    public function getFormTwo(){
            if(isset($_GET['bill_id'])){
                $bill_id = $_GET['bill_id'];
            }

            if($bill_id){
                $host_guests = DB::table('host_guests')
                        ->where('bill_id',$bill_id)
                        ->get();
                $host =    $host_guests->where('type','host')->first();     
                return view('admin.bills.formTwo',compact('host_guests','host'));
            }else{
                return view('admin.bills.formTwo');
            }   
    }

    public function getFormThree(){
        if(isset($_GET['bill_id'])){
            $bill_id = $_GET['bill_id'];
        }

        if(!empty($bill_id)){
            $bill = DB::table('bills')->where('id',$bill_id)->first();
            
            $host_guests = DB::table('host_guests')->where('bill_id',$bill_id)->get();

            $items = Items::with('itemPurchases')->get();   
           
            return view('admin.bills.formThree',compact('bill','host_guests','items'));
        }
    }

    public function saveFormOne(Request $request){
        //dd($request);
        $types = $request->types;
        $Id = DB::table('bills')->insertGetId([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'default_service' => $request->default_service
        ]);
        
        if(!empty($types[0])){
            foreach($types as $key => $type){
            
                DB::table('discount_types')->insertGetId([
                    'bill_id' => $Id,
                    'type' => $type,
                    'discount' => $request->discount[$key],
                    'full_price' => isset($request->full_price[$key]) ? true : false
                ]);
            }
        }
        return redirect()->route('admin.bill.form.two',['bill_id' => $Id]);
    }

    public function saveFormTwo(Request $request){
        
        $bill_id = $request->bill_id;

        $guests = $request->guest_name;
        
        if(!empty($guests[0])){
            DB::table('host_guests')->insertGetId([
                'bill_id' => $bill_id,
                'type' => 'host',
                'name' => $request->host_name,
                'deposit' => $request->deposit
            ]);
            foreach($guests as $key => $guest){
                DB::table('host_guests')->insertGetId([
                    'bill_id' => $bill_id,
                    'type' => 'guest',
                    'name' => $guest,
                    'deposit' => $request->guest_deposit[$key]
                ]);
            } 
        }

        return redirect()->route('admin.bill.form.three',['bill_id' => $bill_id]);
    }

    public function saveItems(Request $request){
       
        $bill_id = $request->bill_id;
        if(!empty($request->item_description)){

            $discountTypes = DB::table('discount_types')->where('bill_id',$bill_id)->where('type',$request->bill_discount_types)->first();
            if($request->updateItem == "true"){
                $Id = DB::table('items')->where('id',$request->item_id)
                ->update([
                    'item_description' => $request->item_description,
                    'item_price' => $request->item_price,
                    'category' => $request->bill_discount_types,
                    'quantity' => $request->item_discount_quantity,
                    'item_saving' => $discountTypes->discount,
                    'full_price' => $discountTypes->full_price,
                ]);
            }else{
                $Id = DB::table('items')->insertGetId([
                    'bill_id' => $bill_id,
                    'item_description' => $request->item_description,
                    'item_price' => $request->item_price,
                    'category' => $request->bill_discount_types,
                    'quantity' => $request->item_discount_quantity,
                    'item_saving' => $discountTypes->discount,
                    'full_price' => $discountTypes->full_price,
                ]);
            }
            
           
            return redirect()->route('admin.bill.form.three',['bill_id' => $bill_id]);
        }
    }

    public function deleteItems(Request $request){
        if(!empty($request->id)){
            DB::table('items')->where('id',$request->id)->delete();
            return redirect()->back()->with('success','Item Delted');
        }
       
    }

    public function getHostGuest(Request $request){

        if(!empty($request->bill_id)){
    
            $host_guests = DB::table('host_guests')
                    ->where('bill_id',$request->bill_id)
                    ->get();

            return response()->json([
                        'host_guests' => $host_guests,
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

    public function assignItems(Request $request){

        if(!empty($request->bill_id)){
            DB::table('items_purchases')->insertGetId([
                'bill_id' => $request->bill_id,
                'item_id' => $request->assigned_item_id,
                'host_guest_id' => $request->host_guest_id,
                'assigned_quantity' => $request->assigned_quantity,
            ]);
            return redirect()->back();
        }

    }

    public function getHostGuesItems(Request $request){
        if(!empty($request->bill_id) && !empty($request->host_guest_id)){
    
            $host_guests_items = ItemsPurchases::with('getItems')->where('bill_id',$request->bill_id)
                    ->where('host_guest_id',$request->host_guest_id)
                    ->get();

            return response()->json([
                        'data' => $host_guests_items,
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
            DB::table('host_guests')
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
