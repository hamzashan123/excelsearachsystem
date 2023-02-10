<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        dd($request->type);
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

        if(count($types) > 0){
            foreach($types as $key => $type){
                DB::table('hosts')->insertGetId([
                    'bill_id' => $Id,
                    'type' => $type,
                    'discount' => $request->discount[$key]
                ]);
            }
            
        }
        
        return redirect()->route('admin.bills.index');
        
    }
}
