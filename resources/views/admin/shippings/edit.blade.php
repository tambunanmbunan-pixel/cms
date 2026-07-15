@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('shippings.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">SHIPPING</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">EDIT METHOD</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Edit Shipping Courier</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Perbarui konfigurasi biaya tarif logistik jasa ekspedisi.</p>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden max-w-4xl">
        <form action="{{ route('shippings.update', $shipping->id) }}" method="POST" class="p-8 space-y-6">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Nama Kurir / Ekspedisi *</label>
                    <input type="text" name="courier_name" required value="{{ old('courier_name', $shipping->courier_name) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Nama Layanan *</label>
                    <input type="text" name="service_name" required value="{{ old('service_name', $shipping->service_name) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Tarif Ongkos Kirim (IDR) *</label>
                    <input type="number" name="cost" required value="{{ old('cost', (int)$shipping->cost) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Estimasi Waktu Sampai *</label>
                    <input type="text" name="estimated_time" required value="{{ old('estimated_time', $shipping->estimated_time) }}" class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Status Operasional *</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 cursor-pointer">
                        <option value="active" {{ $shipping->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $shipping->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="border-t border-outline-variant/10 pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('shippings.index') }}" class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all active:scale-95 duration-200 shadow-md">
                    <span class="material-symbols-outlined text-sm">published_with_changes</span><span>Update Method</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection