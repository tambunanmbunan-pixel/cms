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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Menghasilkan NUMBER(19,0) / Primary Key di Oracle
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number', 20)->nullable();
            $table->string('gender', 10)->nullable(); // e.g., Male / Female
            $table->string('status', 20)->default('Active'); // Active, Inactive, Suspended
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Hapus tabel Utama
        Schema::dropIfExists('customers');

        // 2. JARING PENGAMAN ORACLE: Hapus sequence milik tabel customers
        if (config('database.default') === 'oracle') {
            DB::statement('
                BEGIN 
                    EXECUTE IMMEDIATE \'DROP SEQUENCE CUSTOMERS_ID_SEQ\'; 
                EXCEPTION 
                    WHEN OTHERS THEN IF SQLCODE != -2289 THEN RAISE; END IF; 
                END;
            ');
        }
    }
};