@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <!-- Header Section -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('bundles.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BUNDLES</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">CREATE NEW SET</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Create Luxury Bundle</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Gabungkan beberapa koleksi varian wewangian ke dalam satu paket eksklusif.</p>
        </div>
        <div>
            <a href="{{ route('bundles.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant hover:text-primary rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali</span>
            </a>
        </div>
    </section>

    <!-- Form Input Section -->
    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden">
        <form action="{{ route('bundles.store') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-outline-variant/10">
            @csrf
            
            <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sisi Kiri: Informasi Utama Paket -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Nama Paket Bundling *</label>
                        <input type="text" name="name" required placeholder="Contoh: Royal Oud Trilogy Set" 
                            class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 placeholder:text-gray-400 bg-gray-50/30 transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Harga Paket (IDR) *</label>
                            <input type="number" name="price" required placeholder="0.00" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Stok Kuota Paket *</label>
                            <input type="number" name="stock" required placeholder="Ketersediaan kuota set" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Deskripsi Kemewahan Set</label>
                        <textarea name="description" rows="5" placeholder="Gambarkan filosofi keharmonisan kombinasi aroma wewangian di dalam paket ini..." 
                            class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all resize-none"></textarea>
                    </div>
                </div>

                <!-- Sisi Kanan: Media Gambar Upload -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Featured Bundle Image</label>
                    <div class="border-2 border-dashed border-outline-variant/60 rounded-2xl p-8 text-center flex flex-col items-center justify-center bg-gray-50/30 min-h-[250px] transition-all hover:border-primary/40 group">
                        <span class="material-symbols-outlined text-4xl text-outline/60 mb-3 group-hover:text-primary transition-colors">auto_awesome</span>
                        <p class="text-xs font-medium text-primary mb-1">Upload Cover Paket Bundling</p>
                        <p class="text-[10px] text-on-surface-variant/70 mb-4">Format PNG, JPG atau JPEG maksimal 2MB</p>
                        <input type="file" name="image" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Bagian Bawah: Pemilihan Produk (Many-to-Many Selection) -->
            <div class="p-8 bg-surface-container-low/20">
                <div class="mb-4">
                    <h4 class="text-sm font-bold text-primary uppercase tracking-wide">Pilih Anggota Produk Parfum</h4>
                    <p class="text-xs text-on-surface-variant">Centang varian parfum tunggal yang akan dilebur ke dalam paket bundling ini beserta jumlahnya.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[350px] overflow-y-auto pr-2">
                    @forelse($products as $product)
                        <div class="p-4 bg-white border border-outline-variant/30 rounded-xl flex items-center justify-between gap-4 transition-all hover:border-primary/20 shadow-sm">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="products[]" value="{{ $product->id }}" id="prod-{{ $product->id }}"
                                    class="w-4 h-4 rounded text-primary border-outline-variant focus:ring-0 cursor-pointer product-select-checkbox">
                                <label for="prod-{{ $product->id }}" class="cursor-pointer">
                                    <p class="text-xs font-bold text-primary">{{ $product->name }}</p>
                                    <p class="text-[11px] text-gray-500">ID: {{ $product->id }} — Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </label>
                            </div>
                            
                            <!-- Input Kuantitas Jumlah Item per Produk -->
                            <div class="flex items-center gap-2 opacity-40 transition-opacity qty-container">
                                <span class="text-[10px] font-bold text-primary uppercase tracking-wider">Qty:</span>
                                <input type="number" name="quantities[{{ $product->id }}]" min="1" value="1" disabled
                                    class="w-14 px-2 py-1 text-center border border-outline-variant/40 rounded-lg text-xs bg-gray-50/50 focus:ring-0 bundle-qty-input">
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-6 text-center text-xs text-on-surface-variant italic bg-white rounded-xl border">
                            Belum ada produk berstatus 'available' di database Oracle untuk digabungkan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Footer Aksi Form -->
            <div class="px-8 py-4 bg-gray-50/50 flex items-center justify-end gap-3">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all active:scale-95 duration-200 cursor-pointer shadow-md">
                    <span class="material-symbols-outlined text-sm">inventory_2</span>
                    <span>Simpan Paket Bundling</span>
                </button>
            </div>
        </form>
    </div>
</main>

<!-- JavaScript Interaktif Form -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.product-select-checkbox');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parentCard = this.closest('.shadow-sm');
                const qtyContainer = parentCard.querySelector('.qty-container');
                const qtyInput = parentCard.querySelector('.bundle-qty-input');
                
                if(this.checked) {
                    qtyContainer.classList.remove('opacity-40');
                    qtyInput.removeAttribute('disabled');
                    qtyInput.classList.remove('bg-gray-50/50');
                    qtyInput.focus();
                } else {
                    qtyContainer.classList.add('opacity-40');
                    qtyInput.setAttribute('disabled', 'disabled');
                    qtyInput.classList.add('bg-gray-50/50');
                    qtyInput.value = 1;
                }
            });
        });
    });
</script>
@endsection