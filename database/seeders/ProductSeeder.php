<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama dengan aman menggunakan delete() bukan truncate() demi Oracle
        DB::table('products')->delete();

        DB::table('products')->insert([
            [
                'id' => 'PROD-01',
                'name' => 'Obsidian Oud',
                'slug' => Str::slug('Obsidian Oud'), // Hasil: obsidian-oud
                'category_id' => 'cat-03',          // Sesuaikan dengan ID di CategoryTableSeeder Anda
                'price' => 750000,
                'stock' => 50,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'PROD-02',
                'name' => 'Midnight Azure',
                'slug' => Str::slug('Midnight Azure'), // Hasil: midnight-azure
                'category_id' => 'cat-02',            // Sesuaikan dengan ID di CategoryTableSeeder Anda
                'price' => 680000,
                'stock' => 45,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}