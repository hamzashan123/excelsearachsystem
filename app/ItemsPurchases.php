<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsPurchases extends Model
{
    protected $table = 'items_purchases';

    public function getItems(){
        return $this->hasOne('App\Items', 'id','item_id');
    }
}
