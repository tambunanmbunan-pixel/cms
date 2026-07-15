@extends('admin.layout.layout')

@section('content')
        <main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
            <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                        <span class="hover:text-primary cursor-pointer transition-colors">INVENTORY</span>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <span class="text-primary font-bold">PRODUCTS</span>
                    </nav>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Fragrance Products</h3>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">Manage luxury collections, olfactory journey specs, and stock availability.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-6 py-2.5 bg-primary text-on-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-sm">filter_list</span>
                        <span>Filters</span>
                    </button>
                    <a href="{{ route('products.create') }}" class="px-6 py-2.5 bg-secondary-container text-on-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:brightness-110 transition-all luxury-shadow active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-sm">add</span>
                        <span>Add Product</span>
                    </a>
                </div>
            </section>

            @if(session('success_message'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    {{ session('success_message') }}
                </div>
            @endif

            <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10">
                <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <span class="font-title-sm text-title-sm text-primary">Luxury Catalog</span>
                        <span class="px-2 py-0.5 bg-surface-container text-on-surface-variant rounded-full text-[10px] font-bold uppercase">{{ $products->count() }} Items</span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Product</th>
                                <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Category</th>
                                <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Price</th>
                                <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Stock</th>
                                <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Status</th>
                                <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @forelse($products as $product)
                                @php $prdId = $product->getKey(); @endphp
                                <tr data-href="{{ route('products.show', $prdId) }}" 
                                    class="category-row hover:bg-surface-container-low transition-colors group cursor-pointer select-none">
                                    
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary flex-shrink-0 overflow-hidden border border-outline-variant/10">
                                                @if(!empty($product->featured_image) && file_exists(public_path('admin/images/products/' . $product->featured_image)))
                                                    <img src="{{ asset('admin/images/products/' . $product->featured_image) }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="material-symbols-outlined">science</span>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-title-sm text-title-sm text-primary font-bold">
                                                    {{ $product->name }}
                                                </p>
                                                <p class="text-on-surface-variant font-mono text-[11px]">{{ $prdId }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5">
                                        <div class="flex flex-wrap gap-1.5 max-w-[220px]">
                                            @forelse($product->categories as $cat)
                                                <span class="px-2.5 py-1 bg-primary/5 text-primary text-[10px] font-bold rounded-lg border border-primary/10 uppercase tracking-wide shadow-sm">
                                                    {{ $cat->name }}
                                                </span>
                                            @empty
                                                <span class="px-2.5 py-1 bg-gray-50 text-gray-400 text-[10px] font-medium rounded-lg border border-gray-200/60 italic">
                                                    Uncategorized
                                                </span>
                                            @endforelse
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5 font-medium text-sm text-primary">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="px-6 py-5 text-sm text-on-surface-variant">
                                        {{ $product->stock }} <span class="text-xs text-gray-400">units</span>
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="px-2.5 py-1 text-[11px] font-bold uppercase rounded-full {{ $product->status == 'Active' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $product->status }}
                                        </span>
                                    </td>
                                    
                                    <!-- PERBAIKAN: Menambahkan class action-area pada elemen TD agar event klik baris ter-filter secara presisi -->
                                    <td class="px-8 py-5 text-right action-area">
                                        <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all duration-200">
                                            <a href="{{ route('products.edit', $prdId) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-primary/10 text-on-surface-variant hover:text-primary text-xs font-bold rounded-xl border border-outline-variant/20 hover:border-primary/20 transition-all duration-150 shadow-sm">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                                <span>Edit</span>
                                            </a>
                                            <button type="button" onclick="openDeleteModal('{{ $prdId }}', '{{ $product->name }}')" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-error/10 text-on-surface-variant hover:text-error text-xs font-bold rounded-xl border border-outline-variant/20 hover:border-error/20 transition-all duration-150 shadow-sm cursor-pointer">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                                <span>Delete</span>
                                            </button>
                                            <form id="delete-form-{{ $prdId }}" action="{{ route('products.destroy', $prdId) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-on-surface-variant text-sm">
                                        <span class="material-symbols-outlined text-3xl block mb-2 text-gray-300">layers_clear</span>
                                        Belum ada data katalog produk di database Oracle.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Dynamic Interaktif Delete -->
            <div id="luxuryDeleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
                <div class="absolute inset-0 bg-[#081828]/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
                <div class="bg-white rounded-2xl border border-outline-variant/10 shadow-2xl max-w-md w-full overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10" id="modalCard">
                    <div class="p-6 flex gap-4 items-start bg-surface-container-low/30 border-b border-outline-variant/10">
                        <div class="w-10 h-10 rounded-xl bg-error-container/10 flex items-center justify-center text-error shrink-0 border border-error/10">
                            <span class="material-symbols-outlined text-[22px]">warning</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-primary uppercase tracking-wide">Delete Product</h4>
                            <p class="text-xs text-on-surface-variant leading-relaxed">Apakah Anda yakin menghapus <span id="deleteProductName" class="font-bold text-primary"></span> beserta seluruh data spesifikasi aromanya dari Oracle?</p>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50/50 flex items-center justify-end gap-3">
                        <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors">Batal</button>
                        <button type="button" id="confirmDeleteBtn" class="px-5 py-2.5 bg-error text-on-error rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-error/90 transition-all">Hapus Permanen</button>
                    </div>
                </div>
            </div>
        </main>

        <script>
            let activeProductId = null;
            function openDeleteModal(id, name) {
                activeProductId = id;
                document.getElementById('deleteProductName').innerText = `"${name}"`;
                const modal = document.getElementById('luxuryDeleteModal');
                const card = document.getElementById('modalCard');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    card.classList.remove('scale-95', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }, 20);
            }
            function closeDeleteModal() {
                const card = document.getElementById('modalCard');
                const modal = document.getElementById('luxuryDeleteModal');
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-95', 'opacity-0');
                setTimeout(() => modal.classList.add('hidden'), 300);
            }
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                    if (activeProductId) document.getElementById(`delete-form-${activeProductId}`).submit();
                });
                document.querySelectorAll('.category-row').forEach(row => {
                    row.addEventListener('click', function(event) {
                        // Memastikan target terdekat mencakup elemen TD ber-class action-area
                        if (!event.target.closest('.action-area')) {
                            const url = this.getAttribute('data-href');
                            if (url) window.location.href = url;
                        }
                    });
                });
            });
        </script>
@endsection