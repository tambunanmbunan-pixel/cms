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
        Schema::create('product_details', function (Blueprint $table) {
            // product_id menjadi Primary Key sekaligus Foreign Key (One-to-One Relation)
            $table->string('product_id', 10)->primary();
            
            // Kolom Khusus Olfactory Notes (Tampilan Utama Tiga Kotak di Form Detail)
            $table->string('top_notes')->nullable();    // Contoh: "Bergamot, Lemon Zest, Fresh Mint"
            $table->string('heart_notes')->nullable();  // Contoh: "Lavender, Geranium, Sea Salt"
            $table->string('base_notes')->nullable();   // Contoh: "Amberwood, Patchouli, Oakmoss"
            
            // Kolom Naratif Tambahan (Paragraf Panjang di Bawah Notes)
            $table->text('atmospheric_narrative')->nullable(); 

            // Atribut Spesifikasi Kotak Kanan (Product Details Grid)
            $table->string('longevity')->nullable();     // Contoh: "8-10 Hours"
            $table->string('concentration')->nullable(); // Contoh: "20% Pure Oil"
            $table->string('volume')->nullable();        // Contoh: "100ml / 3.4 fl. oz"
            $table->string('suitable_for')->nullable();  // Contoh: "Day & Evening"
            
            $table->timestamps();

            // Relasi ikat mati ke tabel products utama
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};