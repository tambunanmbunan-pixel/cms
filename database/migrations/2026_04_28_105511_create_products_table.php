<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 10)->primary(); 
            $table->string('category_id', 10)->nullable();
            $table->string('fragrance_type_id', 10)->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->decimal('price', 15, 2);
            $table->integer('stock');
            $table->string('status');
            $table->string('featured_image')->nullable();
            $table->timestamps();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null');
            $table->foreign('fragrance_type_id')
                  ->references('id')
                  ->on('fragrance_types')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};