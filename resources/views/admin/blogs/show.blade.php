@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('blogs.index') }}" class="hover:text-primary cursor-pointer transition-colors uppercase">BLOGS</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold uppercase">ARTICLE PREVIEW</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Editorial Preview</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Peninjauan tata letak paragraf narasi sebelum dibaca oleh konsumen.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('blogs.index') }}" class="px-5 py-2.5 bg-surface-container border border-outline-variant/30 text-on-surface-variant rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-surface-container/80 transition-all active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">arrow_back</span><span>Kembali</span>
            </a>
            <a href="{{ route('blogs.edit', $blog->id) }}" class="px-5 py-2.5 bg-primary text-white rounded-xl font-title-sm text-xs font-bold flex items-center gap-2 hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200">
                <span class="material-symbols-outlined text-sm">edit</span><span>Edit Post</span>
            </a>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-2xl luxury-shadow border p-8 space-y-6">
            <div class="space-y-3">
                <span class="px-3 py-1 bg-secondary-container text-primary rounded-xl text-[10px] font-bold uppercase tracking-wider">
                    {{ $blog->category->name ?? 'Uncategorized' }}
                </span>
                <h1 class="text-2xl md:text-4xl font-black text-primary leading-tight tracking-tight">{{ $blog->title }}</h1>
                <div class="flex items-center gap-3 text-xs text-on-surface-variant/70 border-b border-primary/5 pb-4">
                    <span class="font-medium text-primary">By: {{ $blog->author->name ?? 'Administrator' }}</span>
                    <span>•</span>
                    <span>{{ $blog->created_at->format('M d, Y - H:i') }}</span>
                </div>
            </div>

            <div class="text-sm text-on-surface-variant leading-relaxed whitespace-pre-line space-y-4">
                {{ $blog->content }}
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-2xl luxury-shadow border border-outline-variant/10 p-6 text-center">
                <div class="relative aspect-[16/10] w-full rounded-xl border bg-gray-50 overflow-hidden flex items-center justify-center mb-4">
                    @if(!empty($blog->image) && file_exists(public_path('admin/images/blogs/' . $blog->image)))
                        <img src="{{ asset('admin/images/blogs/' . $blog->image) }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-4xl text-outline/40">image</span>
                    @endif
                </div>
                
                <div class="text-left space-y-3 pt-2 text-xs border-t">
                    <div class="flex justify-between"><span class="text-on-surface-variant">Status:</span><span class="font-bold text-primary uppercase">{{ $blog->status }}</span></div>
                    <div class="flex justify-between"><span class="text-on-surface-variant">Slug URL:</span><span class="font-mono text-primary truncate max-w-[150px]">{{ $blog->slug }}</span></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection