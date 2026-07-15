@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-gray-100 pb-5">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('orders.index') }}" class="hover:text-primary transition-colors uppercase">ORDERS</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">INVOICE DETAILS</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Invoice #{{ $order->order_number }}</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Struktur taksasi kuantitas item produk ritel tunggal beserta logistik pemenuhan kurir.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('orders.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant hover:text-primary rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span><span>Kembali</span>
            </a>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl luxury-shadow border border-outline-variant/10 overflow-hidden">
                <div class="px-8 py-4 border-b bg-surface-container-low/40 font-bold text-primary text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">shopping_bag</span>
                    <span>Purchased Items Listing</span>
                </div>
                
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-xs uppercase text-on-surface-variant tracking-wider border-b">
                            <th class="px-8 py-3 font-bold">Product Variant</th>
                            <th class="px-6 py-3 font-bold text-center">Qty</th>
                            <th class="px-6 py-3 font-bold">Unit Price</th>
                            <th class="px-8 py-3 font-bold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                            <tr class="hover:bg-gray-50/40 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-surface-container rounded-lg flex items-center justify-center text-primary border shrink-0">
                                            <span class="material-symbols-outlined text-base">science</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-primary">{{ $item->product->name ?? 'Unknown Product' }}</p>
                                            <p class="text-[10px] font-mono text-gray-400">ID: {{ $item->product_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-mono font-bold text-primary text-xs">
                                    {{ $item->quantity }} Pcs
                                </td>
                                <td class="px-6 py-4 font-medium text-on-surface-variant">
                                    Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}
                                </td>
                                <td class="px-8 py-4 text-right font-bold text-primary">
                                    Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                    <tfoot class="bg-gray-50/50 border-t font-semibold">
                        <tr>
                            <td colspan="3" class="px-8 py-2.5 text-xs text-on-surface-variant uppercase text-right">Subtotal Harga Produk:</td>
                            <td class="px-8 py-2.5 text-right text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-8 py-2.5 text-xs text-on-surface-variant uppercase text-right">Ongkos Kirim Logistik ({{ $order->shipping->courier_name ?? 'Courier' }}):</td>
                            <td class="px-8 py-2.5 text-right text-primary">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-primary/[0.02] border-t-2">
                            <td colspan="3" class="px-8 py-3.5 text-sm font-bold text-primary uppercase text-right">Grand Total Akumulasi:</td>
                            <td class="px-8 py-3.5 text-right text-base font-black text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="bg-white rounded-xl luxury-shadow border border-outline-variant/10 p-6 space-y-3">
                <h4 class="text-xs font-bold text-primary uppercase tracking-wider border-b pb-2 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">pin_drop</span>
                    <span>Shipping Address Location</span>
                </h4>
                <p class="text-sm text-on-surface-variant leading-relaxed font-medium whitespace-pre-line bg-gray-50/60 p-4 rounded-xl border border-dashed">
                    {{ $order->shipping_address }}
                </p>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl luxury-shadow border border-outline-variant/10 p-6 space-y-4">
                <h4 class="text-xs font-bold text-primary uppercase tracking-wider border-b pb-2">Order Action Controller</h4>
                
                <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-4">
                    @csrf 
                    @method('PUT') <div>
                        <label class="block text-[11px] font-bold text-on-surface-variant uppercase tracking-wide mb-1.5">Ubah Status Alur Proses</label>
                        <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-outline-variant/40 text-xs font-bold focus:ring-0 focus:border-primary cursor-pointer bg-gray-50/50">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing (Diproses)</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-primary text-white font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 hover:bg-primary/90 transition-all active:scale-95 shadow-sm cursor-pointer">
                        <span class="material-symbols-outlined text-sm">published_with_changes</span>
                        <span>Update Order Status</span>
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl luxury-shadow border border-outline-variant/10 p-6 space-y-4">
                <h4 class="text-xs font-bold text-primary uppercase tracking-wider border-b pb-2">Customer Credentials</h4>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary/5 text-primary border rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-lg">person</span>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-primary truncate">{{ $order->customer->name ?? 'Guest Client' }}</p>
                        <p class="text-[11px] text-gray-400 truncate">{{ $order->customer->email ?? '-' }}</p>
                    </div>
                </div>
                <div class="space-y-2 text-xs pt-2 border-t text-on-surface-variant">
                    <div class="flex justify-between"><span>No. Telepon:</span><span class="font-medium text-primary">{{ $order->customer->phone_number ?? '-' }}</span></div>
                    <div class="flex justify-between"><span>Jenis Kelamin:</span><span class="font-medium text-primary">{{ $order->customer->gender ?? '-' }}</span></div>
                    <div class="flex justify-between"><span>Status Akun:</span><span class="font-bold text-primary uppercase">{{ $order->customer->status ?? 'Active' }}</span></div>
                </div>
            </div>
        </div>
        
    </div>
</main>
@endsection