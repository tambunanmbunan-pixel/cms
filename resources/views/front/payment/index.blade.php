@extends('front.layout.layout')

@section('content')
<main class="pt-32 pb-section-gap px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="font-headline-lg text-2xl md:text-3xl text-primary font-bold">Riwayat Transaksi & Tagihan</h1>
            <p class="text-xs text-on-surface-variant mt-0.5">Daftar rekaman seluruh invoice pembelian produk Hanah Luxury Fragrance Anda.</p>
        </div>
        <a href="{{ route('front.profile') }}" class="inline-flex items-center text-xs font-bold text-secondary hover:underline gap-1">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali ke Profil
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-outline-variant/10 shadow-sm overflow-hidden">
        @if($payments->isEmpty())
            <div class="p-12 text-center space-y-3">
                <span class="material-symbols-outlined text-4xl text-on-surface-variant/40">receipt_long</span>
                <p class="text-sm text-on-surface-variant font-medium">Belum ada riwayat pesanan.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low border-b border-outline-variant/20 text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">
                            <th class="p-4 pl-6">No. Invoice</th>
                            <th class="p-4">Tanggal Pemesanan</th>
                            <th class="p-4">Metode</th>
                            <th class="p-4">Total Bayar</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 pr-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-outline-variant/10">
                        @foreach($payments as $pay)
                        <tr class="hover:bg-surface-container-lowest/50 transition-colors">
                            <td class="p-4 pl-6 font-mono font-bold text-primary">{{ $pay->order_number }}</td>
                            <td class="p-4 text-xs text-on-surface-variant">{{ date('d M Y, H:i', strtotime($pay->created_at)) }}</td>
                            <td class="p-4 text-xs font-medium">{{ $pay->payment_channel }}</td>
                            <td class="p-4 font-bold text-primary">Rp {{ number_format($pay->amount, 0, ',', '.') }}</td>
                            <td class="p-4">
                                @if($pay->status == 'sudah_dibayar' || $pay->status == 'success')
                                    <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase rounded">Lunas</span>
                                @else
                                    <span class="px-2.5 py-0.5 bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold uppercase rounded">Pending</span>
                                @endif
                            </td>
                            <td class="p-4 pr-6 text-center">
                                @if($pay->status == 'menunggu_pembayaran' || $pay->status == 'pending')
                                    <a href="{{ route('front.payment.create', $pay->id) }}" class="inline-block px-4 py-1.5 bg-secondary text-white font-bold text-xs rounded hover:bg-secondary/90 transition-all">
                                        Bayar
                                    </a>
                                @else
                                    <a href="{{ route('front.transaction.awaiting_payment', $pay->id) }}" class="inline-block px-4 py-1.5 border border-outline-variant text-on-surface-variant font-bold text-xs rounded hover:bg-surface-container-low transition-all">
                                        Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</main>
@endsection