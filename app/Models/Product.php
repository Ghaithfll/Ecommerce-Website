<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = [];



    public function Orders(){
        
        return $this->belongsToMany(Order::class,table:'order_product_pivot');

    }





    }
