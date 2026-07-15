@extends('front.layout.layout')

@section('content')

@php
    // Standardisasi variabel agar satu file ini adaptif untuk produk retail maupun paket bundle
    $isBundle = $isBundle ?? false;
    $item = $isBundle ? $bundle : $product;
    
    $featuredImage = $isBundle ? 'bundles/' . $item->image : 'products/' . $item->featured_image;
    $categoryName = $isBundle ? 'EXCLUSIVE BUNDLE SET' : ($item->category->name ?? 'EAU DE PARFUM');
@endphp

<main class="max-w-container-max mx-auto px-margin-desktop py-12">
    <!-- PRODUCT HERO GROUP -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-section-gap">
        
        <!-- SISI KIRI: GALERI FOTO & THUMBNAILS -->
        <div class="space-y-6">
            <div class="aspect-[4/5] bg-surface-container overflow-hidden rounded-xl group relative cursor-zoom-in border border-outline-variant/10 shadow-sm">
                <img alt="{{ $item->name }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                     id="main-product-image" 
                     src="{{ asset('admin/images/' . $featuredImage) }}"/>
            </div>
            
            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2">
                <button type="button" class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden border-2 border-secondary-container bg-surface-container cursor-pointer transition-all" onclick="updateImage(this.children[0].src, this)">
                    <img class="w-full h-full object-cover" src="{{ asset('admin/images/' . $featuredImage) }}"/>
                </button>
                
                @if(!$isBundle && isset($item->image_gallery) && $item->image_gallery)
                    @foreach(json_decode($item->image_gallery) as $gallery)
                        <button type="button" class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden border-2 border-transparent hover:border-outline bg-surface-container cursor-pointer transition-all" onclick="updateImage(this.children[0].src, this)">
                            <img class="w-full h-full object-cover" src="{{ asset('admin/images/products/' . $gallery) }}"/>
                        </button>
                    @endforeach
                @elseif($isBundle)
                    @foreach($item->products as $subProduct)
                        <button type="button" class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden border-2 border-transparent hover:border-outline bg-surface-container cursor-pointer transition-all" onclick="updateImage(this.children[0].src, this)">
                            <img class="w-full h-full object-cover" src="{{ asset('admin/images/products/' . $subProduct->featured_image) }}"/>
                        </button>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- SISI KANAN: INFORMASI UTAMA & FORM KERANJANG -->
        <div class="flex flex-col justify-start">
            <div class="mb-4">
                <span class="text-on-surface-variant font-label-md text-xs font-bold tracking-widest uppercase">
                    {{ $categoryName }}
                </span>
                <h1 class="font-headline-lg text-2xl lg:text-3xl font-black text-primary mt-2 tracking-tight">{{ $item->name }}</h1>
            </div>
            
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center text-secondary-container">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star_half</span>
                </div>
                <span class="text-on-surface-variant font-label-md text-xs border-l border-outline-variant pl-4">4.9 ({{ $isBundle ? '48' : '124' }} Reviews)</span>
            </div>

            <div class="mb-8 border-b border-gray-100 pb-6">
                <p class="text-primary font-headline-md text-2xl font-black">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                <p class="text-on-surface-variant/70 text-xs mt-1">Free standard express shipping worldwide</p>
            </div>

            <div class="flex items-center gap-3 mb-8">
                @if($item->stock > 0)
                    <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-on-surface font-label-md text-xs font-medium text-gray-700">In Stock &amp; Ready to Ship ({{ $item->stock }} units available)</span>
                @else
                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                    <span class="text-on-surface font-label-md text-xs font-bold text-error">Out of Stock</span>
                @endif
            </div>

            <!-- 🏛️ FORM ADD TO CART -->
            <form action="{{ route('front.cart.store') }}" method="POST" id="cart-form" onsubmit="handleCartSubmit(event)">
                @csrf
                
                @if($isBundle)
                    <input type="hidden" name="bundle_id" value="{{ $item->id }}">
                @else
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                @endif

                <!-- Input Hidden untuk menampung data kuantitas final dari Pop-up Modal -->
                <input type="hidden" name="quantity" id="final-quantity" value="1">

                <div class="grid grid-cols-2 gap-4 mb-10">
                    <!-- Tombol klik memicu Pop-up Modal seleksi kuantitas -->
                    <button type="button" onclick="openQuantityModal()" class="bg-primary text-white py-5 rounded-xl font-bold text-xs uppercase tracking-wider hover:brightness-110 transition-all shadow-md active:scale-95 cursor-pointer text-center">
                        Add to Cart
                    </button>
                    
                    <a href="{{ route('front.transaction.create', ['order_id' => rand(1000, 9999)]) }}?{{ $isBundle ? 'bid' : 'pid' }}={{ $item->id }}&qty=1" 
                       id="buy-now-link"
                       onclick="handleBuyNowClick(this, event)"
                       class="bg-secondary-container text-white py-4 rounded-xl font-bold text-xs uppercase tracking-wider hover:opacity-90 transition-all shadow-md active:scale-95 text-center flex items-center justify-center">
                        Buy Now
                    </a>
                </div>
            </form>

            <div class="border-t border-outline-variant/30 pt-8 mt-4 space-y-3">
                <div class="flex items-center gap-3 text-on-surface-variant">
                    <span class="material-symbols-outlined text-primary text-lg">verified</span>
                    <span class="text-xs font-bold text-gray-600">Authenticity & Genuine Production Guaranteed</span>
                </div>
                <div class="flex items-center gap-3 text-on-surface-variant">
                    <span class="material-symbols-outlined text-primary text-lg">local_shipping</span>
                    <span class="text-xs font-bold text-gray-600">Eco-friendly Secure Box Express Packaging</span>
                </div>
            </div>
        </div>
    </div>

    <!-- SEKSI BAWAH 1: OLFACTORY JOURNEY (PRODUK) ATAU INSIDE ITEMS (BUNDLE) -->
    @if(!$isBundle)
        <section class="mb-section-gap border-t border-gray-100 pt-16">
            <h2 class="font-headline-md text-xl font-black text-primary text-center mb-12 uppercase tracking-wider">The Olfactory Journey</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                <div class="bg-surface-container-low p-8 rounded-xl text-center border border-primary/5 hover:border-secondary-container/20 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-secondary-container mb-4">cloud</span>
                    <h3 class="font-headline-md text-base font-bold text-primary mb-2">Top Notes</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed px-2">{{ $item->top_notes ?? 'Bergamot, Lemon Zest, Fresh Mint' }}</p>
                    <p class="text-on-surface-variant/40 text-[10px] mt-4 uppercase font-bold tracking-widest">Immediate Impact (0-15m)</p>
                </div>
                <div class="bg-white p-8 rounded-xl text-center shadow-md border border-primary/5 hover:border-secondary-container/20 transition-all">
                    <span class="material-symbols-outlined text-4xl text-secondary-container mb-4">favorite</span>
                    <h3 class="font-headline-md text-base font-bold text-primary mb-2">Heart Notes</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed px-2">{{ $item->heart_notes ?? 'Lavender, Geranium, Sea Salt' }}</p>
                    <p class="text-on-surface-variant/40 text-[10px] mt-4 uppercase font-bold tracking-widest">Core Identity (15m-4h)</p>
                </div>
                <div class="bg-surface-container-low p-8 rounded-xl text-center border border-primary/5 hover:border-secondary-container/20 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-secondary-container mb-4">grass</span>
                    <h3 class="font-headline-md text-base font-bold text-primary mb-2">Base Notes</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed px-2">{{ $item->base_notes ?? 'Amberwood, Patchouli, Oakmoss' }}</p>
                    <p class="text-on-surface-variant/40 text-[10px] mt-4 uppercase font-bold tracking-widest">Lasting Impression (4h+)</p>
                </div>
            </div>
        </section>
    @else
        <section class="mb-section-gap border-t border-gray-100 pt-16">
            <h2 class="font-headline-md text-xl font-black text-primary text-center mb-8 uppercase tracking-wider">What's Inside This Bundle</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
                @foreach($item->products as $subProduct)
                    <div class="bg-white p-5 rounded-xl border border-outline-variant/30 text-center space-y-3 shadow-sm hover:shadow-md transition-all">
                        <div class="aspect-square rounded-lg bg-surface-container overflow-hidden w-full border">
                            <img src="{{ asset('admin/images/products/' . $subProduct->featured_image) }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-primary text-xs truncate px-1">{{ $subProduct->name }}</h4>
                        <span class="inline-block px-3 py-0.5 bg-secondary-container/10 text-secondary-container font-bold text-[10px] rounded-full uppercase">
                            Quantity: {{ $subProduct->pivot->quantity }} Pcs
                        </span>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- SEKSI BAWAH 2: NARATIF ATMOSFER & SPESIFIKASI -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-16 border-t border-gray-100 pt-16">
        <div class="lg:col-span-2">
            <h2 class="font-headline-md text-lg font-bold text-primary mb-6 uppercase tracking-wide">Atmospheric Narrative</h2>
            <div class="text-on-surface-variant font-body-lg text-sm leading-relaxed text-justify space-y-4">
                <p>{!! nl2br(e($item->description)) !!}</p>
            </div>
        </div>
        <div class="bg-surface-container/60 p-8 rounded-xl border border-outline-variant/20 shadow-inner">
            <h3 class="font-label-md text-xs font-bold text-primary mb-6 uppercase tracking-widest border-b border-outline-variant pb-4">Specifications</h3>
            <ul class="space-y-4 text-xs">
                <li class="flex justify-between border-b border-outline-variant/10 pb-2">
                    <span class="text-on-surface-variant font-medium">Type Classification</span>
                    <span class="text-primary font-bold">{{ $isBundle ? 'Luxury Bundle Collection' : 'Eau de Parfum' }}</span>
                </li>
                <li class="flex justify-between border-b border-outline-variant/10 pb-2">
                    <span class="text-on-surface-variant font-medium">Package Volumetric</span>
                    <span class="text-primary font-bold">{{ $isBundle ? $item->products->count() . ' Bottles Pack' : ($item->volume ?? '100ml / 3.4 fl. oz') }}</span>
                </li>
                <li class="flex justify-between border-b border-outline-variant/10 pb-2">
                    <span class="text-on-surface-variant font-medium">Availability Status</span>
                    <span class="text-primary font-bold">{{ $item->stock > 0 ? 'Ready Stock' : 'Out of Stock' }}</span>
                </li>
                <li class="flex justify-between">
                    <span class="text-on-surface-variant font-medium">Authentic Security</span>
                    <span class="text-primary font-bold">Encrypted QR Validation</span>
                </li>
            </ul>
        </div>
    </section>
