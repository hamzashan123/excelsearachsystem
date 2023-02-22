<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostGuest extends Model
{
    protected $table = 'host_guests';

    public function hostGuestPurchases(){

        return $this->hasMany('App\ItemsPurchases', 'host_guest_id','id');
    
    }
}
