<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];


    public function products(){
       return  $this->belongsToMany(Product::class,table:'order_product_pivot');// belongstomany = belongsto & hasmany 
    }
    public function user(){
       return  $this->belongsTo(User::class);// belongstomany = belongsto & hasmany 
    }
}