</main>

<!-- 📦 POP-UP MODAL SELEKSI QUANTITY -->
<div id="qty-modal" class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <!-- Dark Backdrop Background -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeQuantityModal()"></div>
    
    <!-- Modal Card Box -->
    <div class="bg-white rounded-2xl p-6 shadow-2xl border border-outline-variant/20 max-w-sm w-full mx-4 relative z-10 transform scale-95 transition-all duration-300" id="qty-modal-card">
        <div class="text-center mb-6">
            <h3 class="font-headline-md text-base font-black text-primary uppercase tracking-wide">Select Quantity</h3>
            <p class="text-xs text-on-surface-variant mt-1">Berapa banyak yang ingin ditambahkan ke keranjang?</p>
        </div>

        <!-- Increment Decrement Counter Button di Modal -->
        <div class="flex items-center justify-center gap-6 my-6">
            <div class="flex items-center border border-outline-variant rounded-xl px-4 py-2 bg-white shadow-sm">
                <button type="button" class="hover:text-secondary-container transition-colors font-bold text-xl cursor-pointer select-none px-2" onclick="modalDecrement()">-</button>
                <input class="w-16 text-center bg-transparent border-none focus:ring-0 font-black text-base text-primary" id="modal-qty-input" min="1" max="{{ $item->stock }}" readonly type="number" value="1"/>
                <button type="button" class="hover:text-secondary-container transition-colors font-bold text-lg cursor-pointer select-none px-2" onclick="modalIncrement()">+</button>
            </div>
        </div>

        <!-- Modal Actions Area -->
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

