<?php

namespace App\Models;
use Database\Factories\ProductFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{

   use HasFactory;
    protected $guarded = [];



    public function Orders(){
        
        return $this->belongsToMany(Order::class,table:'order_product_pivot');

    }
    public function Category(){
        
        return $this->belongsTo(Category::class);

    }





    }
