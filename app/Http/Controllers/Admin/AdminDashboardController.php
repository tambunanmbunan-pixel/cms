<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil hitungan core statistik data murni
        // Sesuaikan dengan data status 'Active' atau 'active' di database Anda
        $totalProducts = Product::whereRaw('LOWER(status) = ?', ['active'])->count();
        $totalUsers = DB::table('users')->count(); // Ganti jika menggunakan tabel kustom/oracle murni
        
        // 2. Transaksi & Finansial (Hanya mengambil yang lunas/sukses jika ada kolom status transaksi)
        $totalOrders = DB::table('orders')->count();
        $totalRevenue = DB::table('orders')->sum('total_price');

        // 3. Peringatan Stok Kritis (Stok di bawah atau sama dengan 5 unit)
        $lowStockProducts = Product::where('stock', '<=', 5)
                                   ->whereRaw('LOWER(status) = ?', ['active'])
                                   ->take(3)
                                   ->get();

        // 4. Daftar Riwayat Transaksi Terbaru
        $recentOrders = DB::table('orders')
                            ->orderBy('id', 'desc')
                            ->take(5)
                            ->get();

        // 5. Hitung Grafik Batang Bulanan (Khusus Oracle Grouping Bulan)
        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[$m] = 0; // Set default 0 agar chart tidak timpang kosong
        }

        // Ambil data penjualan tahunan dikelompokkan per-bulan
        $salesData = DB::table('orders')
            ->select(DB::raw('EXTRACT(MONTH FROM created_at) as bulan'), DB::raw('SUM(total_price) as total'))
            ->whereRaw("EXTRACT(YEAR FROM created_at) = ?", [date('Y')])
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->get();

        foreach ($salesData as $data) {
            // Mengatasi jika nama properti bertransformasi menjadi kapital saat dibaca Oracle
            $bulanIdx = $data->bulan ?? ($data->BULAN ?? null);
            $totalNilai = $data->total ?? ($data->TOTAL ?? 0);
            if ($bulanIdx) {
                $monthlyRevenue[(int)$bulanIdx] = (float)$totalNilai;
            }
        }

        // 6. Hitung Distribusi Status Pesanan untuk Chart Lingkaran
        $statusPercentages = ['Delivered' => 0, 'Processing' => 0, 'Shipped' => 0];
        if ($totalOrders > 0) {
            $statusCounts = DB::table('orders')
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

            foreach ($statusCounts as $sc) {
                $stName = ucfirst(strtolower($sc->status ?? ($sc->STATUS ?? '')));
                $stTotal = $sc->total ?? ($sc->TOTAL ?? 0);
                if (array_key_exists($stName, $statusPercentages)) {
                    $statusPercentages[$stName] = ($stTotal / $totalOrders) * 100;
                }
            }
        }

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'lowStockProducts',
            'recentOrders',
            'monthlyRevenue',
            'statusPercentages'
        ));
    }
}