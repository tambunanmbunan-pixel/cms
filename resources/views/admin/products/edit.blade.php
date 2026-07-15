@extends('admin.layout.layout')

@section('content')
        <main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
            <!-- Header & Toolbar -->
            <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                        <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">PRODUCTS</a>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <span class="text-primary font-bold">EDIT FRAGRANCE</span>
                    </nav>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Edit Fragrance</h3>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">Modify fragrance profile specifications and adjust structural properties.</p>
                </div>
            </section>

            <!-- Notifikasi Error Jika Validasi Gagal -->
            @if ($errors->any())
                <div class="mb-6 p-5 bg-error-container/10 border border-error/20 text-error rounded-xl space-y-2">
                    <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wide">
                        <span class="material-symbols-outlined text-sm">error</span>
                        <span>Gagal Memperbarui! Periksa Input Berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 opacity-90 pl-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error_message'))
                <div class="mb-6 p-4 bg-error-container/20 border border-error/20 text-error rounded-xl text-xs font-semibold flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">warning</span>
                    {{ session('error_message') }}
                </div>
            @endif

            <!-- Form Action Mengarah ke Update dengan Method PUT -->
            <form action="{{ route('products.update', $product->getKey()) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf
                @method('PUT')
                
                <!-- KOLOM KIRI & TENGAH: Identitas Utama & Olfactory Journey -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Bento Box 1: Core Info -->
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-6">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2">Core Product Identity</h4>
                        
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-primary">Fragrance Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required 
                                   class="w-full px-4 py-3 border border-outline-variant/30 rounded-xl text-sm focus:ring-1 focus:ring-primary focus:outline-none" 
                                   placeholder="e.g., Azure Dusk">
                        </div>

                        <!-- MULTI-CATEGORY EDIT DROPDOWN (Dinamis Berdasarkan Data tags_category Oracle) -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="block text-xs font-bold text-primary">Product Categories</label>
                                    <p class="text-[11px] text-on-surface-variant">Sesuaikan rumpun kategori aroma parfum.</p>
                                </div>
                                <button type="button" id="btn-add-category" 
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary/10 hover:bg-primary/20 text-primary text-xs font-bold rounded-xl transition-all cursor-pointer select-none">
                                    <span class="material-symbols-outlined text-sm font-bold">add</span>
                                    <span>Tambah Category</span>
                                </button>
                            </div>
                            
                            <div id="category-inputs-wrapper" class="space-y-3">
                                <!-- Mengambil array ID kategori yang sudah dimiliki produk ini dari DB -->
                                @php 
                                    $selectedCategories = old('category_ids', $product->categories->pluck('id')->toArray());
                                @endphp

                                @forelse($selectedCategories as $index => $currentSelectedId)
                                    <div class="flex items-center gap-3 category-row-item">
                                        <div class="flex-1">
                                            <select name="category_ids[]" required 
                                                    class="w-full px-4 py-2.5 border border-outline-variant/30 rounded-xl text-sm focus:ring-1 focus:ring-primary focus:outline-none bg-white">
                                                <option value="" disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->getKey() }}" {{ $currentSelectedId == $category->getKey() ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="p-2 text-on-surface-variant hover:text-error transition-colors btn-remove-category cursor-pointer" {{ $index === 0 ? 'disabled style=display:none' : '' }}>
                                            <span class="material-symbols-outlined text-md">delete</span>
                                        </button>
                                    </div>
                                @empty
                                    <!-- Fallback jika produk belum punya kategori sama sekali -->
                                    <div class="flex items-center gap-3 category-row-item">
                                        <div class="flex-1">
                                            <select name="category_ids[]" required 
                                                    class="w-full px-4 py-2.5 border border-outline-variant/30 rounded-xl text-sm focus:ring-1 focus:ring-primary focus:outline-none bg-white">
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->getKey() }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="p-2 text-gray-300 cursor-not-allowed" disabled>
                                            <span class="material-symbols-outlined text-md">delete</span>
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-primary">General Description</label>
                            <textarea name="description" rows="4" required 
                                      class="w-full px-4 py-3 border border-outline-variant/30 rounded-xl text-sm focus:ring-1 focus:ring-primary focus:outline-none" 
                                      placeholder="Brief general description...">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Bento Box 2: Olfactory Journey Notes -->
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-6">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2">The Olfactory Journey</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2 p-4 bg-orange-50/30 rounded-xl border border-orange-100">
                                <label class="block text-xs font-bold text-orange-700 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">filter_1</span> Top Notes
                                </label>
                                <input type="text" name="top_notes" value="{{ old('top_notes', $product->detail->top_notes ?? '') }}"
                                       class="w-full px-3 py-2 bg-white border border-outline-variant/20 rounded-lg text-xs focus:outline-none focus:border-[#FF6B35]" 
                                       placeholder="e.g., Bergamot, Lemon">
                            </div>
                            <div class="space-y-2 p-4 bg-rose-50/30 rounded-xl border border-rose-100">
                                <label class="block text-xs font-bold text-rose-700 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">filter_2</span> Heart Notes
                                </label>
                                <input type="text" name="heart_notes" value="{{ old('heart_notes', $product->detail->heart_notes ?? '') }}"
                                       class="w-full px-3 py-2 bg-white border border-outline-variant/20 rounded-lg text-xs focus:outline-none focus:border-[#FF6B35]" 
                                       placeholder="e.g., Lavender, Sea Salt">
                            </div>
                            <div class="space-y-2 p-4 bg-amber-50/30 rounded-xl border border-amber-100">
                                <label class="block text-xs font-bold text-amber-700 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">filter_3</span> Base Notes
                                </label>
                                <input type="text" name="base_notes" value="{{ old('base_notes', $product->detail->base_notes ?? '') }}"
                                       class="w-full px-3 py-2 bg-white border border-outline-variant/20 rounded-lg text-xs focus:outline-none focus:border-[#FF6B35]" 
                                       placeholder="e.g., Amberwood, Patchouli">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-primary">Atmospheric Narrative</label>
                            <textarea name="atmospheric_narrative" rows="3" 
                                      class="w-full px-4 py-3 border border-outline-variant/30 rounded-xl text-sm focus:ring-1 focus:ring-primary focus:outline-none" 
                                      placeholder="Describe the emotional and atmospheric sensory experience...">{{ old('atmospheric_narrative', $product->detail->atmospheric_narrative ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: Inventori Logistik & Spek Teknis -->
                <div class="space-y-8">
                    
                    <!-- Bento Box 3: Logistics & Pricing -->
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-4">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2">Inventory Logic</h4>
                        
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-primary">Price (IDR)</label>
                            <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required 
                                   class="w-full px-4 py-2.5 border border-outline-variant/30 rounded-xl text-sm focus:outline-none focus:border-primary" 
                                   placeholder="e.g., 850000">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-primary">Stock Quantity</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required 
                                   class="w-full px-4 py-2.5 border border-outline-variant/30 rounded-xl text-sm focus:outline-none focus:border-primary" 
                                   placeholder="e.g., 50">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-primary">Status</label>
                            <select name="status" class="w-full px-4 py-2.5 border border-outline-variant/30 rounded-xl text-sm focus:outline-none bg-white">
                                <option value="Active" {{ old('status', $product->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status', $product->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Bento Box 4: Technical Specs Grid -->
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-4">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2">Technical Properties</h4>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[11px] font-bold text-primary">Longevity</label>
                                <input type="text" name="longevity" value="{{ old('longevity', $product->detail->longevity ?? '8-10 Hours') }}" class="w-full px-3 py-2 border rounded-lg text-xs focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-bold text-primary">Concentration</label>
                                <input type="text" name="concentration" value="{{ old('concentration', $product->detail->concentration ?? '20% Pure Oil') }}" class="w-full px-3 py-2 border rounded-lg text-xs focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-bold text-primary">Volume</label>
                                <input type="text" name="volume" value="{{ old('volume', $product->detail->volume ?? '100ml / 3.4 oz') }}" class="w-full px-3 py-2 border rounded-lg text-xs focus:outline-none">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[11px] font-bold text-primary">Suitable For</label>
                                <input type="text" name="suitable_for" value="{{ old('suitable_for', $product->detail->suitable_for ?? 'Day & Night') }}" class="w-full px-3 py-2 border rounded-lg text-xs focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Bento Box 5: Media Upload Master -->
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-4">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2">Visual Master</h4>
                        
                        <!-- Tampilkan preview gambar yang saat ini aktif di Oracle -->
                        <div class="mb-3 w-24 h-24 rounded-lg border border-outline-variant/20 overflow-hidden bg-gray-50 flex items-center justify-center">
                            @if(!empty($product->featured_image) && file_exists(public_path('admin/images/products/' . $product->featured_image)))
                                <img src="{{ asset('admin/images/products/' . $product->featured_image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-gray-300 text-3xl">science</span>
                            @endif
                        </div>
                        
                        <input type="file" name="featured_image" accept="image/*" 
                               class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary file:cursor-pointer hover:file:bg-primary/20 transition-all">
                        <p class="text-[10px] text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar produk.</p>
                    </div>

                    <!-- Action Control Toolbar -->
                    <div class="flex items-center gap-3 justify-end pt-2">
                        <a href="{{ route('products.index') }}" class="px-5 py-2.5 text-xs font-bold text-on-surface-variant hover:text-primary transition-colors">Cancel</a>
                        <button type="submit" class="px-6 py-3 bg-[#FF6B35] hover:bg-[#FF6B35]/90 text-white rounded-xl text-xs font-bold shadow-md tracking-wide active:scale-95 duration-150 transition-all">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </main>
@endsection

<!-- SCRIPT PENGENDALIAN MULTI-DROPDOWN SAMA SEPERTI CREATE -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('category-inputs-wrapper');
        const addBtn = document.getElementById('btn-add-category');

        const categoryOptions = `
            <option value="" disabled selected>Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->getKey() }}">{{ $category->name }}</option>
            @endforeach
        `;

        addBtn.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-3 category-row-item animation-fade-in';
            
            newRow.innerHTML = `
                <div class="flex-1">
                    <select name="category_ids[]" required 
                            class="w-full px-4 py-2.5 border border-outline-variant/30 rounded-xl text-sm focus:ring-1 focus:ring-primary focus:outline-none bg-white">
                        ${categoryOptions}
                    </select>
                </div>
                <button type="button" class="p-2 text-on-surface-variant hover:text-error transition-colors btn-remove-category cursor-pointer">
                    <span class="material-symbols-outlined text-md">delete</span>
                </button>
            `;
            wrapper.appendChild(newRow);
        });

        wrapper.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.btn-remove-category');
            if (removeBtn) {
                const rowItem = removeBtn.closest('.category-row-item');
                if (rowItem) rowItem.remove();
            }
        });
    });
</script>

<style>
    .animation-fade-in {
        animation: fadeIn 0.25s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>