@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('shippings.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">SHIPPING</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">METHOD SPECIFICATIONS</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Courier Service Details</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Spesifikasi logistik data kurir aktif dari database Oracle.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('shippings.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant hover:text-primary rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span><span>Kembali</span>
            </a>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 p-8 max-w-2xl space-y-6">
        <div class="flex items-center gap-4 border-b border-gray-100 pb-4">
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">local_shipping</span>
            </div>
            <div>
                <h4 class="text-lg font-black text-primary uppercase">{{ $shipping->courier_name }}</h4>
                <p class="text-xs text-on-surface-variant">Layanan: {{ $shipping->service_name }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="p-4 bg-gray-50/50 rounded-xl border">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Tarif Biaya</p>
                <p class="text-lg font-black text-primary mt-1">Rp {{ number_format($shipping->cost, 0, ',', '.') }}</p>
            </div>
            <div class="p-4 bg-gray-50/50 rounded-xl border">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Estimasi Pengiriman</p>
                <p class="text-lg font-black text-primary mt-1">{{ $shipping->estimated_time }}</p>
            </div>
        </div>

        <div class="space-y-2 text-xs pt-2 border-t">
            <div class="flex justify-between"><span class="text-on-surface-variant">Status Sistem:</span><span class="font-bold text-primary uppercase">{{ $shipping->status }}</span></div>
            <div class="flex justify-between"><span class="text-on-surface-variant">Daftar Pada:</span><span class="text-primary font-medium">{{ $shipping->created_at->format('M d, Y - H:i') }}</span></div>
        </div>
    </div>
</main>
@endsection