<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts_items', function (Blueprint $table) {
            // 1. Buat product_id menjadi nullable karena item bisa berupa bundle
            $table->string('product_id', 10)->nullable()->change();

            // 2. Tambahkan kolom bundle_id (nullable) untuk menampung key string paket bundle
            $table->string('bundle_id', 10)->nullable()->after('product_id');

            // 3. Deklarasi Constraint Foreign Key ke tabel product_bundles
            $table->foreign('bundle_id')->references('id')->on('product_bundles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('carts_items', function (Blueprint $table) {
            $table->dropForeign(['bundle_id']);
            $table->dropColumn('bundle_id');
            $table->string('product_id', 10)->nullable(false)->change();
        });
    }
};