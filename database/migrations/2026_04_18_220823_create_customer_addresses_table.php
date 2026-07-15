<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            
            // Relasi Foreign Key ke tabel customers
            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->onDelete('cascade');
            
            // Detail Komponen Alamat Lengkap
            $table->string('address_label', 50)->default('Rumah'); // e.g., Rumah, Kantor, Kos
            $table->string('recipient_name')->nullable();          // Nama penerima paket (jika beda dari customer)
            $table->string('recipient_phone', 20)->nullable();    // Nomor hp penerima
            $table->text('full_address');                          // Jalan, Blok, No. Rumah
            $table->string('province', 100);
            $table->string('city', 100);
            $table->string('district', 100)->nullable();          // Kecamatan
            $table->string('postal_code', 10);
            $table->boolean('is_default')->default(false);         // Menandai alamat utama pengiriman
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Hapus tabel Alamat
        Schema::dropIfExists('customer_addresses');

        // 2. JARING PENGAMAN ORACLE: Hapus sequence milik tabel customer_addresses
        if (config('database.default') === 'oracle') {
            DB::statement('
                BEGIN 
                    EXECUTE IMMEDIATE \'DROP SEQUENCE CUSTOMER_ADDRESSES_ID_SEQ\'; 
                EXCEPTION 
                    WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; 
                END;
            ');
        }
    }
};