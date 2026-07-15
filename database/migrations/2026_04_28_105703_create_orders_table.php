<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('shipping_id')->nullable()->constrained('shippings')->onDelete('set null');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->foreignId('payment_channel_id')->nullable()->constrained('payment_channels')->onDelete('set null');
            $table->string('order_number')->unique();
            $table->decimal('total_price', 15, 2);   
            $table->decimal('shipping_cost', 10, 2)->default(0); 
            $table->decimal('grand_total', 15, 2);   
            $table->string('status', 30)->default('pending');
            $table->text('shipping_address'); 
            $table->timestamps();
        });
    }

    public function down(): void { 
        Schema::dropIfExists('orders'); 
    }
};