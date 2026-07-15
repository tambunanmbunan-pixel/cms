@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <span class="hover:text-primary cursor-pointer transition-colors uppercase">TRANSACTIONS</span>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">INCOMING ORDERS</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Customer Orders</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Pantau invoice masuk, status pembayaran, dan kelayakan pengiriman paket produk.</p>
        </div>
    </section>

    @if(session('success_message'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('success_message') }}
        </div>
    @endif

    <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10">
        <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between bg-gray-50/20">
            <div class="flex items-center gap-4">
                <span class="font-title-sm text-title-sm text-primary font-bold">Sales Transaction Log</span>
                <span class="px-2 py-0.5 bg-surface-container text-on-surface-variant rounded-full text-[10px] font-bold uppercase">{{ $orders->count() }} Invoices</span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50 text-xs uppercase tracking-wider text-on-surface-variant">
                        <th class="px-8 py-4 font-bold border-b border-outline-variant/10">Invoice No.</th>
                        <th class="px-6 py-4 font-bold border-b border-outline-variant/10">Customer Details</th>
                        <th class="px-6 py-4 font-bold border-b border-outline-variant/10">Date Order</th>
                        <th class="px-6 py-4 font-bold border-b border-outline-variant/10">Grand Total</th>
                        <th class="px-6 py-4 font-bold border-b border-outline-variant/10 text-center">Status</th>
                        <th class="px-8 py-4 font-bold border-b border-outline-variant/10 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10 text-sm">
                    @forelse($orders as $order)
                        <tr data-href="{{ route('orders.show', $order->id) }}" 
                            class="order-row hover:bg-surface-container-low transition-colors group cursor-pointer select-none">
                            <td class="px-8 py-5 font-mono text-xs font-bold text-primary tracking-wide">
                                #{{ $order->order_number }}
                            </td>
                            <td class="px-6 py-5">
                                <p class="font-bold text-primary">{{ $order->customer->name ?? 'Guest User' }}</p>
                                <p class="text-[11px] text-on-surface-variant/70">{{ $order->customer->email ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-5 text-on-surface-variant text-xs font-medium">
                                {{ $order->created_at->format('M d, Y — H:i') }}
                            </td>
                            <td class="px-6 py-5 font-bold text-primary text-sm">
                                Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider border {{ $order->getStatusColor() }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right action-area">
                                <a href="{{ route('orders.show', $order->id) }}" 
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-surface-container hover:bg-primary hover:text-white border border-outline-variant/30 text-on-surface-variant text-xs font-bold rounded-xl transition-all duration-150 shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                                    <span>Review</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center text-on-surface-variant text-sm italic">
                                <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300">receipt_long</span>
                                Belum ada riwayat order transaksi masuk dari customer di database Oracle.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Navigasi baris tabel menuju halaman detail invoice
        document.querySelectorAll('.order-row').forEach(row => {
            row.addEventListener('click', function(e) {
                if (!e.target.closest('.action-area')) {
                    const url = this.getAttribute('data-href');
                    if (url) window.location.href = url;
                }
            });
        });
    });
</script>
@endsection