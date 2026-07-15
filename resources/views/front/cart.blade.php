@extends('front.layout.layout')

@section('content')
<main class="max-w-container-max mx-auto px-margin-desktop py-12 lg:py-20">
    <header class="mb-12">
        <h1 class="font-headline-lg text-display-md text-primary mb-2">Shopping Cart</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Review your selection of premium scents and collections.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        <div class="lg:col-span-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-on-surface-variant font-label-md text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="pb-4 font-bold text-center w-12">Select</th>
                            <th class="pb-4 font-bold">Product / Collection</th>
                            <th class="pb-4 font-bold">Quantity</th>
                            <th class="pb-4 font-bold text-right">Price</th>
                            <th class="pb-4"></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php $calculatedSubtotal = 0; @endphp
                        @forelse($cart->items as $item)
                            @php
                                // Cek tipe data (Apakah baris ini produk atau bundle?)
                                $isBundle = !empty($item->bundle_id);
                                $data = $isBundle ? $item->bundle : $item->product;
                                
                                $imagePath = $isBundle ? 'bundles/' . $data->image : 'products/' . $data->featured_image;
                                $typeName = $isBundle ? 'Exclusive Bundle' : ($data->category->name ?? 'Eau de Parfum');
                                $subtotalItem = $data->price * $item->quantity;
                            @endphp
                            
                            <tr class="group bg-white rounded-xl shadow-sm border border-outline-variant/10">
                                <td class="py-6 px-4 text-center rounded-l-xl bg-white border-y border-l">
                                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" checked
                                           data-price="{{ $data->price }}" data-qty="{{ $item->quantity }}"
                                           class="cart-checkbox w-4 h-4 rounded text-primary focus:ring-0 cursor-pointer accent-primary">
                                </td>

                                <td class="py-6 bg-white border-y">
                                    <div class="flex items-center gap-6">
                                        <div class="w-20 h-24 bg-surface-container rounded-lg overflow-hidden flex-shrink-0 border">
                                            <img alt="{{ $data->name }}" class="w-full h-full object-cover" src="{{ asset('admin/images/' . $imagePath) }}"/>
                                        </div>
                                        <div>
                                            <span class="text-[10px] font-bold text-secondary uppercase tracking-wider">{{ $typeName }}</span>
                                            <h3 class="font-headline-md text-base font-bold text-primary mt-0.5">{{ $data->name }}</h3>
                                            @if($isBundle)
                                                <p class="text-[10px] text-gray-400 mt-1">Includes: {{ $data->products->count() }} items</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="py-6 bg-white border-y">
                                    <div class="flex items-center border border-outline-variant/50 rounded-lg w-fit px-2 py-1 bg-gray-50/50">
                                        <form action="{{ route('front.quantity', $item->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="p-1 hover:text-secondary-container transition-colors font-bold">-</button>
                                        </form>
                                        
                                        <span class="px-4 font-label-md text-sm font-bold text-primary">{{ $item->quantity }}</span>
                                        
                                        <form action="{{ route('front.quantity', $item->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="p-1 hover:text-secondary-container transition-colors font-bold">+</button>
                                        </form>
                                    </div>
                                </td>

                                <td class="py-6 bg-white border-y text-right font-bold text-primary">
                                    Rp {{ number_format($subtotalItem, 0, ',', '.') }}
                                </td>

                                <td class="py-6 px-4 bg-white rounded-r-xl border-y border-r text-right">
                                    <form action="{{ route('front.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="button" onclick="openDeleteModal('{{ $item->id }}')" class="text-on-surface-variant hover:text-error transition-colors p-1 cursor-pointer">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </td>

                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center text-on-surface-variant italic">
                                    <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300">shopping_cart_off</span>
                                    Keranjang belanja Anda kosong.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-4 sticky top-28">
            <div class="bg-surface-container-low p-8 rounded-2xl shadow-sm border border-outline-variant/10">
                <h2 class="font-headline-md text-lg font-bold text-primary mb-6">Order Summary</h2>
                <div class="space-y-4 mb-6 pb-6 border-b border-outline-variant/30 text-sm">
                    <div class="flex justify-between font-body-md">
                        <span class="text-on-surface-variant">Subtotal Selected</span>
                        <span class="text-primary font-bold" id="summary-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between font-body-md">
                        <span class="text-on-surface-variant">Shipping Rate</span>
                        <span class="text-primary text-xs italic">Calculated at next step</span>
                    </div>
                </div>
                <div class="flex justify-between items-baseline mb-8">
                    <span class="font-headline-md text-base font-bold">Total Estimated</span>
                    <span class="text-xl font-black text-primary" id="summary-total">Rp 0</span>
                </div>
                
                {{-- SINKRONISASI RESMI: Mengarah ke rute front.transaction.create dengan parameter order_id diisi dummy 'cart' --}}
                <form action="{{ route('front.transaction.create', ['order_id' => 'cart']) }}" method="GET" id="checkout-form">
                    {{-- Input hidden ini otomatis berisi ID item yang dicentang (diatur oleh JavaScript bawaan Anda) --}}
                    <input type="hidden" name="items_to_buy" id="items-to-buy-input">
                    
                    <button type="submit" id="checkout-btn" class="w-full bg-secondary-container text-white py-4 rounded-xl font-button text-xs font-bold shadow-md hover:opacity-90 active:scale-[0.98] transition-all mb-4 cursor-pointer">
                        Proceed to Checkout
                    </button>
                </form>
                <p class="text-center font-label-md text-[11px] text-gray-400">
                    Free shipping on premium orders over Rp 5.000.000
                </p>
            </div>
        </div>
    </div>

    
