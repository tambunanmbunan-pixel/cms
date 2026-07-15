@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('blogs.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BLOG HUB</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">CATEGORY DETAILS</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Taxonomy Specifications</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Rincian parameter data klasifikasi kategori blog dari database Oracle.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('blogs.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant hover:text-primary rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span><span>Kembali</span>
            </a>
            <a href="{{ route('blog-categories.edit', $category->id) }}" class="px-5 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">edit</span><span>Edit Kategori</span>
            </a>
        </div>
    </section>

    <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 p-8 max-w-xl space-y-6">
        <div class="flex items-center gap-4 border-b border-gray-100 pb-5">
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl">bookmarks</span>
            </div>
            <div>
                <h4 class="text-lg font-black text-primary uppercase tracking-wide">{{ $category->name }}</h4>
                <p class="text-xs text-on-surface-variant">ID Taksonomi: <span class="font-mono font-bold">{{ $category->id }}</span></p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="p-4 bg-gray-50/60 rounded-xl border">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Sistem URL Slug</p>
                <p class="text-sm font-mono font-bold text-primary mt-1">{{ $category->slug }}</p>
            </div>
            
            <div class="p-4 bg-gray-50/60 rounded-xl border flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Total Relasi Konten</p>
                    <p class="text-base font-black text-primary mt-1">{{ $category->posts->count() }} <span class="text-xs font-medium text-gray-400">Artikel terkait</span></p>
                </div>
                <span class="material-symbols-outlined text-gray-300 text-3xl">article</span>
            </div>
        </div>

        <div class="space-y-2 text-xs pt-3 border-t border-gray-100">
            <div class="flex justify-between"><span class="text-on-surface-variant">Created At:</span><span class="text-primary font-medium">{{ $category->created_at ? $category->created_at->format('M d, Y - H:i') : '-' }}</span></div>
            <div class="flex justify-between"><span class="text-on-surface-variant">Updated At:</span><span class="text-primary font-medium">{{ $category->updated_at ? $category->updated_at->format('M d, Y - H:i') : '-' }}</span></div>
        </div>
    </div>
</main>
@endsection