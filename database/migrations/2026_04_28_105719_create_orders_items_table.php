<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('product_id', 10);
            $table->integer('quantity');
            $table->decimal('price_at_purchase', 15, 2); 
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('orders_items'); }
};