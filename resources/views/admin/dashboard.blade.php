@extends('admin.layout.layout')

@section('content')
<main class="ml-[280px] pt-24 pb-32 px-8 min-h-screen bg-gray-50/50">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-8">
        <div>
            <p class="text-[11px] font-bold tracking-widest text-[#FF6B35] uppercase mb-1">Overview</p>
            <h2 class="text-3xl font-extrabold text-[#081828]">Dashboard</h2>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <button class="flex-1 sm:flex-none px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-[#081828] hover:bg-gray-50 transition-colors flex items-center justify-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                Last 30 Days
            </button>
            <button class="flex-1 sm:flex-none px-4 py-2.5 bg-[#0d1d2c] text-white rounded-xl text-sm font-semibold hover:bg-[#0d1d2c]/90 transition-all flex items-center justify-center gap-2 shadow-md shadow-[#0d1d2c]/10">
                <span class="material-symbols-outlined text-[18px]">download</span>
                Export Report
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col gap-2 group transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-[#FF6B35] group-hover:bg-[#FF6B35] group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <span class="text-emerald-600 font-bold text-xs bg-emerald-50 px-2 py-1 rounded-lg">+12.5%</span>
            </div>
            <p class="text-[10px] font-bold tracking-wider text-gray-400 mt-2 uppercase">Total Revenue</p>
            <h3 class="text-xl font-black text-[#081828]">Rp {{ number_format(($totalRevenue ?? 0), 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col gap-2 group transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-[#0d1d2c] group-hover:bg-[#0d1d2c] group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
                <span class="text-emerald-600 font-bold text-xs bg-emerald-50 px-2 py-1 rounded-lg">+8.2%</span>
            </div>
            <p class="text-[10px] font-bold tracking-wider text-gray-400 mt-2 uppercase">Total Orders</p>
            <h3 class="text-2xl font-black text-[#081828]">{{ number_format($totalOrders ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col gap-2 group transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">inventory</span>
                </div>
                <span class="text-indigo-600 font-bold text-xs bg-indigo-50 px-2 py-1 rounded-lg">Active</span>
            </div>
            <p class="text-[10px] font-bold tracking-wider text-gray-400 mt-2 uppercase">Total Products</p>
            <h3 class="text-2xl font-black text-[#081828]">{{ $totalProducts ?? 0 }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col gap-2 group transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <span class="text-sky-600 font-bold text-xs bg-sky-50 px-2 py-1 rounded-lg">Users</span>
            </div>
            <p class="text-[10px] font-bold tracking-wider text-gray-400 mt-2 uppercase">Registered Users</p>
            <h3 class="text-2xl font-black text-[#081828]">{{ number_format($totalUsers ?? 0, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-lg font-bold text-[#081828]">Monthly Sales Performance</h4>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#FF6B35]"></span>
                    <span class="text-xs font-semibold text-gray-500">Revenue</span>
                </div>
            </div>
            <div class="h-[280px] w-full flex items-end gap-2 px-2 relative pt-4">
                @php
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $maxRevenue = count($monthlyRevenue ?? []) > 0 ? max($monthlyRevenue) : 1;
                    $maxRevenue = $maxRevenue == 0 ? 1 : $maxRevenue;
                @endphp

                @foreach($months as $index => $monthName)
                    @php
                        $revValue = $monthlyRevenue[$index + 1] ?? 0;
                        $heightPercent = ($revValue / $maxRevenue) * 100;
                        // Jaga batas tinggi minimum visual jika ada nilai agar batang tidak hilang total
                        if($revValue > 0 && $heightPercent < 5) $heightPercent = 5;
                    @endphp
                    <div class="flex-1 {{ $monthName == date('M') ? 'bg-[#FF6B35]' : 'bg-gray-100 hover:bg-[#FF6B35]' }} transition-all duration-500 rounded-t-lg shadow-sm" 
                         style="height: {{ $heightPercent }}%;" 
                         title="{{ $monthName }}: Rp {{ number_format($revValue, 0, ',', '.') }}">
                    </div>
                @endforeach
                
                <div class="absolute -bottom-6 left-0 w-full flex justify-between text-[10px] font-bold text-gray-400 px-1">
                    <span>JAN</span><span>MAR</span><span>MAY</span><span>JUL</span><span>SEP</span><span>NOV</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <h4 class="text-lg font-bold text-[#081828] mb-4">Orders by Status</h4>
            <div class="relative w-40 h-40 mx-auto flex items-center justify-center">
                @php
                    $pDelivered = $statusPercentages['Delivered'] ?? 0;
                    $pProcessing = $statusPercentages['Processing'] ?? 0;
                    $pShipped = $statusPercentages['Shipped'] ?? 0;

                    // Hitung nilai stroke-dashoffset untuk lingkaran SVG (Keliling = 2 * pi * r = 2 * 3.14 * 65 = ~408)
                    $dasharray = 408;
                    $offsetDelivered = $dasharray - ($dasharray * ($pDelivered / 100));
                    $offsetProcessing = $dasharray - ($dasharray * ($pProcessing / 100));
                    $offsetShipped = $dasharray - ($dasharray * ($pShipped / 100));
                @endphp
                <svg class="w-full h-full -rotate-90">
                    <circle class="text-[#0d1d2c]" cx="80" cy="80" fill="transparent" r="65" stroke="currentColor" stroke-dasharray="408" stroke-dashoffset="{{ $offsetDelivered }}" stroke-width="14" stroke-linecap="round"></circle>
                    <circle class="text-[#FF6B35]" cx="80" cy="80" fill="transparent" r="65" stroke="currentColor" stroke-dasharray="408" stroke-dashoffset="{{ $offsetProcessing }}" stroke-width="14" stroke-linecap="round"></circle>
                    <circle class="text-amber-400" cx="80" cy="80" fill="transparent" r="65" stroke="currentColor" stroke-dasharray="408" stroke-dashoffset="{{ $offsetShipped }}" stroke-width="14" stroke-linecap="round"></circle>
                </svg>
                <div class="absolute text-center">
                    <p class="text-2xl font-black text-[#081828]">{{ $totalOrders ?? 0 }}</p>
                    <p class="text-[9px] font-bold tracking-wider text-gray-400">TOTAL</p>
                </div>
            </div>
            <div class="mt-6 space-y-2.5">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#0d1d2c]"></span>
                        <span class="text-gray-500 font-medium">Delivered</span>
                    </div>
                    <span class="font-bold text-[#081828]">{{ round($pDelivered) }}%</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF6B35]"></span>
                        <span class="text-gray-500 font-medium">Processing</span>
                    </div>
                    <span class="font-bold text-[#081828]">`{{ round($pProcessing) }}%`</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        <span class="text-gray-500 font-medium">Shipped</span>
                    </div>
                    <span class="font-bold text-[#081828]">{{ round($pShipped) }}%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-8 overflow-hidden">
        <div class="p-6 flex justify-between items-center border-b border-gray-100">
            <h4 class="text-lg font-bold text-[#081828]">Recent Orders</h4>
            <a href="#" class="text-sm font-bold text-[#FF6B35] hover:underline flex items-center gap-1">
                View All Orders
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3.5 text-[10px] font-bold tracking-wider text-gray-400 uppercase">Order Number</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold tracking-wider text-gray-400 uppercase">Customer</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold tracking-wider text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold tracking-wider text-gray-400 uppercase">Total</th>
                        <th class="px-6 py-3.5 text-[10px] font-bold tracking-wider text-gray-400 uppercase">Date</th>
                        <th class="px-6 py-3.5 w-10"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($recentOrders ?? [] as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-[#FF6B35]">#{{ $order->order_number ?? ($order->id ?? $order->ID) }}</td>
                        <td class="px-6 py-4 font-semibold text-[#081828]">{{ $order->customer_name ?? ($order->user->name ?? 'Guest Customer') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $status = strtolower($order->status ?? ($order->STATUS ?? 'processing'));
                                $badgeClass = 'bg-orange-50 text-orange-700';
                                if($status == 'delivered') $badgeClass = 'bg-emerald-50 text-emerald-700';
                                if($status == 'shipped') $badgeClass = 'bg-amber-50 text-amber-700';
                            @endphp
                            <span class="px-2.5 py-1 rounded-full font-semibold text-xs {{ $badgeClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-bold text-[#081828]">Rp {{ number_format(($order->total_price ?? ($order->TOTAL_PRICE ?? 0)), 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-gray-400">
                            {{ isset($order->created_at) ? \Carbon\Carbon::parse($order->created_at)->format('M d, Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="material-symbols-outlined text-gray-400 hover:text-[#081828] text-[20px]">more_vert</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic">Belum ada transaksi masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex items-center gap-2 mb-5">
                <span class="material-symbols-outlined text-[#FF6B35]">inventory_2</span>
                <h4 class="text-lg font-bold text-[#081828]">Inventory Alerts</h4>
            </div>
            <div class="space-y-3">
                @forelse($lowStockProducts ?? [] as $lowProd)
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="w-12 h-12 bg-white rounded-lg overflow-hidden flex-shrink-0 border border-gray-200 flex items-center justify-center">
                        @if(!empty($lowProd->featured_image))
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $lowProd->featured_image) }}"/>
                        @else
                            <span class="material-symbols-outlined text-gray-300">science</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-[#081828] truncate max-w-[130px]">{{ $lowProd->name }}</p>
                        <p class="text-[10px] font-bold text-red-600 uppercase tracking-wider mt-0.5">Sisa {{ $lowProd->stock }} unit</p>
                    </div>
                    <button class="material-symbols-outlined text-gray-400 hover:text-[#FF6B35] text-[22px]">add_shopping_cart</button>
                </div>
                @empty
                <div class="p-4 text-center bg-gray-50 rounded-xl border border-dashed border-gray-200 text-xs text-gray-400">
                    Stok seluruh parfum aman & stabil.
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex items-center gap-2 mb-5">
                <span class="material-symbols-outlined text-[#081828]">article</span>
                <h4 class="text-lg font-bold text-[#081828]">Editorial Feed</h4>
            </div>
            <div>
                <div class="group cursor-pointer">
                    <div class="aspect-video w-full rounded-xl overflow-hidden mb-2 border border-gray-100 flex items-center justify-center bg-gray-50">
                        <span class="material-symbols-outlined text-4xl text-gray-300">auto_stories</span>
                    </div>
                    <h5 class="font-bold text-sm text-[#081828] group-hover:text-[#FF6B35] transition-colors line-clamp-1">The Science of Scent Preservation</h5>
                    <p class="text-xs text-gray-400 mt-1 line-clamp-2 leading-relaxed">How we ensure the longevity of our pure extracts inside galvalum and aluminum chambers...</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex items-center gap-2 mb-5">
                <span class="material-symbols-outlined text-[#0d1d2c]">payments</span>
                <h4 class="text-lg font-bold text-[#081828]">Recent Transactions</h4>
            </div>
            <div class="space-y-3">
                @forelse($recentOrders ?? [] as $trans)
                <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <span class="material-symbols-outlined text-[20px]">arrow_downward</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-[#081828] truncate max-w-[120px]">Payment Received</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-0.5">Order #{{ $trans->id }}</p>
                        </div>
                    </div>
                    <p class="text-xs font-black text-emerald-600">+Rp {{ number_format(($trans->total_price ?? 0), 0, ',', '.') }}</p>
                </div>
                @empty
                <div class="p-4 text-center text-xs text-gray-400 italic">Belum ada mutasi keuangan.</div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection