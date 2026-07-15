<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('courier_name'); 
            $table->string('service_name'); 
            $table->decimal('cost', 10, 2); 
            $table->string('estimated_time'); 
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('shippings'); }
};