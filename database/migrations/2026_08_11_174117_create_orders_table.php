<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete(); // customer name (user->name) and email as foreign key
            $table->double('amount');
            $table->string('currency')->default('jod');
            $table->string('payment_id')->nullable();
            $table->string('status')->default('pending');

            /*
            
            customer_name
            customer_email
            
            */ 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
