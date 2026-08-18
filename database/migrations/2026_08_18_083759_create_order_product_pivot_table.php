<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Order;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product_pivot', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Product::class);
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('total');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product_pivot');
    }
};
