<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('code', 30)->unique();
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });

        Schema::create('payment_channels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');
            $table->string('name', 100); 
            $table->string('code', 50); 
            $table->string('account_number', 50)->nullable(); 
            $table->string('account_name', 100)->nullable();  
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_channels');
        Schema::dropIfExists('payment_methods');
    }
};