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
       Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('payment_method'); // e.g., Midtrans, Xendit, Manual
            $table->string('payment_channel')->nullable(); // e.g., GoPay, Mandiri VA, Alfamart
            $table->decimal('amount', 12, 2); // Nominal transaksi (Mendukung angka besar)
            $table->string('payment_status', 30)->default('pending'); // pending, settlement, deny, expire
            $table->string('transaction_id')->unique()->nullable(); // ID Transaksi resmi dari Midtrans/Xendit
            $table->text('raw_response')->nullable(); // Jaring pengaman penyimpan JSON Webhook
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};