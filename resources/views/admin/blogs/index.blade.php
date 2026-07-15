@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto space-y-8">
    
    <!-- HEADER UTAMA -->
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-outline-variant/10 pb-6">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <span class="text-primary font-bold uppercase">EDITORIAL & STORIES</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Blogs Hub Workspace</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Pusat kendali narasi artikel, edukasi wewangian, dan manajemen taksonomi kategori.</p>
        </div>
        
        <!-- KOMPONEN INTERAKTIF TAB SWITCH (EFEK CAPSULE MEWAH) -->
        <div class="bg-surface-container-low p-1 rounded-xl border border-outline-variant/30 flex items-center shadow-inner">
            <button type="button" id="tab-posts-btn" onclick="switchTab('posts')"
                class="px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all duration-200 cursor-pointer bg-primary text-white shadow-sm">
                <span class="material-symbols-outlined text-sm">article</span>
                <span>Articles ({{ $blogs->count() }})</span>
            </button>
            <button type="button" id="tab-categories-btn" onclick="switchTab('categories')"
                class="px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all duration-200 cursor-pointer text-on-surface-variant hover:text-primary">
                <span class="material-symbols-outlined text-sm">bookmarks</span>
                <span>Categories ({{ $categories->count() }})</span>
            </button>
        </div>
    </section>

    <!-- ALERTS LOG -->
    @if(session('success_message'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-2 animate-fade-in">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('success_message') }}
        </div>
    @endif
    @if(session('error_message'))
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl text-xs font-semibold flex items-center gap-2 animate-fade-in">
            <span class="material-symbols-outlined text-sm">error</span>
            {{ session('error_message') }}
        </div>
    @endif

    <!-- ================= TAB CONTENT 1: ARTICLES (POSTS) ================= -->
    <div id="panel-posts" class="tab-panel transition-all duration-300 transform opacity-100 scale-100">
        <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10">
            <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between bg-gray-50/20">
                <span class="font-title-sm text-title-sm text-primary font-bold">Article Post Directory</span>
                <a href="{{ route('blogs.create') }}" class="px-4 py-2 bg-secondary-container text-on-primary rounded-xl text-xs font-bold flex items-center gap-1.5 hover:brightness-110 transition-all active:scale-95 duration-150">
                    <span class="material-symbols-outlined text-sm">edit_note</span>
                    <span>Write New Post</span>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/30 text-xs uppercase tracking-wider text-on-surface-variant">
                            <th class="px-8 py-4 font-bold border-b border-outline-variant/10">Title & Category</th>
                            <th class="px-6 py-4 font-bold border-b border-outline-variant/10">Author</th>
                            <th class="px-6 py-4 font-bold border-b border-outline-variant/10">Status</th>
                            <th class="px-8 py-4 font-bold border-b border-outline-variant/10 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @forelse($blogs as $blog)
                            <tr data-href="{{ route('blogs.show', $blog->id) }}" class="blog-row hover:bg-surface-container-low transition-colors group relative cursor-pointer select-none">
                                <td class="px-8 py-4"> <!-- Mengurangi padding vertical sedikit agar row lebih proporsional dengan gambar -->
                                    <div class="flex items-center gap-4">
                                        <!-- 📸 PREVIEW GAMBAR KECIL (THUMBNAIL) -->
                                        <div class="w-14 h-10 rounded-lg bg-surface-container overflow-hidden border border-outline-variant/30 flex-shrink-0 flex items-center justify-center text-primary relative shadow-sm group-hover:border-primary/30 transition-colors">
                                            @if(!empty($blog->image) && file_exists(public_path('admin/images/blogs/' . $blog->image)))
                                                <img src="{{ asset('admin/images/blogs/' . $blog->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else 
                                                <span class="material-symbols-outlined text-lg text-on-surface-variant/50">image</span> 
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <p class="font-title-sm text-title-sm text-primary font-bold line-clamp-1 max-w-md group-hover:text-primary/80 transition-colors">{{ $blog->title }}</p>
                                            <p class="text-[10px] text-secondary font-bold uppercase tracking-wider mt-0.5">{{ $blog->category->name ?? 'Uncategorized' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-on-surface-variant text-sm font-medium">{{ $blog->author->name ?? 'Administrator' }}</td>
                                <td class="px-6 py-5">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $blog->status == 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} uppercase tracking-wide">{{ $blog->status }}</span>
                                </td>
                                <td class="px-8 py-5 text-right flex items-center justify-end gap-3 min-h-[77px]">
                                    <div class="action-area absolute opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 flex items-center gap-2 pr-4 bg-transparent">
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-primary/10 text-on-surface-variant hover:text-primary text-xs font-bold rounded-xl border border-outline-variant/20 shadow-sm"><span class="material-symbols-outlined text-[18px]">edit</span><span>Edit</span></a>
                                        <button type="button" onclick="openDeleteModal('blog', '{{ $blog->id }}', '{{ addslashes($blog->title) }}')" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-error/10 text-on-surface-variant hover:text-error text-xs font-bold rounded-xl border border-outline-variant/20 shadow-sm cursor-pointer"><span class="material-symbols-outlined text-[18px]">delete</span><span>Delete</span></button>
                                        <form id="delete-blog-form-{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-8 py-12 text-center text-on-surface-variant text-sm">Belum ada artikel editorial yang diterbitkan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= TAB CONTENT 2: CATEGORIES (HIDDEN BY DEFAULT) ================= -->
    <div id="panel-categories" class="tab-panel hidden transition-all duration-300 transform opacity-0 scale-95">
        <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10 max-w-4xl">
            <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between bg-gray-50/20">
                <span class="font-title-sm text-title-sm text-primary font-bold">Taxonomy Classifications</span>
                <a href="{{ route('blog-categories.create') }}" class="px-4 py-2 bg-primary text-white rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-primary/90 transition-all active:scale-95 duration-150">
                    <span class="material-symbols-outlined text-sm">bookmark_add</span>
                    <span>Add New Category</span>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/30 text-xs uppercase tracking-wider text-on-surface-variant">
                            <th class="px-8 py-4 font-bold border-b border-outline-variant/10">Category Name</th>
                            <th class="px-6 py-4 font-bold border-b border-outline-variant/10">URL Slug</th>
                            <th class="px-8 py-4 font-bold border-b border-outline-variant/10 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10 text-sm">
                        @forelse($categories as $category)
                            <tr data-href="{{ route('blog-categories.show', $category->id) }}" 
                                class="blog-row hover:bg-surface-container-low transition-colors group relative cursor-pointer select-none">
                                
                                <td class="px-8 py-5 font-bold text-primary flex items-center gap-3">
                                    <span class="material-symbols-outlined text-gray-400 text-lg">label</span>
                                    <span>{{ $category->name }}</span>
                                </td>
                                <td class="px-6 py-5 font-mono text-xs text-on-surface-variant/80">{{ $category->slug }}</td>
                                <td class="px-8 py-5 text-right flex items-center justify-end gap-3 min-h-[60px]">
                                    <div class="action-area absolute opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200 flex items-center gap-2 pr-4 bg-transparent">
                                        <a href="{{ route('blog-categories.edit', $category->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-primary/10 text-on-surface-variant hover:text-primary text-xs font-bold rounded-xl border border-outline-variant/20 shadow-sm"><span class="material-symbols-outlined text-[16px]">edit</span><span>Edit</span></a>
                                        <button type="button" onclick="openDeleteModal('category', '{{ $category->id }}', '{{ addslashes($category->name) }}')" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-error/10 text-on-surface-variant hover:text-error text-xs font-bold rounded-xl border border-outline-variant/20 shadow-sm cursor-pointer"><span class="material-symbols-outlined text-[16px]">delete</span><span>Delete</span></button>
                                        <form id="delete-category-form-{{ $category->id }}" action="{{ route('blog-categories.destroy', $category->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-8 py-10 text-center text-on-surface-variant italic">Belum ada kategori blog yang didaftarkan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL POPUP HAPUS DINAMIS -->
    <div id="luxuryDeleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
        <div class="absolute inset-0 bg-[#081828]/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
        <div class="bg-white rounded-2xl border border-outline-variant/10 shadow-2xl max-w-md w-full overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10" id="modalCard">
            <div class="p-6 flex gap-4 items-start bg-surface-container-low/30 border-b border-outline-variant/10">
                <div class="w-10 h-10 rounded-xl bg-error-container/10 flex items-center justify-center text-error shrink-0 border border-error/10"><span class="material-symbols-outlined text-[22px]">warning</span></div>
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-primary uppercase tracking-wide">Confirm Deletion</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Apakah Anda yakin ingin menghapus elemen <span id="deleteItemTitle" class="font-bold text-primary"></span> secara permanen?</p>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50/50 flex items-center justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl border border-outline-variant/30 text-on-surface-variant text-xs font-bold hover:bg-surface-container transition-colors cursor-pointer">Batal</button>
                <button type="button" id="confirmDeleteBtn" class="px-5 py-2.5 bg-error text-on-error rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-error/90 transition-all shadow-md active:scale-95 duration-150 cursor-pointer"><span class="material-symbols-outlined text-sm">delete_forever</span>Hapus</button>
            </div>
        </div>
    </div>
</main>

<!-- JAVASCRIPT TAB SWITCH & MODAL CONTROLLER -->
<script>
    let activeId = null;
    let activeType = null;

    // FUNGSI UTAMA ENGINE TAB SWITCHING
    function switchTab(tabName) {
        const postsBtn = document.getElementById('tab-posts-btn');
        const categoriesBtn = document.getElementById('tab-categories-btn');
        const postsPanel = document.getElementById('panel-posts');
        const categoriesPanel = document.getElementById('panel-categories');

        if (tabName === 'posts') {
            // Aktifkan Button Posts
            postsBtn.className = "px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all duration-200 cursor-pointer bg-primary text-white shadow-sm";
            categoriesBtn.className = "px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all duration-200 cursor-pointer text-on-surface-variant hover:text-primary";
            
            // Munculkan Panel Posts dengan Efek Animasi
            categoriesPanel.classList.add('hidden');
            postsPanel.classList.remove('hidden');
            setTimeout(() => {
                postsPanel.classList.remove('opacity-0', 'scale-95');
                postsPanel.classList.add('opacity-100', 'scale-100');
            }, 20);

        } else if (tabName === 'categories') {
            // Aktifkan Button Categories
            categoriesBtn.className = "px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all duration-200 cursor-pointer bg-primary text-white shadow-sm";
            postsBtn.className = "px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all duration-200 cursor-pointer text-on-surface-variant hover:text-primary";
            
            // Munculkan Panel Categories dengan Efek Animasi
            postsPanel.classList.add('hidden');
            categoriesPanel.classList.remove('hidden');
            setTimeout(() => {
                categoriesPanel.classList.remove('opacity-0', 'scale-95');
                categoriesPanel.classList.add('opacity-100', 'scale-100');
            }, 20);
        }
    }

    function openDeleteModal(type, id, title) {
        activeId = id;
        activeType = type;
        document.getElementById('deleteItemTitle').innerText = `"${title}"`;
        const modal = document.getElementById('luxuryDeleteModal');
        const card = document.getElementById('modalCard');
        modal.classList.remove('hidden');
        setTimeout(() => { card.classList.remove('scale-95', 'opacity-0'); card.classList.add('scale-100', 'opacity-100'); }, 20);
    }

    function closeDeleteModal() {
        const card = document.getElementById('modalCard');
        const modal = document.getElementById('luxuryDeleteModal');
        card.classList.remove('scale-100', 'opacity-100'); card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modal.classList.add('hidden'); activeId = null; activeType = null; }, 300);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
            if (activeId && activeType) {
                document.getElementById(`delete-${activeType}-form-${activeId}`).submit();
            }
        });
        document.querySelectorAll('.blog-row').forEach(row => {
            row.addEventListener('click', function(e) {
                if (!e.target.closest('.action-area')) {
                    const url = this.getAttribute('data-href');
                    if (url) window.location.href = url;
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // ... kode logika hapus dan klik baris yang sudah ada sebelumnya ...

        // 🛠️ Logika Deteksi Session Flash dari Laravel Controller untuk Mengunci Tab aktif
        @if(session('current_tab') === 'categories')
            switchTab('categories');
        @endif
    });
</script>
@endsection