@extends('admin.layout.layout')

@section('content')
        <main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
            
            <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                        <a href="{{ route('categories.index') }}" class="hover:text-primary cursor-pointer transition-colors">INVENTORY</a>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <a href="{{ route('categories.index') }}" class="hover:text-primary cursor-pointer transition-colors">PRODUCT CATEGORIES</a>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <span class="text-primary font-bold uppercase">Category Details</span>
                    </nav>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Category Overview</h3>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">Detailed structural profile for this fragrance classification.</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('categories.index') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-surface-container text-primary rounded-xl text-xs font-bold border border-outline-variant/20 hover:bg-surface-container-highest transition-all duration-150 shadow-sm active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span>Back to List</span>
                    </a>
                    <a href="{{ route('categories.edit', $category->id) }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-secondary-container text-on-primary rounded-xl text-xs font-bold hover:brightness-110 transition-all luxury-shadow active:scale-95 duration-150">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        <span>Edit Category</span>
                    </a>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-xl luxury-shadow border border-outline-variant/10 p-6 flex flex-col items-center text-center justify-between min-h-[320px]">
                    <div class="w-full space-y-4">
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-extrabold uppercase tracking-widest rounded-full border border-primary/20 inline-block">
                            Hierarchy Node
                        </span>
                        
                        <div class="w-20 h-20 rounded-2xl bg-surface-container flex items-center justify-center text-primary mx-auto border border-outline-variant/10 shadow-sm">
                            <span class="material-symbols-outlined text-[42px]">folder_open</span>
                        </div>
                        
                        <div class="space-y-1">
                            <h4 class="text-xl font-extrabold text-primary tracking-tight">{{ $category->name }}</h4>
                            <p class="text-mono text-xs text-on-surface-variant bg-surface-container/50 px-2.5 py-1 rounded-lg inline-block">
                                {{ $category->slug }}
                            </p>
                        </div>
                    </div>

                    <div class="w-full border-t border-outline-variant/10 pt-4 mt-6 grid grid-cols-2 gap-2 text-left">
                        <div class="bg-surface-container-low/50 p-3 rounded-xl border border-outline-variant/5">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Total Products</p>
                            <p class="text-base font-extrabold text-primary">0 Items</p>
                        </div>
                        <div class="bg-surface-container-low/50 p-3 rounded-xl border border-outline-variant/5">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Activity Status</p>
                            <p class="text-xs font-bold text-emerald-600 inline-flex items-center gap-1 mt-0.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Synchronized
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white rounded-xl luxury-shadow border border-outline-variant/10 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="px-8 py-5 border-b border-outline-variant/10 bg-surface-container-low/30">
                            <span class="font-title-sm text-title-sm text-primary font-bold">Metadata Records</span>
                        </div>
                        
                        <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                            <div class="space-y-1.5">
                                <span class="block font-label-caps text-label-caps text-on-surface-variant text-[11px] tracking-wider">Database Object ID</span>
                                <p class="font-mono font-bold text-primary bg-surface-container px-3 py-2 rounded-xl border border-outline-variant/10 inline-block">
                                    #{{ $category->id }}
                                </p>
                            </div>

                            <div class="space-y-1.5">
                                <span class="block font-label-caps text-label-caps text-on-surface-variant text-[11px] tracking-wider">Classification Level</span>
                                <p class="font-semibold text-primary py-2 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-secondary">layers</span>
                                    Primary Parent Category
                                </p>
                            </div>

                            <div class="space-y-1.5">
                                <span class="block font-label-caps text-label-caps text-on-surface-variant text-[11px] tracking-wider">Created Timestamp (Oracle)</span>
                                <p class="font-medium text-primary py-1 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant">calendar_today</span>
                                    {{ $category->created_at ? $category->created_at->format('l, d F Y - H:i') : 'Data awal seeder' }}
                                </p>
                            </div>

                            <div class="space-y-1.5">
                                <span class="block font-label-caps text-label-caps text-on-surface-variant text-[11px] tracking-wider">Last Modified Record</span>
                                <p class="font-medium text-primary py-1 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-on-surface-variant">history</span>
                                    {{ $category->updated_at ? $category->updated_at->format('l, d F Y - H:i') : 'Belum pernah diubah' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mx-8 mb-8 p-4 bg-surface-container-low rounded-xl border border-outline-variant/20 flex items-start gap-3 text-xs text-on-surface-variant leading-relaxed">
                        <span class="material-symbols-outlined text-primary text-[18px]">info</span>
                        <div>
                            <span class="font-bold text-primary block mb-0.5">System Information Note</span>
                            Kategori ini berfungsi sebagai wadah hierarki pengelompokan produk parfum di inventaris. Perubahan pada nama kategori akan otomatis menyesuaikan susunan rute *slug* pada tautan katalog publik.
                        </div>
                    </div>
                </div>

            </div>
        </main>
@endsection