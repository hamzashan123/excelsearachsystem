<?php

namespace App;
use App\ItemsPurchases;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    public function itemPurchases(){

        return $this->hasMany('App\ItemsPurchases', 'item_id','id');
    }

    // public function discountTypes(){
    //     return $this->hasOne('App\DiscountTypes', 'id','bill_id');
    // }
}
