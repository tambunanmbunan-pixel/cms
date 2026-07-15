
<main class="pt-32 pb-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="flex justify-center mb-16">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 opacity-50">
                <span class="w-8 h-8 rounded-full border border-primary flex items-center justify-center font-label-md text-primary bg-primary-fixed">1</span>
                <span class="font-label-md text-label-md text-primary">Shipping</span>
            </div>
            <div class="w-12 h-px bg-outline-variant opacity-50"></div>
            <div class="flex items-center gap-2 opacity-50">
                <span class="w-8 h-8 rounded-full border border-primary flex items-center justify-center font-label-md text-primary bg-primary-fixed">2</span>
                <span class="font-label-md text-label-md text-primary">Payment</span>
            </div>
            <div class="w-12 h-px bg-outline-variant"></div>
            <div class="flex items-center gap-2">
                <span class="w-8 h-8 rounded-full border-2 border-secondary-container flex items-center justify-center font-label-md text-secondary animate-pulse">3</span>
                <span class="font-label-md text-label-md text-secondary uppercase tracking-wider font-bold">Awaiting Payment</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        <div class="lg:col-span-8 space-y-8">
            <section class="bg-surface-container-low p-10 rounded-xl border border-outline-variant/10 shadow-sm">
                <div class="flex flex-col items-center text-center max-w-xl mx-auto space-y-4">
                    <span class="material-symbols-outlined text-[64px] text-secondary-container animate-spin" style="font-variation-settings: 'wght' 200; animation-duration: 4s;">hourglass_top</span>
                    <h1 class="font-headline-lg text-headline-lg text-primary">Order Placed & Awaiting Payment</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">
                        Thank you for choosing Hanah. Your order <strong class="text-primary">#{{ $order->order_number }}</strong> has been successfully registered. 
                        Status saat ini: <span class="px-2 py-0.5 bg-secondary-container/10 text-secondary text-xs font-bold rounded uppercase tracking-wide">{{ str_replace('_', ' ', $order->status) }}</span>.
                    </p>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                <div class="bg-white p-8 rounded-xl border border-outline-variant/10 shadow-sm space-y-6 card-interactive">
                    <div class="flex items-center gap-3 border-b border-outline-variant/10 pb-4">
                        <span class="material-symbols-outlined text-secondary">
                            @if($order->method_code == 'cod') local_shipping
                            @elseif($order->method_code == 'bank_transfer') account_balance
                            @elseif($order->method_code == 'mitra') store
                            @else wallet
                            @endif
                        </span>
                        <h2 class="font-label-md text-label-md text-primary uppercase font-bold tracking-wider">Detail Pembayaran ({{ $order->method_name }})</h2>
                    </div>
                    
                    <div class="space-y-4">
                        @if($order->method_code == 'cod')
                            <div class="p-4 bg-surface-container-low rounded-lg border border-outline-variant/20">
                                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider mb-1">Informasi COD</p>
                                <p class="text-sm text-primary leading-relaxed">Silakan siapkan uang tunai sebesar pas sesuai total tagihan saat kurir pengantar tiba di alamat Anda.</p>
                            </div>
                        @elseif($order->method_code == 'qris')
                            <div class="p-4 bg-white rounded-lg border border-outline-variant/20 flex flex-col items-center text-center space-y-2">
                                <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Scan QRIS Standar</p>
                                <div class="w-40 h-40 bg-surface-container-highest flex items-center justify-center font-bold text-xs text-primary rounded border border-outline-variant">
                                    [ QRIS BARCODE DUMMY ]
                                </div>
                                <p class="text-[11px] text-on-surface-variant/80">Gunakan GoPay, OVO, Dana, LinkAja, atau Mobile Banking Anda.</p>
                            </div>
                        @else
                            <div class="group flex justify-between items-end p-3 hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer" onclick="copyToClipboard('{{ $order->account_name ?? 'Hanah Luxury Fragrance' }}')">
                                <div>
                                    <p class="font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Atas Nama / Merchant</p>
                                    <p class="font-body-lg text-primary font-medium">{{ $order->account_name ?? 'Hanah Luxury Fragrance' }}</p>
                                </div>
                                <span class="material-symbols-outlined text-on-surface-variant/40 group-hover:text-secondary transition-colors text-sm">content_copy</span>
                            </div>
                            
                            <div class="group flex justify-between items-end p-3 hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer" onclick="copyToClipboard('{{ $order->channel_name }}')">
                                <div>
                                    <p class="font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Pilihan Saluran</p>
                                    <p class="font-body-lg text-primary font-medium">{{ $order->channel_name }}</p>
                                </div>
                                <span class="material-symbols-outlined text-on-surface-variant/40 group-hover:text-secondary transition-colors text-sm">content_copy</span>
                            </div>

                            @if($order->account_number)
                            <div class="group flex justify-between items-end p-4 bg-secondary-container/5 border border-secondary-container/20 rounded-lg transition-colors cursor-pointer mt-4" onclick="copyToClipboard('{{ $order->account_number }}')">
                                <div>
                                    <p class="font-label-md text-[11px] text-secondary uppercase tracking-widest">Nomor Rekening / Kode Bayar</p>
                                    <p class="font-headline-md text-primary font-bold tracking-tight text-xl font-mono">{{ $order->account_number }}</p>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <span class="material-symbols-outlined text-secondary text-sm">content_copy</span>
                                    <span class="text-[9px] text-secondary font-bold tracking-wider">COPY</span>
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="bg-primary text-white p-8 rounded-xl shadow-lg space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <h2 class="font-headline-md text-white tracking-tight text-xl font-bold">How to Pay</h2>
                        <ul class="space-y-4 text-sm">
                            <li class="flex gap-3">
                                <span class="w-5 h-5 rounded-full bg-secondary-container text-white flex-shrink-0 flex items-center justify-center text-[11px] font-bold">1</span>
                                <p class="text-surface-variant/90">Buka aplikasi m-banking portal atau kunjungi gerai mitra terdekat.</p>
                            </li>
                            <li class="flex gap-3">
                                <span class="w-5 h-5 rounded-full bg-secondary-container text-white flex-shrink-0 flex items-center justify-center text-[11px] font-bold">2</span>
                                <p class="text-surface-variant/90">Masukkan detail nomor rekening atau kode pembayaran tepat sesuai info di samping.</p>
                            </li>
                            <li class="flex gap-3">
                                <span class="w-5 h-5 rounded-full bg-secondary-container text-white flex-shrink-0 flex items-center justify-center text-[11px] font-bold">3</span>
                                <p class="text-surface-variant/90">Pastikan nominal transfer sama persis hingga digit terakhir Rp {{ number_format($order->grand_total, 0, ',', '.') }}.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-4 border-t border-surface-variant/10">
                        <p class="text-[11px] text-surface-variant/60 italic">Pesanan diverifikasi otomatis secara real-time dalam waktu 2-4 jam.</p>
                    </div>
                </div>
            </section>

            <div class="flex items-start gap-4 p-6 bg-surface-container rounded-lg border border-outline-variant/20">
                <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
                <div>
                    <p class="font-label-md text-primary uppercase mb-1 font-bold tracking-wider text-xs">Alamat Tujuan Pengiriman</p>
                    <p class="font-body-md text-on-surface-variant text-sm leading-relaxed">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>

        <aside class="lg:col-span-4 sticky top-28 space-y-6">
            <div class="bg-white p-8 rounded-xl border border-outline-variant/10 shadow-sm space-y-6 card-interactive">
                <h3 class="font-headline-md text-primary border-b border-outline-variant/10 pb-3 font-bold text-lg">Ringkasan Pesanan</h3>
                
                <div class="space-y-4">
                    @foreach($orderItems as $item)
                    <div class="flex gap-4 items-center">
                        <div class="w-16 h-16 bg-surface-container rounded-lg overflow-hidden flex-shrink-0 border border-outline-variant/20">
                            <img class="w-full h-full object-cover" src="{{ asset('admin/images/products/' . $item->featured_image) }}" onerror="this.src='{{ asset('admin/images/products/default.jpg') }}'"/>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-sm text-primary truncate">{{ $item->product_name }}</p>
                            <p class="font-body-md text-on-surface-variant text-xs">{{ $item->quantity }} pcs x Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="space-y-2.5 pt-4 border-t border-outline-variant/10 text-xs font-medium">
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Subtotal Barang</span>
                        <span class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Ongkos Kirim</span>
                        <span class="font-bold text-primary">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-3 flex justify-between items-center border-t border-primary/10 mt-3">
                        <span class="text-sm text-primary font-bold">Total Pembayaran</span>
                        <span class="text-lg font-bold text-secondary font-mono">
                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="space-y-3 pt-2">
                    <a href="{{ route('front.home') }}" class="w-full py-3.5 bg-primary text-white font-button text-xs font-bold uppercase tracking-widest rounded-full hover:bg-primary-container transition-all shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                        Kembali Ke Beranda
                        <span class="material-symbols-outlined text-[16px]">trending_flat</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>
</main>

<div class="fixed bottom-10 left-1/2 -translate-x-1/2 bg-primary text-white px-6 py-3 rounded-full shadow-2xl transition-all translate-y-20 opacity-0 pointer-events-none z-[100] flex items-center gap-2 border border-secondary-container/30" id="toast">
    <span class="material-symbols-outlined text-secondary-container">check_circle</span>
    <span class="font-label-md text-xs" id="toast-text">Berhasil disalin ke clipboard</span>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            const toast = document.getElementById('toast');
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 2500);
        });
    }
</script>