<!-- 🔔 POP-UP TOAST SUCCESS NOTIFICATION -->
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

<!-- STICKY ADD TO CART BAR -->
<div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-xl border-t border-outline-variant/30 transform translate-y-full transition-transform duration-500 z-40 hidden md:block" id="sticky-bar">
    <div class="max-w-container-max mx-auto px-margin-desktop py-4 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <img class="w-12 h-12 rounded object-cover border" id="sticky-image-preview" src="{{ asset('admin/images/' . $featuredImage) }}"/>
            <div>
                <p class="font-bold text-primary text-sm">{{ $item->name }}</p>
                <p class="text-secondary-container font-black text-xs">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <button type="button" onclick="openQuantityModal();" class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:brightness-110 transition-all shadow-md cursor-pointer">
                Add to Cart
            </button>
        </div>
    </div>
</div>

@endsection

<!-- JAVASCRIPT GLOBAL CONTROL WORKSPACE -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qtyModal = document.getElementById('qty-modal');
        const qtyModalCard = document.getElementById('qty-modal-card');
        const modalQtyInput = document.getElementById('modal-qty-input');
        const finalQuantity = document.getElementById('final-quantity');
        const stickyBar = document.getElementById('sticky-bar');
        const mainImage = document.getElementById('main-product-image');
        const maxStock = parseInt("{{ $item->stock }}");
        
        // Membaca status otentikasi login dari Laravel global context
        const isLoggedIn = @json(Auth::check() || auth()->guard('customer')->check());

        // 🌟 AKSI KONTROL POP-UP MODAL QUANTITY
        window.openQuantityModal = function() {
            if (!isLoggedIn) {
                window.location.href = "{{ route('login') }}";
                return;
            }
            if(qtyModal && qtyModalCard) {
                modalQtyInput.value = "1"; // Reset count item default
                qtyModal.classList.remove('opacity-0', 'pointer-events-none');
                qtyModalCard.classList.remove('scale-95');
                qtyModalCard.classList.add('scale-100');
            }
        }

        window.closeQuantityModal = function() {
            if(qtyModal && qtyModalCard) {
                qtyModal.classList.add('opacity-0', 'pointer-events-none');
                qtyModalCard.classList.remove('scale-100');
                qtyModalCard.classList.add('scale-95');
            }
        }

        window.modalIncrement = function() {
            if (modalQtyInput && parseInt(modalQtyInput.value) < maxStock) {
                modalQtyInput.value = parseInt(modalQtyInput.value) + 1;
            }
        }
        
        window.modalDecrement = function() {
            if (modalQtyInput && parseInt(modalQtyInput.value) > 1) {
                modalQtyInput.value = parseInt(modalQtyInput.value) - 1;
            }
        }

        // 🌟 PROSES KONFIRMASI KUANTITAS DARI MODAL
        window.submitQuantityFromModal = function() {
            if(finalQuantity && modalQtyInput) {
                // Sinkronisasi nilai kuantitas terpilih ke input hidden form utama
                finalQuantity.value = modalQtyInput.value;
                closeQuantityModal();
                
                // Memicu pengiriman background request AJAX Fetch
                window.handleCartSubmit(new Event('submit'));
            }
        }

        // 🚀 SUBMIT DATA BACKGROUND PROSES VIA AJAX FETCH
        window.handleCartSubmit = function(event) {
            if(event) event.preventDefault();

            const form = document.getElementById('cart-form');
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
                }
            })
            .catch(error => console.error('Error:', error));

            return false;
        }// 🚀 SUBMIT DATA BACKGROUND PROSES VIA AJAX FETCH
        window.handleCartSubmit = function(event) {
            if(event) event.preventDefault();

            const form = document.getElementById('cart-form');
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
                    
                    // 🌟 SINKRONISASI REAL-TIME: Perbarui angka di icon navbar atas instan
                    if (typeof window.refreshCartBadge === 'function') {
                        window.refreshCartBadge();
                    }
                }
            })
            .catch(error => console.error('Error:', error));

            return false;
        }

        // Fungsi Memunculkan Efek Animasi Toast di Pojok Atas Layar
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

        // Handler untuk Interaksi Pergantian Gambar Galeri
        window.updateImage = function(src, buttonElement) {
            if(mainImage) {
                mainImage.style.opacity = '0';
                setTimeout(() => { mainImage.src = src; mainImage.style.opacity = '1'; }, 150);
            }
            document.querySelectorAll('.w-24.h-24').forEach(btn => {
                btn.classList.remove('border-secondary-container');
                btn.classList.add('border-transparent');
            });
            if(buttonElement) {
                buttonElement.classList.remove('border-transparent');
                buttonElement.classList.add('border-secondary-container');
            }
        }

        // Interseptor Tombol Buy Now Langsung
        window.handleBuyNowClick = function(element, event) {
            if (!isLoggedIn) {
                event.preventDefault();
                window.location.href = "{{ route('login') }}";
            }
        }
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                if(stickyBar) stickyBar.classList.remove('translate-y-full');
            } else {
                if(stickyBar) stickyBar.classList.add('translate-y-full');
            }
        });
    });

    
</script>