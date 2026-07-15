@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('blogs.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BLOG HUB</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">CREATE CATEGORY</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Add Blog Category</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Daftarkan taksonomi klasifikasi materi artikel baru ke database Oracle.</p>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden max-w-2xl">
        <form action="{{ route('blog-categories.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Nama Kategori Blog *</label>
                    <input type="text" name="name" id="cat_name" required placeholder="Contoh: Perfume Tips, Olfactory Science" 
                        class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                    @error('name') <p class="text-xs text-error mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <!-- 🛠️ Kolom URL Slug Preview Dinamis -->
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">URL Slug Preview (Auto)</label>
                    <input type="text" name="slug" id="cat_slug" readonly placeholder="perfume-tips" 
                        class="w-full px-4 py-3 rounded-xl border border-outline-variant/20 text-sm bg-surface-container/40 text-on-surface-variant/70 font-mono text-xs focus:ring-0 outline-none">
                </div>
            </div>

            <div class="border-t border-outline-variant/10 pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('blogs.index') }}" class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all active:scale-95 duration-200 shadow-md">
                    <span class="material-symbols-outlined text-sm">save</span><span>Save Category</span>
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const catName = document.getElementById('cat_name');
        const catSlug = document.getElementById('cat_slug');

        if (catName && catSlug) {
            catName.addEventListener('input', function() {
                let slug = this.value.toLowerCase()
                               .replace(/[^a-z0-9\s-]/g, '')
                               .replace(/\s+/g, '-')
                               .replace(/-+/g, '-');
                catSlug.value = slug;
            });
        }
    });
</script>
@endsection