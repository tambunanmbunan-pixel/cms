<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        // GANTI TRUNCATE MENJADI DELETE
        // Ini akan menghapus isi tabel tanpa merusak Foreign Key
        Category::query()->delete();

        // Gunakan updateOrCreate agar seeder ini 'idempotent' (bisa dijalankan berkali-kali tanpa error)
        $categories = [
            ['id' => 'cat-01', 'name' => 'Eau de Parfum', 'slug' => 'eau-de-parfum'],
            ['id' => 'cat-02', 'name' => 'Citrus & Fresh', 'slug' => 'citrus-fresh'],
            ['id' => 'cat-03', 'name' => 'Oud & Woods', 'slug' => 'oud-woods'],
            ['id' => 'cat-04', 'name' => 'Floral Collection', 'slug' => 'floral-collection'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['id' => $cat['id']], $cat);
        }
    }
}