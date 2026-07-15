<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            // Parameter 1: Kunci pencarian (apakah email ini sudah ada?)
            ['email' => 'tambunanmbunan@gmail.com'], 

            // Parameter 2: Data yang akan diisi atau diperbarui
            [
                'name'     => 'Admin',
                'role'     => 'admin',
                'mobile'   => '089527602898',
                'status'   => '1',
                'password' => Hash::make('123456'),
            ]
        );
    

    }
}
