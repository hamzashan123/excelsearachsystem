<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaser extends Model
{
    protected $table = 'purchaser';

    protected $fillable = ['customer_name','part_number','purchase_date','cost','quantity',
    'manufacturer','status','selling_price','currency','tracking_number','description','notes','expected_delivery','purchase_method'
    ];
}