</main>
<div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    
    <div class="bg-white rounded-2xl p-6 shadow-2xl border border-outline-variant/10 max-w-sm w-full mx-4 relative z-10 transform scale-95 transition-all duration-300" id="delete-modal-card">
        <div class="text-center mb-6">
            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 border border-rose-500/10">
                <span class="material-symbols-outlined text-[24px]">delete_sweep</span>
            </div>
            <h3 class="font-headline-md text-base font-black text-primary uppercase tracking-wide">Remove Item?</h3>
            <p class="text-xs text-on-surface-variant mt-1.5 leading-relaxed">Apakah Anda yakin ingin mengeluarkan item wewangian eksklusif ini dari keranjang belanja Anda?</p>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button type="button" onclick="closeDeleteModal()" class="border border-outline text-on-surface-variant py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-gray-50 transition-all cursor-pointer">
                Cancel
            </button>
            <button type="button" id="confirm-delete-btn" class="bg-rose-600 text-white py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-rose-700 transition-all shadow-md cursor-pointer">
                Remove Item
            </button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.cart-checkbox');
        const summarySubtotal = document.getElementById('summary-subtotal');
        const summaryTotal = document.getElementById('summary-total');
        const itemsToBuyInput = document.getElementById('items-to-buy-input');
        const checkoutBtn = document.getElementById('checkout-btn');

        function calculateCart() {
            let subtotal = 0;
            let checkedIds = [];

            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const price = parseFloat(cb.getAttribute('data-price'));
                    const qty = parseInt(cb.getAttribute('data-qty'));
                    subtotal += (price * qty);
                    checkedIds.push(cb.value);
                }
            });

            // Format Rupiah ala Indonesia
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            summarySubtotal.innerText = formatter.format(subtotal).replace("IDR", "Rp");
            summaryTotal.innerText = formatter.format(subtotal).replace("IDR", "Rp");
            itemsToBuyInput.value = checkedIds.join(',');

            // Proteksi jika tidak ada item yang diceklist
            if (checkedIds.length === 0) {
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                checkoutBtn.classList.remove('bg-secondary-container', 'text-white');
            } else {
                checkoutBtn.disabled = false;
                checkoutBtn.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                checkoutBtn.classList.add('bg-secondary-container', 'text-white');
            }
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', calculateCart);
        });

        // Jalankan kalkulasi pertama kali halaman dimuat
        calculateCart();
    });
    
    let currentDeleteFormId = null;

    window.openDeleteModal = function(itemId) {
        const modal = document.getElementById('delete-modal');
        const card = document.getElementById('delete-modal-card');
        
        if(modal && card) {
            currentDeleteFormId = `delete-form-${itemId}`; // Simpan ID form target
            modal.classList.remove('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }
    }

    window.closeDeleteModal = function() {
        const modal = document.getElementById('delete-modal');
        const card = document.getElementById('delete-modal-card');
        
        if(modal && card) {
            modal.classList.add('opacity-0', 'pointer-events-none');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            currentDeleteFormId = null;
        }
    }

    // Eksekusi submit asli jika tombol merah konfirmasi ditekan
    document.getElementById('confirm-delete-btn').addEventListener('click', function() {
        if (currentDeleteFormId) {
            const targetForm = document.getElementById(currentDeleteFormId);
            if (targetForm) {
                targetForm.submit();
            }
        }
    });
</script>
@endsection