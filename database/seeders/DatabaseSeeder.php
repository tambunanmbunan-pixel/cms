<?php

namespace Database\Seeders;

use App\Models\User; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jaring Pengaman User Default (Mencegah ORA-00001 pada UK Email)
        if (DB::table('users')->where('email', 'user@example.com')->doesntExist()) {
            User::create([
                'name' => 'Test User',
                'email' => 'user@example.com',
                'password' => Hash::make('123456'),
            ]);
        }

        // 2. Jalankan seeder admin & kategori terlebih dahulu (Tabel Parent)
        $this->call([
            AdminTableSeeder::class,
            CategoryTableSeeder::class,
            ProductSeeder::class,
        ]);

        

        // 4. Seed Data Kurir (Menggunakan updateOrInsert agar tidak duplikat)
        $couriers = [
            [
                'courier_name' => 'JNE Express',
                'service_name' => 'Reguler',
                'cost' => 15000.00,
                'estimated_time' => '2-3 Days',
                'status' => 'active'
            ],
            [
                'courier_name' => 'J&T Super',
                'service_name' => 'Next Day Service',
                'cost' => 30000.00,
                'estimated_time' => '1 Day',
                'status' => 'active'
            ],
            [
                'courier_name' => 'POS Indonesia',
                'service_name' => 'Kilat Khusus',
                'cost' => 12000.00,
                'estimated_time' => '3-5 Days',
                'status' => 'active'
            ]
        ];

        foreach ($couriers as $courier) {
            DB::table('shippings')->updateOrInsert(
                [
                    'courier_name' => $courier['courier_name'],
                    'service_name' => $courier['service_name']
                ],
                array_merge($courier, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }

        // 5. Seed Arsitektur Metode Pembayaran & Turunannya (Payment Channels)
        if (DB::table('payment_methods')->where('code', 'bank_transfer')->doesntExist()) {
            
            // A. Insert Induk Metode Pembayaran
            $codId = DB::table('payment_methods')->insertGetId([
                'name' => 'COD (Bayar di Tempat)', 
                'code' => 'cod', 
                'status' => 'active', 
                'created_at' => now(), 
                'updated_at' => now()
            ]);
            
            $bankId = DB::table('payment_methods')->insertGetId([
                'name' => 'Bank Transfer', 
                'code' => 'bank_transfer', 
                'status' => 'active', 
                'created_at' => now(), 
                'updated_at' => now()
            ]);
            
            $mitraId = DB::table('payment_methods')->insertGetId([
                'name' => 'Bayar Tunai di Mitra', 
                'code' => 'mitra', 
                'status' => 'active', 
                'created_at' => now(), 
                'updated_at' => now()
            ]);
            
            $qrisId = DB::table('payment_methods')->insertGetId([
                'name' => 'QRIS (E-Wallet)', 
                'code' => 'qris', 
                'status' => 'active', 
                'created_at' => now(), 
                'updated_at' => now()
            ]);

            // B. Insert Anak Turunan (Payment Channels) Mengunci ID Induk
            DB::table('payment_channels')->insert([
                // Turunan Kelompok Bank Transfer
                [
                    'payment_method_id' => $bankId, 
                    'name' => 'BNN Transfer', 
                    'code' => 'bnn', 
                    'account_number' => '8465123900', 
                    'account_name' => 'Hanah Luxury Fragrance', 
                    'status' => 'active', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ],
                [
                    'payment_method_id' => $bankId, 
                    'name' => 'Mandi Bill', 
                    'code' => 'mandi', 
                    'account_number' => '1370022445566', 
                    'account_name' => 'Hanah Luxury Fragrance', 
                    'status' => 'active', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ],
                [
                    'payment_method_id' => $bankId, 
                    'name' => 'BII Virtual Account', 
                    'code' => 'bii', 
                    'account_number' => '98800123456789', 
                    'account_name' => 'Hanah Luxury', 
                    'status' => 'active', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ],
                
                // Turunan Kelompok Gerai Retail / Mitra
                [
                    'payment_method_id' => $mitraId, 
                    'name' => 'Alpaa', 
                    'code' => 'alpaa', 
                    'account_number' => '77010922831', 
                    'account_name' => 'HANAH OUD', 
                    'status' => 'active', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ],
                [
                    'payment_method_id' => $mitraId, 
                    'name' => 'indomay / Ceria Mart', 
                    'code' => 'indomay', 
                    'account_number' => '33041922832', 
                    'account_name' => 'HANAH OUD', 
                    'status' => 'active', 
                    'created_at' => now(), 
                    'updated_at' => now()
                ],
            ]);
        }
    }
}