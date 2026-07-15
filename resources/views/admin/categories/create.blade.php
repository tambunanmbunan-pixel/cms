@extends('admin.layout.layout')

@section('content')
<!-- Main Content Canvas -->
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    
    <!-- Header & Breadcrumb -->
    <section class="mb-stack-lg">
        <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
            <a href="{{ route('categories.index') }}" class="hover:text-primary cursor-pointer transition-colors">INVENTORY</a>
            <span class="material-symbols-outlined text-[12px]">chevron_right</span>
            <a href="{{ route('categories.index') }}" class="hover:text-primary cursor-pointer transition-colors">PRODUCT CATEGORIES</a>
            <span class="material-symbols-outlined text-[12px]">chevron_right</span>
            <span class="text-primary font-bold">ADD CATEGORY</span>
        </nav>
        <h3 class="font-display-lg text-display-lg text-primary">Add New Category</h3>
        <p class="text-on-surface-variant font-body-md text-body-md mt-1">Buat kategori wewangian baru untuk mengorganisasi hierarki koleksi parfum.</p>
    </section>

    <!-- Bento Box Form Card -->
    <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10 max-w-[800px]">
        <div class="px-8 py-5 border-b border-outline-variant/10 bg-surface-container-low/50">
            <span class="font-title-sm text-title-sm text-primary">Category Details</span>
        </div>

        @if(session('error_message'))
            <div class="m-6 p-4 bg-error-container/20 border border-error/20 text-error rounded-xl text-xs font-semibold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">warning</span>
                {{ session('error_message') }}
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Input Nama Kategori -->
                <div class="space-y-2">
                    <label for="category_name" class="block font-label-caps text-label-caps text-on-surface-variant">Category Name</label>
                    <input type="text" name="category_name" id="category_name" value="{{ old('category_name') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/40 bg-white text-sm text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                           placeholder="Contoh: Eau de Parfum">
                    @error('category_name') <p class="text-error text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                </div>

                <!-- Input Slug Kategori -->
                <div class="space-y-2">
                    <label for="category_slug" class="block font-label-caps text-label-caps text-on-surface-variant">Slug (URL)</label>
                    <input type="text" name="category_slug" id="category_slug" value="{{ old('category_slug') }}" required readonly
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/20 bg-surface-container text-sm text-on-surface-variant focus:outline-none transition-all font-mono"
                           placeholder="Otomatis: eau-de-parfum">
                    @error('category_slug') <p class="text-error text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                </div>

                <!-- Input Deskripsi Singkat -->
                <div class="space-y-2 sm:col-span-2">
                    <label for="description" class="block font-label-caps text-label-caps text-on-surface-variant">Description</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-outline-variant/40 bg-white text-sm text-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                           placeholder="Contoh: Premium long-lasting fragrances">
                    @error('description') <p class="text-error text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                </div>

                <!-- Input Unggah Gambar Kategori -->
                <div class="space-y-2 sm:col-span-2">
                    <label class="block font-label-caps text-label-caps text-on-surface-variant">Category Image</label>
                    <div class="flex items-center gap-4 p-4 border border-dashed border-outline-variant/30 rounded-xl bg-surface-container-low/20">
                        <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary shrink-0 overflow-hidden border border-outline-variant/10">
                            <span class="material-symbols-outlined text-[24px]">image</span>
                        </div>
                        <input type="file" name="category_image" id="category_image" accept="image/*" required
                               class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer transition-all">
                    </div>
                    @error('category_image') <p class="text-error text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="border-t border-outline-variant/10 pt-6 flex justify-end gap-3">
                <a href="{{ route('categories.index') }}"
                   class="px-6 py-2.5 rounded-xl border border-outline-variant/30 text-on-surface-variant font-title-sm text-title-sm hover:bg-surface-container transition-all">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-secondary-container text-on-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:brightness-110 transition-all luxury-shadow active:scale-95 duration-200">
                    <span class="material-symbols-outlined text-sm">save</span>
                    <span>Save Category</span>
                </button>
            </div>
        </form>
    </div>
</main>

<!-- Otomatisasi Pembuatan Slug Berbasis JavaScript -->
<script>
    const nameInput = document.getElementById('category_name');
    const slugInput = document.getElementById('category_slug');

    nameInput.addEventListener('input', function() {
        let text = this.value.toLowerCase();
        text = text.replace(/[^a-z0-9 -]/g, '') // Hapus karakter ilegal
                   .replace(/\s+/g, '-')       // Ganti spasi dengan tanda minus
                   .replace(/-+/g, '-');       // Hapus minus ganda
        slugInput.value = text;
    });
</script>
@endsection