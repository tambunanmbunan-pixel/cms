@extends('admin.layout.layout')

@section('content')
        <!-- Main Content Canvas -->
        <main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
            <!-- Header & Toolbar -->
            <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                        <a href="{{ route('categories.index') }}" class="hover:text-primary cursor-pointer transition-colors">INVENTORY</a>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <a href="{{ route('categories.index') }}" class="hover:text-primary cursor-pointer transition-colors">PRODUCT CATEGORIES</a>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <span class="text-primary font-bold">EDIT CATEGORY</span>
                    </nav>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Edit Category</h3>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">Modify the details of your fragrance classification.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('categories.index') }}" class="px-6 py-2.5 bg-surface-container text-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:bg-surface-container-highest transition-all active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        <span>Back to List</span>
                    </a>
                </div>
            </section>

            <!-- Form Card Layout Bento Box -->
            <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10 max-w-2xl">
                <div class="px-8 py-5 border-b border-outline-variant/10 bg-surface-container-low/50">
                    <span class="font-title-sm text-title-sm text-primary font-bold">Category Details</span>
                </div>

                <!-- Notifikasi Error dari Oracle -->
                @if(session('error_message'))
                    <div class="m-6 p-4 bg-error-container/20 border border-error/20 text-error rounded-xl text-xs font-semibold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        {{ session('error_message') }}
                    </div>
                @endif
                
                {{-- JALUR AMAN ORACLE: Memaksa pengecekan variasi nama ID (id kecil, ID besar, atau array key) --}}
                <form action="{{ route('categories.update', $category->id ?? $category->ID ?? $category->getKey()) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Input Nama Kategori -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-primary">Category Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" 
                                   class="w-full px-4 py-3 border border-outline-variant/30 rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all text-sm @error('name') border-error @enderror" 
                                   placeholder="e.g., Oud & Woods" required>
                            @error('name')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Real-Time Slug Preview -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-primary">Slug Preview (URL)</label>
                            <input type="text" id="slug_preview" value="{{ $category->slug }}" readonly
                                   class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant/20 rounded-xl text-sm font-mono text-on-surface-variant focus:outline-none">
                            <p class="text-[11px] text-on-surface-variant">Generated automatically to preserve URL path health.</p>
                        </div>

                        <!-- Input Deskripsi Kategori -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-primary">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $category->description) }}" required
                                   class="w-full px-4 py-3 border border-outline-variant/30 rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all text-sm @error('description') border-error @enderror" 
                                   placeholder="e.g., Intense, earthy and musky fragrance notes">
                            @error('description')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Unggah Gambar Kategori -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-primary">Category Image</label>
                            <div class="flex items-center gap-5 p-4 border border-dashed border-outline-variant/30 rounded-xl bg-surface-container-low/20">
                                <!-- Pratinjau Gambar Saat Ini -->
                                <div class="w-16 h-16 rounded-xl bg-surface-container flex items-center justify-center text-primary shrink-0 overflow-hidden border border-outline-variant/10 shadow-sm">
                                    @if(!empty($category->category_image) && file_exists(public_path('admin/images/categories/' . $category->category_image)))
                                        <img src="{{ asset('admin/images/categories/' . $category->category_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="material-symbols-outlined text-[28px]">image</span>
                                    @endif
                                </div>
                                <div class="space-y-1 w-full">
                                    <input type="file" name="category_image" id="category_image" accept="image/*"
                                           class="block w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer transition-all">
                                    <p class="text-[10px] text-on-surface-variant">Pilih file baru jika ingin memperbarui gambar ikon bento (Format: JPG, PNG. Maks: 2MB).</p>
                                </div>
                            </div>
                            @error('category_image')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons inside Form -->
                    <div class="pt-4 border-t border-outline-variant/10 flex items-center justify-end gap-3">
                        <a href="{{ route('categories.index') }}" class="px-5 py-2.5 text-sm font-medium text-on-surface-variant hover:text-primary transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-primary text-on-primary rounded-xl font-title-sm text-sm hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Script Live Slug Preview -->
        <script>
            const nameField = document.getElementById('name');
            const slugField = document.getElementById('slug_preview');

            nameField.addEventListener('input', function() {
                let text = this.value.toLowerCase();
                text = text.replace(/[^a-z0-9 -]/g, '')
                           .replace(/\s+/g, '-')       
                           .replace(/-+/g, '-');       
                slugField.value = text;
            });
        </script>
@endsection