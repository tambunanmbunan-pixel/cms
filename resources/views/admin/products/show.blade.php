@extends('admin.layout.layout')

@section('content')
        <main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
            @php 
                $prdId = $product->getKey() ?? $product->id ?? $product->ID; 
            @endphp

            <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                <div>
                    <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                        <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">PRODUCTS</a>
                        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                        <span class="text-primary font-bold">FRAGRANCE DETAILS</span>
                    </nav>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">{{ $product->name }}</h3>
                    <p class="text-on-surface-variant font-body-md text-sm mt-1">Detailed sensory architecture and inventory telemetry for master token {{ $prdId }}.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-surface-container hover:bg-surface-container-high text-on-surface-variant rounded-xl font-title-sm text-title-sm flex items-center gap-2 border border-outline-variant/30 transition-all active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        <span>Back to Catalog</span>
                    </a>
                    <a href="{{ route('products.edit', $prdId) }}" class="px-6 py-2.5 bg-primary text-on-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        <span>Edit Fragrance</span>
                    </a>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                        <div class="w-full aspect-square rounded-2xl border border-outline-variant/20 bg-surface-container-low overflow-hidden flex items-center justify-center shadow-inner">
                            @if(!empty($product->featured_image) && file_exists(public_path('admin/images/products/' . $product->featured_image)))
                                <img src="{{ asset('admin/images/products/' . $product->featured_image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-gray-300 text-6xl">science</span>
                            @endif
                        </div>
                        <div class="md:col-span-2 space-y-4">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-lg uppercase tracking-wider">
                                Master Product Profile
                            </span>
                            <h4 class="text-2xl font-extrabold text-primary tracking-tight">{{ $product->name }}</h4>
                            
                            <div class="space-y-1.5">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Assigned Categories</p>
                                <div class="flex flex-wrap gap-2">
                                    @forelse($product->categories as $category)
                                        <span class="px-3 py-1 bg-primary/5 text-primary text-xs font-bold rounded-xl border border-primary/10 uppercase tracking-wide">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">Uncategorized</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="pt-2 border-t border-gray-100 space-y-1">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">General Description</p>
                                <p class="text-sm text-on-surface-variant leading-relaxed">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-6">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-md">blur_on</span>
                            <span>The Olfactory Journey</span>
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-5 bg-orange-50/40 rounded-xl border border-orange-100/70 space-y-2">
                                <div class="flex items-center gap-2 text-orange-800 font-bold text-xs uppercase tracking-wider">
                                    <span class="w-6 h-6 rounded-lg bg-orange-100 flex items-center justify-center text-xs">1</span>
                                    <span>Top Notes</span>
                                </div>
                                <p class="text-sm text-primary font-medium pl-1">{{ $product->detail->top_notes ?? '-' }}</p>
                                <p class="text-[10px] text-orange-600/70 pl-1 italic">First impression impact</p>
                            </div>

                            <div class="p-5 bg-rose-50/40 rounded-xl border border-rose-100/70 space-y-2">
                                <div class="flex items-center gap-2 text-rose-800 font-bold text-xs uppercase tracking-wider">
                                    <span class="w-6 h-6 rounded-lg bg-rose-100 flex items-center justify-center text-xs">2</span>
                                    <span>Heart Notes</span>
                                </div>
                                <p class="text-sm text-primary font-medium pl-1">{{ $product->detail->heart_notes ?? '-' }}</p>
                                <p class="text-[10px] text-rose-600/70 pl-1 italic">Core theme signature</p>
                            </div>

                            <div class="p-5 bg-amber-50/40 rounded-xl border border-amber-100/70 space-y-2">
                                <div class="flex items-center gap-2 text-amber-800 font-bold text-xs uppercase tracking-wider">
                                    <span class="w-6 h-6 rounded-lg bg-amber-100 flex items-center justify-center text-xs">3</span>
                                    <span>Base Notes</span>
                                </div>
                                <p class="text-sm text-primary font-medium pl-1">{{ $product->detail->base_notes ?? '-' }}</p>
                                <p class="text-[10px] text-amber-600/70 pl-1 italic">Evolving dry-down longevity</p>
                            </div>
                        </div>

                        <div class="p-5 bg-gray-50 rounded-xl border border-outline-variant/10 space-y-1.5">
                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">auto_awesome</span>
                                <span>Atmospheric Narrative</span>
                            </p>
                            <p class="text-sm text-primary italic leading-relaxed">
                                "{{ $product->detail->atmospheric_narrative ?? 'No sensory narrative compiled for this variant.' }}"
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    
                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-5">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-md">analytics</span>
                            <span>Inventory Metrics</span>
                        </h4>

                        <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                            <span class="text-xs text-on-surface-variant font-medium">Retail Price</span>
                            <span class="text-lg font-extrabold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                            <span class="text-xs text-on-surface-variant font-medium">Stock Availability</span>
                            <span class="text-sm font-bold {{ $product->stock > 10 ? 'text-primary' : 'text-error' }}">
                                {{ $product->stock }} <span class="text-xs text-gray-400 font-normal">units remaining</span>
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-xs text-on-surface-variant font-medium">Status</span>
                            <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase rounded-full {{ $product->status == 'Active' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->status }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl luxury-shadow border border-outline-variant/10 space-y-4">
                        <h4 class="text-sm font-bold text-primary uppercase tracking-wider border-b border-gray-100 pb-2 flex items-center gap-2">
                            <span class="material-symbols-outlined text-md">grid_view</span>
                            <span>Technical Properties</span>
                        </h4>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-3 bg-surface-container-low/50 rounded-xl border border-outline-variant/10">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Longevity</p>
                                <p class="text-xs font-bold text-primary mt-0.5">{{ $product->detail->longevity ?? '-' }}</p>
                            </div>
                            <div class="p-3 bg-surface-container-low/50 rounded-xl border border-outline-variant/10">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Concentration</p>
                                <p class="text-xs font-bold text-primary mt-0.5">{{ $product->detail->concentration ?? '-' }}</p>
                            </div>
                            <div class="p-3 bg-surface-container-low/50 rounded-xl border border-outline-variant/10">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Volume Pack</p>
                                <p class="text-xs font-bold text-primary mt-0.5">{{ $product->detail->volume ?? '-' }}</p>
                            </div>
                            <div class="p-3 bg-surface-container-low/50 rounded-xl border border-outline-variant/10">
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Suitable For</p>
                                <p class="text-xs font-bold text-primary mt-0.5">{{ $product->detail->suitable_for ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-50 flex items-center justify-between text-[11px] font-mono text-gray-400">
                            <span>Created: {{ $product->created_at ? $product->created_at->format('M d, Y') : '-' }}</span>
                            <span>Updated: {{ $product->updated_at ? $product->updated_at->format('H:i T') : '-' }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </main>
@endsection