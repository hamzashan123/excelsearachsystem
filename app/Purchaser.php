<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaser extends Model
{
    protected $table = 'purchaser';

    protected $fillable = ['purchase_date','date_recieved','order_number','part_number','manufacturer','cost',
    'purchased_from','purchase_method','quantity','quantity_recieved','quantity_missing','status','quality','selling_price','description'
    ,'serial_number','tracking_number','currency','company_purchased_from','notes','expected_delivery'
    ];
}
