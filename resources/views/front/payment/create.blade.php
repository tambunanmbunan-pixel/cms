@extends('front.layout.layout')

@section('content')
<main class="pt-32 pb-section-gap px-margin-mobile md:px-margin-desktop max-w-2xl mx-auto">
    <div class="text-center mb-10">
        <span class="material-symbols-outlined text-5xl text-warning bg-warning/10 p-4 rounded-full mb-3">pending_actions</span>
        <h1 class="font-headline-lg text-2xl md:text-3xl text-primary font-bold">Selesaikan Pembayaran</h1>
        <p class="text-sm text-on-surface-variant mt-1">Segera transfer sebelum batas waktu transaksi Anda habis.</p>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-sm space-y-6">
        <div class="flex justify-between items-center border-b border-outline-variant/10 pb-4">
            <div>
                <p class="text-xs text-on-surface-variant/60 font-bold uppercase">Nomor Pesanan</p>
                <p class="font-mono font-bold text-primary text-base">{{ $payment->order_number }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-on-surface-variant/60 font-bold uppercase">Total Tagihan</p>
                <p class="font-bold text-secondary text-lg">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-surface p-5 rounded-xl border border-outline-variant/10 text-center space-y-2">
            <p class="text-xs font-bold text-on-surface-variant/70 uppercase tracking-wider">Metode: {{ $payment->payment_channel }}</p>
            <p class="text-2xl font-mono font-bold text-primary tracking-wider bg-surface-container-high py-2 rounded-lg border border-outline-variant/20">
                123-000456-7890
            </p>
            <p class="text-xs text-on-surface-variant">Atas Nama: <strong class="text-primary">PT. Hanah Luxury Fragrance</strong></p>
        </div>

        @if($payment->status == 'menunggu_pembayaran' || $payment->status == 'pending')
            <div class="p-4 border border-dashed border-orange-400 bg-orange-50/50 rounded-xl">
                <form action="{{ route('front.payment.simulate_profile_pay', $payment->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold uppercase tracking-wider rounded-lg transition-colors cursor-pointer text-center block">
                        Simulasikan Pembayaran Instan
                    </button>
                </form>
            </div>
        @else
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <span class="text-xs font-bold text-emerald-800 uppercase">Tagihan Ini Sudah Lunas Dibayar</span>
            </div>
        @endif

        <div class="pt-4 flex gap-4">
            <a href="{{ route('front.payment.index') }}" class="w-full py-4 bg-primary text-white font-button rounded-xl text-center font-bold shadow-md flex items-center justify-center gap-2 cursor-pointer text-xs uppercase tracking-wider">
                <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                Lihat Semua Riwayat Tagihan
            </a>
        </div>
    </div>
</main>
@endsection