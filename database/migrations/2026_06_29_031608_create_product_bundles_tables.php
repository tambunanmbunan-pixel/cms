<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_bundles', function (Blueprint $table) {
            $table->string('id', 10)->primary(); // Format: BND-001, BND-002
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2); // Harga paket (lebih murah dari total harga eceran)
            $table->integer('stock')->default(0);
            $table->string('status')->default('active'); // active, inactive
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::create('bundle_product', function (Blueprint $table) {
            $table->id();
            $table->string('bundle_id', 10);
            $table->string('product_id', 10);
            $table->integer('quantity')->default(1);
            $table->timestamps(); 
            $table->foreign('bundle_id')->references('id')->on('product_bundles')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bundle_product');
        Schema::dropIfExists('product_bundles');
    }
};