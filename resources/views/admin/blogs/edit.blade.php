@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('blogs.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BLOGS</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">EDIT POST</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Modify Post</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Perbarui atau sunting kembali draf materi tulisan editorial.</p>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 overflow-hidden">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Judul Artikel *</label>
                        <input type="text" name="title" required value="{{ old('title', $blog->title) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Kategori Editorial *</label>
                            <select name="blog_category_id" required class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 cursor-pointer">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $blog->blog_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Status Publikasi *</label>
                            <select name="status" required class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 cursor-pointer">
                                <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Isi Konten Artikel *</label>
                        <textarea name="content" rows="12" required class="w-full px-4 py-3 rounded-xl border border-outline-variant/40 text-sm focus:border-primary focus:ring-0 bg-gray-50/30 transition-all resize-none">{{ old('content', $blog->content) }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Article Cover Banner</label>
                    <div class="border-2 border-dashed border-outline-variant/60 rounded-2xl p-4 text-center flex flex-col items-center justify-center bg-gray-50/30 min-h-[250px] relative overflow-hidden group">
                        @if(!empty($blog->image) && file_exists(public_path('admin/images/blogs/' . $blog->image)))
                            <img src="{{ asset('admin/images/blogs/' . $blog->image) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white pointer-events-none">
                                <span class="material-symbols-outlined text-xl mb-1">upload_file</span>
                                <p class="text-[10px] font-bold uppercase tracking-wider">Change Image</p>
                            </div>
                        @else
                            <span class="material-symbols-outlined text-3xl text-outline/60 mb-2">image</span>
                            <p class="text-xs text-primary mb-1">Ganti Cover</p>
                        @endif
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="border-t border-outline-variant/10 pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('blogs.index') }}" class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all active:scale-95 duration-200 shadow-md">
                    <span class="material-symbols-outlined text-sm">save_as</span><span>Update Post</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection