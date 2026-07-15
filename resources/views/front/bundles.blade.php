@extends('front.layout.layout')

@section('content')
<main class="pt-24 overflow-hidden">

    <header class="relative pt-32 pb-section-gap overflow-hidden hero-gradient">
        <div class="max-w-container-max mx-auto px-margin-desktop grid md:grid-cols-2 items-center gap-gutter">
            <div class="z-10">
                <span class="inline-block px-4 py-1 bg-secondary-container/10 text-secondary-container font-label-md text-label-md rounded-full mb-6">Exclusive Collections</span>
                <h1 class="font-display-lg text-display-lg text-primary mb-6 leading-tight">Save More with <br>Hanah Bundles</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-lg">Discover our curated combinations of premium fragrances, thoughtfully paired for the ultimate olfactory experience and exceptional value.</p>
            </div>
            <div class="relative">
                <div class="absolute -inset-10 bg-secondary-container/5 rounded-full blur-3xl"></div>
                <img alt="Hanah Luxury Perfume Display" class="w-full h-auto rounded-xl shadow-2xl relative z-10 grayscale hover:grayscale-0 transition-all duration-700" src="{{ asset('front/images/hero-bundle.jpg') }}">
            </div>
        </div>
    </header>

    <section class="py-section-gap max-w-container-max mx-auto px-margin-desktop">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            @forelse($bundles as $bundle)
                @php
                    // SINKRONISASI ORACLE: Amankan pembacaan kolom peka kapital murni dari database
                    $bundleId   = $bundle->id ?? ($bundle->ID ?? null);
                    $bundleSlug = $bundle->slug ?? ($bundle->SLUG ?? null);
                    $bundleName = $bundle->name ?? ($bundle->NAME ?? 'Exclusive Bundle');
                    $bundleStock = $bundle->stock ?? ($bundle->STOCK ?? 0);
                    $bundlePrice = $bundle->price ?? ($bundle->PRICE ?? 0);
                    $bundleDesc  = $bundle->description ?? ($bundle->DESCRIPTION ?? 'No description available for this package.');
                    $bundleImage = $bundle->image ?? ($bundle->IMAGE ?? null);
                @endphp

                <div class="bundle-card group flex flex-col bg-white rounded-xl overflow-hidden shadow-sm border border-primary/5 hover:shadow-xl transition-all duration-500">
                    
                    <a href="{{ url('bundles/' . $bundleSlug) }}" class="relative overflow-hidden aspect-[4/5] bg-gray-50 block">
                        <div class="absolute top-4 left-4 z-20 flex flex-col gap-2">
                            <span class="bg-secondary-container text-white font-label-md text-[11px] font-bold px-3 py-1 rounded-full shadow-lg uppercase tracking-wider">
                                EXCLUSIVE
                            </span>
                            @if($bundleStock <= 3 && $bundleStock > 0)
                                <span class="bg-rose-600 text-white font-label-md text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-md uppercase">
                                    ONLY {{ $bundleStock }} LEFT
                                </span>
                            @elseif($bundleStock == 0)
                                <span class="bg-gray-800 text-white font-label-md text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-md uppercase">
                                    OUT OF STOCK
                                </span>
                            @endif
                        </div>
                        
                        @if(!empty($bundleImage))
                            <img alt="{{ $bundleName }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset('admin/images/bundles/' . $bundleImage) }}">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                <span class="material-symbols-outlined text-5xl">inventory_2</span>
                            </div>
                        @endif
                    </a>
                    
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="mb-4">
                            <a href="{{ url('bundles/' . $bundleSlug) }}" class="block group">
                                <h3 class="font-headline-md text-xl font-bold text-primary mb-2 group-hover:text-secondary-container transition-colors">
                                    {{ $bundleName }}
                                </h3>
                            </a>
                            <p class="text-on-surface-variant text-sm line-clamp-2">{{ $bundleDesc }}</p>
                        </div>
                        
                        <div class="space-y-3 mb-8 pt-2 border-t border-gray-100">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Package Includes:</p>
                            @foreach($bundle->products as $product)
                                @php
                                    // SINKRONISASI PIVOT ORACLE: Menghindari null value akibat modifikasi kapital OCI8
                                    $pivotQty = $product->pivot->quantity ?? ($product->pivot->QUANTITY ?? 1);
                                    $productName = $product->name ?? ($product->NAME ?? 'Varian Parfum');
                                @endphp
                                <div class="flex items-center gap-3 product-preview transition-transform">
                                    <div class="w-8 h-8 rounded bg-surface-container flex items-center justify-center text-primary border border-gray-100">
                                        <span class="material-symbols-outlined text-base">science</span>
                                    </div>
                                    <span class="text-xs text-on-surface font-medium">
                                        {{ $pivotQty }}x {{ $productName }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-auto pt-6 border-t border-primary/5 flex items-center justify-between">
                            <div>
                                <span class="block text-[11px] font-mono text-gray-400">Fixed Package Price</span>
                                <span class="text-xl font-black text-primary">Rp {{ number_format($bundlePrice, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($bundleStock > 0)
                                <button type="button" onclick="openQuantityModal('{{ $bundleId }}', {{ $bundleStock }})" class="bg-primary-container text-on-primary px-5 py-3 font-button text-xs font-bold rounded-lg hover:bg-secondary-container transition-colors active:scale-95 shadow-sm cursor-pointer z-30">
                                    Add to Cart
                                </button>
                            @else
                                <button disabled class="bg-gray-100 text-gray-400 px-5 py-3 font-button text-xs font-bold rounded-lg cursor-not-allowed">
                                    Sold Out
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-16 text-center text-on-surface-variant/70 italic">
                    <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300">layers_clear</span>
                    Saat ini belum ada paket produk bundling eksklusif yang diterbitkan.
                </div>
            @endforelse
        </div>
    </section>
</main>

<div id="qty-modal" class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm shadow-inner" onclick="closeQuantityModal()"></div>
    <div class="bg-white rounded-2xl p-6 shadow-2xl border border-outline-variant/20 max-w-sm w-full mx-4 relative z-50 transform scale-95 transition-all duration-300" id="qty-modal-card">
        
        <form id="catalog-cart-form" onsubmit="handleCartSubmit(event)">
            @csrf
            <input type="hidden" name="bundle_id" id="modal-bundle-id" value="">
            <input type="hidden" name="quantity" id="final-quantity" value="1">
        </form>

        <div class="text-center mb-6">
            <h3 class="font-headline-md text-base font-black text-primary uppercase tracking-wide">Select Quantity</h3>
            <p class="text-xs text-on-surface-variant mt-1">Berapa banyak paket yang ingin dimasukkan ke keranjang?</p>
        </div>

        <div class="flex items-center justify-center gap-6 my-6">
            <div class="flex items-center border border-outline-variant rounded-xl px-4 py-2 bg-white shadow-sm">
                <button type="button" class="hover:text-secondary-container transition-colors font-bold text-xl cursor-pointer select-none px-2" onclick="modalDecrement()">-</button>
                <input class="w-16 text-center bg-transparent border-none focus:ring-0 font-black text-base text-primary" id="modal-qty-input" min="1" readonly type="number" value="1"/>
                <button type="button" class="hover:text-secondary-container transition-colors font-bold text-lg cursor-pointer select-none px-2" onclick="modalIncrement()">+</button>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mt-6">
            <button type="button" onclick="closeQuantityModal()" class="border border-outline text-on-surface-variant py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-gray-50 transition-all cursor-pointer">
                Cancel
            </button>
            <button type="button" onclick="submitQuantityFromModal()" class="bg-primary text-white py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:brightness-110 transition-all shadow-md cursor-pointer">
                Confirm Add
            </button>
        </div>
    </div>
</div>

<div id="cart-toast" class="fixed top-24 right-6 z-50 transform translate-x-full opacity-0 transition-all duration-500 ease-out pointer-events-none">
    <div class="bg-white rounded-2xl border border-emerald-500/20 p-4 shadow-2xl flex items-center gap-4 max-w-sm">
        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0 border border-emerald-500/10">
            <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
        </div>
        <div>
            <h4 class="text-xs font-bold text-primary uppercase tracking-wide">Added to Cart</h4>
            <p class="text-[11px] text-on-surface-variant leading-tight mt-0.5" id="toast-message">Item berhasil disimpan ke keranjang.</p>
        </div>
    </div>
</div>

<script>
    let maxStockActive = 1;
    const isLoggedIn = @json(Auth::check() || auth()->guard('customer')->check());

    function openQuantityModal(bundleId, maxStock) {
        if (!isLoggedIn) {
            window.location.href = "{{ route('login') }}";
            return;
        }
        
        const qtyModal = document.getElementById('qty-modal');
        const qtyModalCard = document.getElementById('qty-modal-card');
        const modalQtyInput = document.getElementById('modal-qty-input');
        const modalBundleId = document.getElementById('modal-bundle-id');

        if(qtyModal && qtyModalCard) {
            maxStockActive = parseInt(maxStock);
            if(modalBundleId) modalBundleId.value = bundleId;
            if(modalQtyInput) modalQtyInput.value = "1";
            
            qtyModal.classList.remove('opacity-0', 'pointer-events-none');
            qtyModalCard.classList.remove('scale-95');
            qtyModalCard.classList.add('scale-100');
        }
    }

    function closeQuantityModal() {
        const qtyModal = document.getElementById('qty-modal');
        const qtyModalCard = document.getElementById('qty-modal-card');
        if(qtyModal && qtyModalCard) {
            qtyModal.classList.add('opacity-0', 'pointer-events-none');
            qtyModalCard.classList.remove('scale-100');
            qtyModalCard.classList.add('scale-95');
        }
    }

    function modalIncrement() {
        const modalQtyInput = document.getElementById('modal-qty-input');
        if (modalQtyInput && parseInt(modalQtyInput.value) < maxStockActive) {
            modalQtyInput.value = parseInt(modalQtyInput.value) + 1;
        }
    }
    
    function modalDecrement() {
        const modalQtyInput = document.getElementById('modal-qty-input');
        if (modalQtyInput && parseInt(modalQtyInput.value) > 1) {
            modalQtyInput.value = parseInt(modalQtyInput.value) - 1;
        }
    }

    function submitQuantityFromModal() {
        const finalQuantity = document.getElementById('final-quantity');
        const modalQtyInput = document.getElementById('modal-qty-input');
        if(finalQuantity && modalQtyInput) {
            finalQuantity.value = modalQtyInput.value;
            closeQuantityModal();
            handleCartSubmit(new Event('submit'));
        }
    }

    function handleCartSubmit(event) {
        if(event) event.preventDefault();

        const form = document.getElementById('catalog-cart-form');
        const formData = new FormData(form);

        fetch("{{ route('front.cart.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showCartToast(data.message);
                if (typeof window.refreshCartBadge === 'function') {
                    window.refreshCartBadge();
                }
            }
        })
        .catch(error => console.error('Error:', error));

        return false;
    }

    function showCartToast(message) {
        const toast = document.getElementById('cart-toast');
        const toastMsg = document.getElementById('toast-message');
        
        if(toast && toastMsg) {
            toastMsg.innerText = message;
            toast.classList.remove('translate-x-full', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
            }, 3500);
        }
    }
</script>
@endsection