@extends('front.layout.layout')

@section('content')
<main class="max-w-container-max mx-auto px-margin-desktop py-12">

    <nav class="flex items-center gap-2 mb-8 font-label-md text-label-md text-on-surface-variant/60">
        <a class="hover:text-primary transition-colors" href="{{ route('front.home') }}">
            Home
        </a>

        <span class="material-symbols-outlined text-[14px]">
            chevron_right
        </span>

        <span class="text-primary">
            Shop
        </span>
    </nav>

    <header class="mb-16">
        <h1 class="font-display-lg text-display-lg text-primary mb-4">
            Discover Your Signature Scent
        </h1>

        <div class="h-1 w-24 bg-secondary-container"></div>
    </header>

    <div class="flex flex-col md:flex-row gap-12">

        {{-- FILTER --}}
        <aside class="w-full md:w-64 flex-shrink-0 space-y-10">

            {{-- CATEGORY --}}
            <div>

                <h3 class="font-label-md text-label-md uppercase tracking-widest text-primary border-b border-primary/10 pb-3 mb-6">
                    Fragrance Notes
                </h3>

                <div class="space-y-3">

                    @foreach($categories as $category)

                        <label class="flex items-center gap-3 cursor-pointer group">

                            <input
                                type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                                class="w-4 h-4 rounded border-outline-variant text-secondary-container focus:ring-0 filter-checkbox"

                                {{ is_array(request('categories')) && in_array($category->id, request('categories')) ? 'checked' : '' }}
                            >

                            <span class="font-body-md text-on-surface-variant group-hover:text-primary transition-colors">
                                {{ $category->name }}
                            </span>

                        </label>

                    @endforeach

                </div>

            </div>

            {{-- FRAGRANCE TYPE --}}
            <div>

                <h3 class="font-label-md text-label-md uppercase tracking-widest text-primary border-b border-primary/10 pb-3 mb-6">
                    Fragrance Type
                </h3>

                <div class="space-y-3">

                    @foreach($fragranceTypes as $type)

                        <label class="flex items-center gap-3 cursor-pointer group">

                            <input
                                type="checkbox"
                                name="types[]"
                                value="{{ $type->id }}"
                                class="w-4 h-4 rounded border-outline-variant text-secondary-container focus:ring-0 filter-checkbox"

                                {{ is_array(request('types')) && in_array($type->id, request('types')) ? 'checked' : '' }}
                            >

                            <span class="font-body-md text-on-surface-variant group-hover:text-primary transition-colors">
                                {{ $type->name }}
                            </span>

                        </label>

                    @endforeach

                </div>

            </div>

        </aside>

        {{-- PRODUCT --}}
        <section class="flex-1">

            <div class="flex justify-between items-center mb-8 pb-4 border-b border-primary/5">

                <span class="font-label-md text-on-surface-variant">

                    Showing

                    <strong>{{ $products->firstItem() ?? 0 }}</strong>

                    -

                    <strong>{{ $products->lastItem() ?? 0 }}</strong>

                    of

                    {{ $products->total() }}

                    products

                </span>

                <div class="flex items-center gap-4">

                    <span class="font-label-md text-on-surface-variant">

                        Sort by:

                    </span>

                    <select
                        id="sort-selector"
                        class="bg-transparent border-none font-label-md text-primary focus:ring-0 cursor-pointer"
                    >

                        <option value="featured"
                            {{ request('sort') == 'featured' ? 'selected' : '' }}>
                            Featured
                        </option>

                        <option value="newest"
                            {{ request('sort') == 'newest' ? 'selected' : '' }}>
                            Newest
                        </option>

                        <option value="price_low"
                            {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                            Price: Low to High
                        </option>

                        <option value="price_high"
                            {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                            Price: High to Low
                        </option>

                    </select>

                </div>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-gutter gap-y-12">

                @forelse($products as $product)

                    <a
                        href="{{ route('front.shop.detail',$product->slug) }}"
                        class="group flex flex-col justify-between relative bg-transparent rounded-xl p-2 transition-all duration-300 hover:bg-surface-container-low/50"
                    >

                        <div>

                            <div class="relative aspect-[4/5] bg-surface mb-6 overflow-hidden rounded-xl border border-outline-variant/40 flex items-center justify-center">

                                @if(!empty($product->featured_image))

                                    <img
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        src="{{ asset('admin/images/products/'.$product->featured_image) }}"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <span class="material-symbols-outlined text-4xl text-outline/40">
                                        science
                                    </span>

                                @endif

                                <div class="absolute top-4 right-4 flex flex-col gap-2 z-20">

                                    <button
                                        type="button"
                                        onclick="event.preventDefault();event.stopPropagation();alert('Added to Wishlist');"
                                        class="w-10 h-10 rounded-full bg-white/80 backdrop-blur-md flex items-center justify-center text-primary hover:bg-white hover:scale-110 transition-all"
                                    >

                                        <span class="material-symbols-outlined text-[20px]">
                                            favorite
                                        </span>

                                    </button>

                                </div>

                                <button
                                    type="button"
                                    onclick="event.preventDefault();event.stopPropagation();alert('Added to Cart');"
                                    class="absolute bottom-0 left-0 w-full py-4 bg-primary text-white font-button text-xs font-bold translate-y-full group-hover:translate-y-0 transition-transform duration-300"
                                >
                                    Add to Cart
                                </button>

                            </div>

                            <div class="text-center space-y-1 px-2">

                                <p class="font-label-md text-[11px] text-secondary font-bold uppercase tracking-wider">

                                    {{ optional($product->fragranceType)->name ?? 'Eau de Parfum' }}

                                </p>

                                <h3 class="font-headline-md text-[22px] text-primary group-hover:text-secondary-container transition-colors line-clamp-1">

                                    {{ $product->name }}

                                </h3>

                                <div class="flex flex-wrap justify-center gap-1 mb-3">

                                    @forelse($product->categories as $category)

                                        <span class="px-2 py-0.5 bg-surface-container-low border border-outline-variant/60 rounded text-[9px] font-bold text-on-surface-variant uppercase tracking-tight">

                                            {{ $category->name }}

                                        </span>

                                    @empty

                                        <span class="px-2 py-0.5 bg-surface-container-low border border-outline-variant/40 rounded text-[9px] text-gray-400 italic">

                                            No Notes

                                        </span>

                                    @endforelse

                                </div>

                                <div class="flex items-center justify-center gap-0.5 mb-2 text-secondary">

                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings:'FILL' 1;">star</span>

                                    <span class="text-[11px] text-on-surface-variant font-medium ml-1">

                                        (4.9)

                                    </span>

                                </div>

                            </div>

                        </div>

                        <div class="text-center pt-2 border-t border-primary/5 mt-2">

                            <p class="font-bold text-lg text-primary">

                                Rp {{ number_format($product->price,0,',','.') }}

                            </p>

                        </div>

                    </a>

                @empty

                    <div class="col-span-full py-20 text-center text-on-surface-variant/60">

                        <span class="material-symbols-outlined text-5xl mb-3 block text-outline/40">
                            layers_clear
                        </span>

                        <p class="text-sm">

                            Tidak ada produk aktif di katalog saat ini.

                        </p>

                    </div>

                @endforelse

            </div>

            <div class="mt-24 flex justify-center">

                {{ $products->appends(request()->query())->links('pagination::tailwind') }}

            </div>

        </section>

    </div>

</main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filters = document.querySelectorAll('.filter-checkbox');
    const sortSelector = document.getElementById('sort-selector');

    function applyFilters() {

        const url = new URL(window.location.href);

        // Bersihkan parameter lama
        url.searchParams.delete('categories[]');
        url.searchParams.delete('types[]');
        url.searchParams.delete('page');
        url.searchParams.delete('sort');

        // Category
        document.querySelectorAll('input[name="categories[]"]:checked').forEach(function (checkbox) {
            url.searchParams.append('categories[]', checkbox.value);
        });

        // Fragrance Type
        document.querySelectorAll('input[name="types[]"]:checked').forEach(function (checkbox) {
            url.searchParams.append('types[]', checkbox.value);
        });

        // Sorting
        if (sortSelector && sortSelector.value !== '') {
            url.searchParams.set('sort', sortSelector.value);
        }

        window.location.href = url.toString();
    }

    filters.forEach(function (checkbox) {
        checkbox.addEventListener('change', applyFilters);
    });

    if (sortSelector) {
        sortSelector.addEventListener('change', applyFilters);
    }

});
</script>
@endpush