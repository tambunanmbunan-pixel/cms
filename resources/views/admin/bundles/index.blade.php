@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <!-- Header Section -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <span class="hover:text-primary cursor-pointer transition-colors uppercase">INVENTORY</span>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">PRODUCT BUNDLES</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Product Bundles / Sets</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Kelola paket kombinasi wewangian hemat Hanah Luxury Fragrance.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('bundles.create') }}" class="px-6 py-2.5 bg-secondary-container text-on-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:brightness-110 transition-all luxury-shadow active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">add</span>
                <span>Add Bundle Set</span>
            </a>
        </div>
    </section>

    @if(session('success_message'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('success_message') }}
        </div>
    @endif

    <!-- Table List Dashboard -->
    <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10">
        <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="font-title-sm text-title-sm text-primary">Bundle Package List</span>
                <span class="px-2 py-0.5 bg-surface-container text-on-surface-variant rounded-full text-[10px] font-bold uppercase">{{ $bundles->count() }} Packages</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Bundle Name</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Quota Stock</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Package Price</th>
                        <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse($bundles as $bundle)
                        @php
                            $bundleId = $bundle->getKey() ?? $bundle->id ?? $bundle->ID;
                        @endphp
                        <!-- 🛠️ Ditambahkan: data-href untuk link dinamis show, class bundle-row, dan cursor-pointer -->
                        <tr data-href="{{ route('bundles.show', $bundleId) }}" 
                            class="bundle-row hover:bg-surface-container-low transition-colors group relative cursor-pointer select-none">
                            
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary flex-shrink-0 border border-outline-variant/10">
                                        <span class="material-symbols-outlined">inventory_2</span>
                                    </div>
                                    <div>
                                        <p class="font-title-sm text-title-sm text-primary font-bold group-hover:text-primary/80 transition-colors">
                                            {{ $bundle->name }}
                                        </p>
                                        <p class="text-on-surface-variant text-[11px] line-clamp-1 max-w-md">{{ $bundle->description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="font-mono text-xs text-on-surface-variant bg-surface-container px-2.5 py-1 rounded-lg font-bold">{{ $bundle->stock }} Set</span>
                            </td>
                            <td class="px-6 py-5 font-bold text-sm text-primary">
                                Rp {{ number_format($bundle->price, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-5 text-right flex items-center justify-end gap-3 min-h-[77px]">
                                <!-- Status Badge -->
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wide group-hover:opacity-0 group-hover:scale-95 transition-all duration-200">
                                    {{ $bundle->status }}
                                </span>

                                <!-- AREA ACTION BUTTONS (MUNCUL SAAT HOVER) -->
                                <!-- 🛠️ Ditambahkan: class action-area agar ketika tombol diklik tidak memicu redirect ke halaman show -->
                                <div class="action-area absolute opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 flex items-center gap-2 pr-4 bg-transparent">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('bundles.edit', $bundleId) }}" 
                                       class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-primary/10 text-on-surface-variant hover:text-primary text-xs font-bold rounded-xl border border-outline-variant/20 hover:border-primary/20 transition-all duration-150 shadow-sm">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Tombol Delete -->
                                    <button type="button" 
                                            onclick="openDeleteModal('{{ $bundleId }}', '{{ $bundle->name }}')" 
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-error/10 text-on-surface-variant hover:text-error text-xs font-bold rounded-xl border border-outline-variant/20 hover:border-error/20 transition-all duration-150 shadow-sm cursor-pointer">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                        <span>Delete</span>
                                    </button>

                                    <!-- Form Hidden Method Delete -->
                                    <form id="delete-form-{{ $bundleId }}" action="{{ route('bundles.destroy', $bundleId) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-on-surface-variant text-sm">
                                <span class="material-symbols-outlined text-3xl block mb-2 text-gray-300">layers_clear</span>
                                Belum ada data paket bundling produk di database Oracle.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS PREMIUM -->
    <div id="luxuryDeleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div class="absolute inset-0 bg-[#081828]/40 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

        <div class="bg-white rounded-2xl border border-outline-variant/10 shadow-2xl max-w-md w-full overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10" id="modalCard">
            <div class="p-6 flex gap-4 items-start bg-surface-container-low/30 border-b border-outline-variant/10">
                <div class="w-10 h-10 rounded-xl bg-error-container/10 flex items-center justify-center text-error shrink-0 border border-error/10">
                    <span class="material-symbols-outlined text-[22px]">warning</span>
                </div>
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-primary uppercase tracking-wide">Delete Bundle Package</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">
                        Apakah Anda yakin ingin menghapus paket produk <span id="deleteBundleName" class="font-bold text-primary"></span> secara permanen dari database Oracle?
                    </p>
                </div>
            </div>

            <div class="px-6 py-3 bg-error-container/5 border-b border-outline-variant/5 flex items-center gap-2 text-[11px] text-error font-medium">
                <span class="material-symbols-outlined text-sm">info</span>
                Tindakan ini tidak dapat dibatalkan dan akan otomatis memutus relasi ke produk retail.
            </div>

            <div class="px-6 py-4 bg-gray-50/50 flex items-center justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" 
                        class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn"
                        class="px-5 py-2.5 bg-error text-on-error rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-error/90 transition-all shadow-md hover:shadow-lg active:scale-95 duration-150 cursor-pointer">
                    <span class="material-symbols-outlined text-sm">delete_forever</span>
                    Hapus Permanen
                </button>
            </div>
        </div>
    </div>
</main>

<!-- JAVASCRIPT CONTROLLER -->
<script>
    let activeBundleId = null;

    function openDeleteModal(id, name) {
        activeBundleId = id;
        document.getElementById('deleteBundleName').innerText = `"${name}"`;
        
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
        
        setTimeout(() => {
            modal.classList.add('hidden');
            activeBundleId = null;
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Eksekusi hapus data
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (activeBundleId) {
                    document.getElementById(`delete-form-${activeBundleId}`).submit();
                }
            });
        }

        // 🛠️ Ditambahkan: Handler Klik Baris Tabel untuk Redirect Menuju Detail (Show)
        const rows = document.querySelectorAll('.bundle-row');
        rows.forEach(row => {
            row.addEventListener('click', function(event) {
                // Mencegah redirect jika user mengklik tombol di dalam area aksi (Edit / Delete)
                if (event.target.closest('.action-area')) {
                    return; 
                }

                const url = this.getAttribute('data-href');
                if (url) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection