@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('blogs.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BLOGS</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">WRITE POST</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Compose Article</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Tulis ulasan informatif, tren parfum, atau panduan wewangian baru.</p>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden">
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sisi Kiri: Informasi Artikel & Konten -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Judul Artikel *</label>
                            <input type="text" name="title" id="article_title" required placeholder="Contoh: Mengungkap Filosofi di Balik Kehangatan Aroma Oud" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                        </div>
                        <div>
                            <!-- 🛠️ Ditambahkan: Kolom URL Slug Dinamis -->
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">URL Slug Preview (Auto-generated)</label>
                            <input type="text" name="slug" id="article_slug" readonly placeholder="mengungkap-filosofi-di-balik-kehangatan-aroma-oud" 
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant/20 text-sm bg-surface-container/40 text-on-surface-variant/70 font-mono text-xs focus:ring-0 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Kategori Editorial *</label>
                            <select name="blog_category_id" required class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 cursor-pointer">
                                <option value="" disabled selected>Pilih Kategori Blog</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Status Publikasi *</label>
                            <select name="status" required class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 cursor-pointer">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Isi Konten Artikel *</label>
                        <textarea name="content" rows="12" required placeholder="Tulis esai naratif lengkap di sini..." 
                            class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all resize-none"></textarea>
                    </div>
                </div>

                <!-- Sisi Kanan: Upload Image & Preview Area -->
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Article Cover Banner</label>
                    
                    <!-- 🛠️ Diperbarui: Box dropzone dengan wadah penampung preview gambar -->
                    <div class="border-2 border-dashed border-outline-variant/60 rounded-2xl p-6 text-center flex flex-col items-center justify-center bg-gray-50/30 min-h-[280px] hover:border-primary/40 group transition-all relative overflow-hidden">
                        
                        <!-- Wrapper Konten Default -->
                        <div id="upload-placeholder" class="flex flex-col items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-outline/60 mb-3 group-hover:text-primary transition-colors">image</span>
                            <p class="text-xs font-medium text-primary mb-1">Upload Banner Utama</p>
                            <p class="text-[10px] text-on-surface-variant/70 mb-4">Format Gambar maksimal 2MB</p>
                        </div>

                        <!-- Element Preview Image (Tersembunyi di awal) -->
                        <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 z-10 pointer-events-none">
                        
                        <!-- Lapisan Overlay ketika ada gambar yang di-hover -->
                        <div id="preview-overlay" class="hidden absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity z-20 flex flex-col items-center justify-center text-white pointer-events-none">
                            <span class="material-symbols-outlined text-2xl mb-1">upload_file</span>
                            <p class="text-[10px] font-bold uppercase tracking-wider">Ganti Cover Banner</p>
                        </div>

                        <input type="file" name="image" id="image-input" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30">
                    </div>
                </div>
            </div>

            <div class="border-t border-outline-variant/10 pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('blogs.index') }}" class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all active:scale-95 duration-200 shadow-md">
                    <span class="material-symbols-outlined text-sm">history_edu</span><span>Publish Post</span>
                </button>
            </div>
        </form>
    </div>
</main>

<!-- JAVASCRIPT LOGIC CONTROLLER -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('article_title');
        const slugInput = document.getElementById('article_slug');
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const uploadPlaceholder = document.getElementById('upload-placeholder');
        const previewOverlay = document.getElementById('preview-overlay');

        // 🧠 1. Live Slug Generator (Mengubah ketikan judul menjadi string URL-friendly)
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                let text = this.value;
                let slug = text.toLowerCase()
                               .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter spesial
                               .replace(/\s+/g, '-')         // Ganti spasi dengan tanda minus
                               .replace(/-+/g, '-');         // Hapus tanda minus berlebih
                slugInput.value = slug;
            });
        }

        // 🧠 2. Live Image Preview Reader
        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    
                    reader.addEventListener('load', function() {
                        imagePreview.setAttribute('src', this.result);
                        imagePreview.classList.remove('hidden');
                        uploadPlaceholder.classList.add('hidden');
                        previewOverlay.classList.remove('hidden');
                    });
                    
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('hidden');
                    uploadPlaceholder.classList.remove('hidden');
                    previewOverlay.classList.add('hidden');
                    imagePreview.setAttribute('src', '');
                }
            });
        }
    });
</script>
@endsection