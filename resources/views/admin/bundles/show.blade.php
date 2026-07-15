@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('bundles.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BUNDLES</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">BUNDLE DETAILS</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Luxury Bundle Specifications</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Tinjauan menyeluruh komposisi item produk tunggal dan performa harga paket bundling.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('bundles.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant hover:text-primary rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali</span>
            </a>
            <a href="{{ route('bundles.edit', $bundle->id) }}" class="px-5 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">edit</span>
                <span>Edit Bundle</span>
            </a>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="space-y-6">
            <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden p-6 text-center">
                <div class="relative aspect-[4/3] w-full rounded-xl border border-outline-variant/40 bg-gray-50 overflow-hidden flex items-center justify-center mb-6">
                    @if(!empty($bundle->image) && file_exists(public_path('admin/images/bundles/' . $bundle->image)))
                        <img src="{{ asset('admin/images/bundles/' . $bundle->image) }}" alt="{{ $bundle->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center text-outline/40">
                            <span class="material-symbols-outlined text-5xl mb-2">auto_awesome</span>
                            <span class="text-xs italic">No Custom Cover Image</span>
                        </div>
                    @endif
                </div>

                <div class="space-y-2">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $bundle->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} uppercase tracking-wider">
                        {{ $bundle->status }}
                    </span>
                    <h4 class="text-xl font-extrabold text-primary pt-2">{{ $bundle->name }}</h4>
                    <p class="font-mono text-xs text-on-surface-variant/70 font-bold bg-surface-container inline-block px-3 py-1 rounded-lg mt-1">{{ $bundle->id }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-primary/5 mt-6 pt-6">
                    <div class="text-left p-3 bg-surface-container-low/40 rounded-xl">
                        <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Harga Paket</p>
                        <p class="text-base font-black text-primary mt-1">Rp {{ number_format($bundle->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-left p-3 bg-surface-container-low/40 rounded-xl">
                        <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Kuota Stok</p>
                        <p class="text-base font-black text-primary mt-1">{{ $bundle->stock }} <span class="text-xs font-medium">Set</span></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 p-6 space-y-4">
                <h4 class="text-xs font-bold text-primary uppercase tracking-wider border-b pb-2">Rincian Metadata Log</h4>
                <div class="space-y-3 text-xs">
                    <div class="flex justify-between">
                        <span class="text-on-surface-variant">URL Slug:</span>
                        <span class="font-mono font-medium text-primary">{{ $bundle->slug }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-on-surface-variant">Created At:</span>
                        <span class="text-primary font-medium">{{ $bundle->created_at ? $bundle->created_at->format('M d, Y - H:i') : '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-on-surface-variant">Updated At:</span>
                        <span class="text-primary font-medium">{{ $bundle->updated_at ? $bundle->updated_at->format('M d, Y - H:i') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 p-8 space-y-3">
                <h4 class="text-sm font-bold text-primary uppercase tracking-wide border-b border-primary/5 pb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">description</span>
                    <span>Deskripsi Filosofi Kemewahan Set</span>
                </h4>
                <p class="text-sm text-on-surface-variant leading-relaxed italic bg-gray-50/40 p-4 rounded-xl border border-dashed">
                    {{ $bundle->description ?? 'Tidak ada narasi deskripsi kustom yang disematkan untuk paket bundling wewangian eksklusif ini.' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl">layers</span>
                        <span class="font-title-sm text-title-sm text-primary font-bold">Komposisi Varian Produk Tunggal</span>
                    </div>
                    <span class="px-2.5 py-0.5 bg-surface-container text-on-surface-variant rounded-full text-[10px] font-bold uppercase">
                        {{ $bundle->products->count() }} Anggota Varian
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Product Info</th>
                                <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10 text-center">Takar Kuantitas (Qty)</th>
                                <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Retail Unit Price</th>
                                <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10 text-right">Subtotal Estimasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10 text-sm">
                            @php $totalRetailCalculated = 0; @endphp
                            @forelse($bundle->products as $product)
                                @php
                                    $subtotal = $product->price * $product->pivot->quantity;
                                    $totalRetailCalculated += $subtotal;
                                @endphp
                                <tr class="hover:bg-surface-container-low/40 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary border flex-shrink-0">
                                                <span class="material-symbols-outlined text-lg">science</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-primary">{{ $product->name }}</p>
                                                <p class="text-[11px] text-on-surface-variant/70 font-mono">ID: {{ $product->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 font-mono font-bold text-center text-primary">
                                        <span class="bg-surface-container px-3 py-1 rounded-lg text-xs border">
                                            {{ $product->pivot->quantity }} Pcs
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 font-medium text-on-surface-variant">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-8 py-5 text-right font-bold text-primary">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-10 text-center text-on-surface-variant italic">
                                        Tidak ada data produk ritel tunggal yang terikat dengan paket wewangian ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                        @if($totalRetailCalculated > 0)
                            <tfoot class="bg-surface-container-low/20 border-t-2 border-outline-variant/20">
                                <tr>
                                    <td colspan="3" class="px-8 py-3 text-xs font-bold text-on-surface-variant uppercase text-right">Total Akumulasi Eceran Ritel:</td>
                                    <td class="px-8 py-3 font-bold text-on-surface-variant text-right">Rp {{ number_format($totalRetailCalculated, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-primary/5">
                                    <td colspan="3" class="px-8 py-3 text-xs font-bold text-primary uppercase text-right">Harga Spesial Penawaran Paket Bundling:</td>
                                    <td class="px-8 py-3 font-black text-primary text-right text-base">Rp {{ number_format($bundle->price, 0, ',', '.') }}</td>
                                </tr>
                                @if($totalRetailCalculated > $bundle->price)
                                    <tr class="bg-emerald-500/[0.04]">
                                        <td colspan="3" class="px-8 py-3 text-xs font-bold text-emerald-700 uppercase text-right">Konsumen Menghemat Hingga (Value Profit):</td>
                                        <td class="px-8 py-3 font-bold text-emerald-600 text-right text-sm">
                                            - Rp {{ number_format($totalRetailCalculated - $bundle->price, 0, ',', '.') }} ({{ round((($totalRetailCalculated - $bundle->price) / $totalRetailCalculated) * 100) }}%)
                                        </td>
                                    </tr>
                                @endif
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection