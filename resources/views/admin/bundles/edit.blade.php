@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('bundles.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BUNDLES</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">EDIT BUNDLE SET</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Modify Luxury Bundle</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Perbarui detail penawaran, kuota stok, atau kombinasi parfum di dalam paket wewangian.</p>
        </div>
        <div>
            <a href="{{ route('bundles.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant hover:text-primary rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali</span>
            </a>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden">
        <form action="{{ route('bundles.update', $bundle->id) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-outline-variant/10">
            @csrf
            @method('PUT')
            
            <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Nama Paket Bundling *</label>
                            <input type="text" name="name" required value="{{ old('name', $bundle->name) }}" placeholder="Contoh: Royal Oud Trilogy Set" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 placeholder:text-gray-400 bg-gray-50/30 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">ID Paket (Oracle)</label>
                            <input type="text" disabled value="{{ $bundle->id }}" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/20 text-sm bg-surface-container/40 text-on-surface-variant/70 font-mono font-bold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Harga Paket (IDR) *</label>
                            <input type="number" name="price" required value="{{ old('price', (int)$bundle->price) }}" placeholder="0.00" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Stok Kuota Paket *</label>
                            <input type="number" name="stock" required value="{{ old('stock', $bundle->stock) }}" placeholder="Ketersediaan kuota set" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Status Paket *</label>
                            <select name="status" class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 cursor-pointer transition-all">
                                <option value="active" {{ $bundle->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $bundle->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Deskripsi Kemewahan Set</label>
                        <textarea name="description" rows="5" placeholder="Gambahkan filosofi keharmonisan kombinasi aroma wewangian di dalam paket ini..." 
                            class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all resize-none">{{ old('description', $bundle->description) }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Bundle Image Cover</label>
                    <div class="border-2 border-dashed border-outline-variant/60 rounded-2xl p-6 text-center flex flex-col items-center justify-center bg-gray-50/30 min-h-[250px] transition-all hover:border-primary/40 group relative overflow-hidden">
                        
                        @if(!empty($bundle->image) && file_exists(public_path('admin/images/bundles/' . $bundle->image)))
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity z-10 flex flex-col items-center justify-center text-white pointer-events-none">
                                <span class="material-symbols-outlined text-2xl mb-1">upload_file</span>
                                <p class="text-[10px] font-bold uppercase tracking-wider">Change Image</p>
                            </div>
                            <img src="{{ asset('admin/images/bundles/' . $bundle->image) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <span class="material-symbols-outlined text-4xl text-outline/60 mb-3 group-hover:text-primary transition-colors">auto_awesome</span>
                            <p class="text-xs font-medium text-primary mb-1">Upload Cover Baru</p>
                            <p class="text-[10px] text-on-surface-variant/70 mb-4">Format PNG, JPG atau JPEG maksimal 2MB</p>
                        @endif
                        
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    </div>
                    @if(!empty($bundle->image))
                        <p class="text-[11px] text-on-surface-variant/70 italic text-center">Menampilkan berkas gambar aktif saat ini</p>
                    @endif
                </div>
            </div>

            <div class="p-8 bg-surface-container-low/20">
                <div class="mb-4">
                    <h4 class="text-sm font-bold text-primary uppercase tracking-wide">Sesuaikan Komposisi Varian Parfum</h4>
                    <p class="text-xs text-on-surface-variant">Kelola item tunggal yang terikat di dalam paket bundling ini beserta kuantitas takarannya.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[350px] overflow-y-auto pr-2">
                    @forelse($products as $product)
                        @php
                            // Cek apakah produk ini sudah masuk di dalam paket bundling
                            $attachedProduct = $bundle->products->firstWhere('id', $product->id);
                            $isAttached = !is_null($attachedProduct);
                            $pivotQty = $isAttached ? $attachedProduct->pivot->quantity : 1;
                        @endphp
                        
                        <div class="p-4 bg-white border {{ $isAttached ? 'border-primary/40 bg-primary-container/[0.02]' : 'border-outline-variant/30' }} rounded-xl flex items-center justify-between gap-4 transition-all hover:border-primary/20 shadow-sm bundle-item-card">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="products[]" value="{{ $product->id }}" id="prod-{{ $product->id }}"
                                    {{ $isAttached ? 'checked' : '' }}
                                    class="w-4 h-4 rounded text-primary border-outline-variant focus:ring-0 cursor-pointer product-select-checkbox">
                                <label for="prod-{{ $product->id }}" class="cursor-pointer select-none">
                                    <p class="text-xs font-bold text-primary">{{ $product->name }}</p>
                                    <p class="text-[11px] text-gray-500">ID: {{ $product->id }} — Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </label>
                            </div>
                            
                            <div class="flex items-center gap-2 {{ $isAttached ? '' : 'opacity-40' }} transition-opacity qty-container">
                                <span class="text-[10px] font-bold text-primary uppercase tracking-wider">Qty:</span>
                                <input type="number" name="quantities[{{ $product->id }}]" min="1" value="{{ $pivotQty }}" {{ $isAttached ? '' : 'disabled' }}
                                    class="w-14 px-2 py-1 text-center border border-outline-variant/40 rounded-lg text-xs {{ $isAttached ? 'bg-white' : 'bg-gray-50/50' }} focus:ring-0 bundle-qty-input">
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-6 text-center text-xs text-on-surface-variant italic bg-white rounded-xl border">
                            Belum ada produk berstatus 'available' di database Oracle.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="px-8 py-4 bg-gray-50/50 flex items-center justify-end gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all active:scale-95 duration-200 cursor-pointer shadow-md">
                    <span class="material-symbols-outlined text-sm">published_with_changes</span>
                    <span>Simpan Perubahan Paket</span>
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.product-select-checkbox');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parentCard = this.closest('.bundle-item-card');
                const qtyContainer = parentCard.querySelector('.qty-container');
                const qtyInput = parentCard.querySelector('.bundle-qty-input');
                
                if(this.checked) {
                    parentCard.classList.add('border-primary/40', 'bg-primary-container/[0.02]');
                    qtyContainer.classList.remove('opacity-40');
                    qtyInput.removeAttribute('disabled');
                    qtyInput.classList.remove('bg-gray-50/50');
                    qtyInput.classList.add('bg-white');
                    qtyInput.focus();
                } else {
                    parentCard.classList.remove('border-primary/40', 'bg-primary-container/[0.02]');
                    qtyContainer.classList.add('opacity-40');
                    qtyInput.setAttribute('disabled', 'disabled');
                    qtyInput.classList.remove('bg-white');
                    qtyInput.classList.add('bg-gray-50/50');
                    qtyInput.value = 1;
                }
            });
        });
    });
</script>
@endsection