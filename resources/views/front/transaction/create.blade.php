<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Checkout | Hanah Luxury Fragrance</title>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&amp;family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <style>
            body {
                background-color: #f4fbf9;
                color: #161d1c;
                -webkit-font-smoothing: antialiased;
            }
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(30, 45, 61, 0.08);
            }
            input:focus {
                outline: none;
                border-color: #028090 !important;
                box-shadow: 0 0 0 2px rgba(2, 128, 144, 0.1);
            }
        </style>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "secondary-container": "#fe6a34",
                            "on-tertiary-fixed-variant": "#004e59",
                            "surface-container-lowest": "#ffffff",
                            "error": "#ba1a1a",
                            "on-surface": "#161d1c",
                            "on-background": "#161d1c",
                            "surface-container-high": "#e3eae8",
                            "surface-container": "#e8efed",
                            "error-container": "#ffdad6",
                            "on-secondary-fixed-variant": "#832600",
                            "primary-container": "#1e2d3d",
                            "on-error-container": "#93000a",
                            "surface-container-highest": "#dde4e2",
                            "surface-tint": "#516072",
                            "tertiary-fixed-dim": "#77d4e5",
                            "surface-container-low": "#eef5f3",
                            "secondary-fixed-dim": "#ffb59d",
                            "secondary": "#ab3500",
                            "tertiary-fixed": "#9eefff",
                            "surface-variant": "#dde4e2",
                            "primary-fixed-dim": "#b8c8dd",
                            "inverse-on-surface": "#ebf2f0",
                            "on-error": "#ffffff",
                            "on-tertiary": "#ffffff",
                            "outline": "#74777d",
                            "surface": "#f4fbf9",
                            "tertiary-container": "#003138",
                            "primary": "#081828",
                            "on-primary-fixed": "#0d1d2c",
                            "surface-dim": "#d4dbda",
                            "on-secondary-container": "#5d1900",
                            "primary-fixed": "#d4e4f9",
                            "secondary-fixed": "#ffdbd0",
                            "on-primary": "#ffffff",
                            "on-tertiary-container": "#3da0b0",
                            "inverse-primary": "#b8c8dd",
                            "inverse-surface": "#2b3231",
                            "on-tertiary-fixed": "#001f24",
                            "on-primary-fixed-variant": "#394859",
                            "on-primary-container": "#8594a8",
                            "outline-variant": "#c4c6cc",
                            "surface-bright": "#f4fbf9",
                            "background": "#f4fbf9",
                            "on-surface-variant": "#44474c",
                            "on-secondary-fixed": "#390c00",
                            "tertiary": "#001b1f",
                            "on-secondary": "#ffffff"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "full": "9999px"
                        },
                        "spacing": {
                            "margin-desktop": "64px",
                            "margin-mobile": "20px",
                            "gutter": "24px",
                            "unit": "8px",
                            "section-gap": "120px",
                            "container-max": "1280px"
                        },
                        "fontFamily": {
                            "label-md": ["hankenGrotesk"],
                            "button": ["hankenGrotesk"],
                            "display-lg": ["ebGaramond"],
                            "body-lg": ["hankenGrotesk"],
                            "headline-lg": ["ebGaramond"],
                            "headline-md": ["ebGaramond"],
                            "headline-lg-mobile": ["ebGaramond"],
                            "body-md": ["hankenGrotesk"]
                        },
                        "fontSize": {
                            "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "600"}],
                            "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                            "display-lg": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "500"}],
                            "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                            "headline-lg": ["48px", {"lineHeight": "1.2", "fontWeight": "500"}],
                            "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "500"}],
                            "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "500"}],
                            "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-body-md text-body-md">
        <header class="bg-surface/80 backdrop-blur-xl border-b border-primary/10 sticky top-0 z-50">
            <div class="flex justify-between items-center w-full px-margin-desktop py-4 max-w-container-max mx-auto">
                <h1 class="font-headline-md text-headline-md text-primary">Hanah</h1>
                <div class="flex items-center gap-4 text-on-surface-variant">
                    <span class="material-symbols-outlined">lock</span>
                    <span class="font-label-md text-label-md uppercase tracking-widest">Secure Checkout</span>
                </div>
            </div>
        </header>

        <main class="max-w-container-max mx-auto px-margin-desktop py-12 pt-32">
            
            {{-- POP-UP INDIKATOR ERROR KONTEN --}}
            @if($errors->any())
                <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs space-y-1">
                    <p class="font-bold uppercase tracking-wider">Gagal Validasi Formulir:</p>
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-bold">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex justify-center items-center mb-16">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-primary font-bold">
                        <span class="w-8 h-8 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center font-label-md text-label-md">1</span>
                        <span class="font-label-md text-label-md uppercase tracking-wider">Shipping</span>
                    </div>
                    <div class="w-16 h-[1px] bg-outline-variant"></div>
                    <div class="flex items-center gap-2 text-on-surface-variant/40">
                        <span class="w-8 h-8 rounded-full border-2 border-outline-variant/40 flex items-center justify-center font-label-md text-label-md">2</span>
                        <span class="font-label-md text-label-md uppercase tracking-wider">Payment</span>
                    </div>
                    <div class="w-16 h-[1px] bg-outline-variant"></div>
                    <div class="flex items-center gap-2 text-on-surface-variant/40">
                        <span class="w-8 h-8 rounded-full border-2 border-outline-variant/40 flex items-center justify-center font-label-md text-label-md">3</span>
                        <span class="font-label-md text-label-md uppercase tracking-wider">Confirmation</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('front.transaction.store', $order_id) }}" method="POST" class="grid grid-cols-12 gap-gutter items-start">
                @csrf
                <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                {{-- SINKRONISASI BATCH SUBMIT (PRODUK & BUNDLE) --}}
                @foreach($checkoutItems as $index => $item)
                    @if(!empty($item['bundle_id']))
                        <input type="hidden" name="items[{{ $index }}][bundle_id]" value="{{ $item['bundle_id'] }}">
                    @else
                        <input type="hidden" name="items[{{ $index }}][product_id]" value="{{ $item['product_id'] }}">
                    @endif
                    <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                @endforeach

                <div class="col-span-12 lg:col-span-8 space-y-12">
                    
                    <section class="space-y-8">
                        <h2 class="font-headline-md text-headline-md text-primary">Shipping Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="font-label-md text-label-md text-on-surface-variant">Full Name</label>
                                <input name="full_name" value="{{ Auth::guard('customer')->user()->name ?? '' }}" class="bg-surface-container-low border border-outline-variant rounded-none px-4 py-3 font-body-md focus:bg-white transition-all" placeholder="Johnathan Doe" type="text" required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-label-md text-label-md text-on-surface-variant">Phone Number</label>
                                <input name="phone_number" class="bg-surface-container-low border border-outline-variant rounded-none px-4 py-3 font-body-md focus:bg-white transition-all" placeholder="+62 812-3456-7890" type="tel" required/>
                            </div>
                        </div>
                    </section>

                    <section class="space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h2 class="font-headline-md text-headline-md text-primary">Alamat Pengiriman</h2>
                                <p class="text-xs text-on-surface-variant mt-0.5">Pilih salah satu alamat pengiriman eksklusif Anda yang terdaftar.</p>
                            </div>
                            <a href="{{ route('front.address.create') }}?redirect=checkout" class="inline-flex items-center text-xs font-bold text-secondary hover:underline gap-1">
                                <span class="material-symbols-outlined text-[16px]">add_location</span>
                                Tambah Alamat Baru
                            </a>
                        </div>

                        @if($addresses->isEmpty())
                            <div class="p-8 border border-dashed border-outline-variant rounded-xl text-center space-y-4 bg-surface-container-low">
                                <span class="material-symbols-outlined text-4xl text-on-surface-variant/50">location_off</span>
                                <p class="text-sm text-on-surface-variant font-medium">Anda belum mendaftarkan alamat pengiriman di akun ini.</p>
                                <a href="{{ route('front.address.create') }}?redirect=checkout" class="inline-block px-6 py-2.5 bg-primary text-white text-xs font-bold uppercase tracking-wider rounded-none">
                                    Konfigurasi Alamat Utama
                                </a>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($addresses as $index => $addr)
                                <label class="relative group cursor-pointer block">
                                    <input name="shipping_address" value="{{ $addr->full_address }}, {{ $addr->city }}, {{ $addr->postal_code }}" {{ $index === 0 ? 'checked' : '' }} class="peer sr-only" type="radio" onchange="updateAddressCardHighlight(this)"/>
                                    
                                    <div class="p-5 border {{ $index === 0 ? 'border-secondary bg-secondary-fixed/5' : 'border-outline-variant/30 bg-surface-container-low' }} rounded-xl flex flex-col justify-between h-full transition-all hover:bg-surface-container-high address-card">
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="px-2 py-0.5 bg-primary/5 text-primary text-[10px] uppercase font-bold tracking-wider rounded">
                                                    {{ $addr->address_label ?? 'Alamat' }}
                                                </span>
                                                <span class="material-symbols-outlined text-secondary opacity-0 peer-checked:group-[]:opacity-100 text-[20px]">check_circle</span>
                                            </div>
                                            
                                            <p class="font-bold text-primary text-sm">{{ $addr->recipient_name ?? (Auth::guard('customer')->user()->name ?? 'Customer') }}</p>
                                            <p class="text-xs text-on-surface-variant font-mono">{{ $addr->recipient_phone ?? '-' }}</p>
                                            
                                            <p class="text-xs text-on-surface-variant leading-relaxed pt-1">
                                                {{ $addr->full_address }}, {{ $addr->city }}, {{ $addr->postal_code }}
                                            </p>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        @endif
                    </section>

                    <hr class="border-outline-variant/30"/>

                    <section class="space-y-6">
                        <div>
                            <h2 class="font-headline-md text-headline-md text-primary">Payment Method</h2>
                            <p class="text-xs text-on-surface-variant mt-0.5">Pilih metode pembayaran aman di bawah ini.</p>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($paymentMethods as $index => $method)
                            <div class="border {{ $index === 0 ? 'border-secondary bg-secondary-fixed/5' : 'border-outline-variant/40 bg-white' }} rounded-xl overflow-hidden transition-all duration-300 method-row-container">
                                
                                <label class="flex items-center justify-between p-5 cursor-pointer select-none group w-full">
                                    <div class="flex items-center gap-4">
                                        <input value="{{ $method->id }}" data-code="{{ $method->code }}" {{ $index === 0 ? 'checked' : '' }} class="text-secondary focus:ring-secondary main-payment-radio w-4 h-4" name="payment_method_id" type="radio" onchange="handleVerticalPaymentSwitch(this)"/>
                                        
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-2xl {{ $index === 0 ? 'text-secondary' : 'text-on-surface-variant' }} payment-icon">
                                                @if($method->code == 'cod') local_shipping
                                                @elseif($method->code == 'bank_transfer') account_balance
                                                @elseif($method->code == 'mitra') store
                                                @else wallet
                                                @endif
                                            </span>
                                            <span class="font-label-md text-sm font-bold text-primary">{{ $method->name }}</span>
                                        </div>
                                    </div>
                                    
                                    @php
                                        $hasChannels = $paymentChannels->where('payment_method_id', $method->id)->isNotEmpty();
                                    @endphp
                                    @if($hasChannels)
                                        <span class="material-symbols-outlined text-on-surface-variant/60 transition-transform duration-300 {{ $index === 0 ? 'rotate-180' : '' }} arrow-icon">expand_more</span>
                                    @endif
                                </label>

                                @if($hasChannels)
                                <div class="channel-dropdown-content px-5 pb-5 border-t border-outline-variant/10 pt-4 bg-surface-container-low/40 {{ $index === 0 ? '' : 'hidden' }}">
                                    <label class="font-label-md text-[11px] font-bold uppercase tracking-wider text-on-surface-variant/80 block mb-3">Pilih Opsi Saluran:</label>
                                    
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        @foreach($paymentChannels->where('payment_method_id', $method->id) as $cIndex => $channel)
                                        <label class="relative group cursor-pointer block">
                                            <input value="{{ $channel->id }}" {{ $cIndex === 0 && $index === 0 ? 'checked' : '' }} class="peer sr-only channel-radio" name="payment_channel_id" type="radio"/>
                                            <div class="p-3.5 border border-outline-variant/60 peer-checked:border-secondary peer-checked:bg-white bg-white/70 rounded-lg flex justify-between items-center transition-all hover:bg-white">
                                                <div class="flex flex-col">
                                                    <span class="text-xs font-bold text-primary">{{ $channel->name }}</span>
                                                    @if($channel->account_number)
                                                        <span class="text-[10px] text-on-surface-variant font-mono mt-0.5">No: {{ $channel->account_number }}</span>
                                                    @endif
                                                </div>
                                                <span class="material-symbols-outlined text-secondary opacity-0 peer-checked:opacity-100 text-[16px]">check_circle</span>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </section>

                    <hr class="border-outline-variant/30"/>

                    <section class="space-y-6">
                        <h2 class="font-headline-md text-headline-md text-primary">Shipping Carrier</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($shippings as $key => $ship)
                            <label class="relative group cursor-pointer block">
                                <input name="shipping_id" value="{{ $ship->id }}" data-cost="{{ $ship->cost }}" {{ $key === 0 ? 'checked' : '' }} class="peer sr-only animate-shipping-input" type="radio" onchange="calculateGrandTotal(this)"/>
                                <div class="p-6 border {{ $key === 0 ? 'border-secondary-container bg-secondary-fixed/10' : 'border-outline-variant' }} flex flex-col justify-between h-full transition-all hover:bg-surface-container-high shipping-card-box">
                                    <div class="flex justify-between items-center w-full mb-2">
                                        <span class="font-label-md text-label-md uppercase tracking-wider font-bold text-primary">{{ $ship->courier_name }}</span>
                                        <span class="font-bold text-secondary text-sm">Rp {{ number_format($ship->cost, 0, ',', '.') }}</span>
                                    </div>
                                    <span class="text-xs text-on-surface-variant block">Service: {{ $ship->service_name }} ({{ $ship->estimated_time }})</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </section>

                    <div class="flex items-center gap-8 py-4 opacity-60 pt-6">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">verified_user</span>
                            <span class="font-label-md text-label-md uppercase tracking-wider text-xs">SSL Secure Connection</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">encrypted</span>
                            <span class="font-label-md text-label-md uppercase tracking-wider text-xs">Encrypted Infrastructure</span>
                        </div>
                    </div>
                </div>

                <aside class="col-span-12 lg:col-span-4 lg:sticky lg:top-28">
                    <div class="glass-card p-8 space-y-8 bg-white/70 rounded-xl border border-outline-variant/20">
                        <h3 class="font-headline-md text-headline-md text-primary">Order Summary</h3>
                        
                        <div class="space-y-6 max-h-[340px] overflow-y-auto pr-2">
                            @foreach($checkoutItems as $item)
                                @php
                                    $isItemBundle   = !empty($item['bundle_id']);
                                    $imageSubfolder = $isItemBundle ? 'bundles/' : 'products/';
                                    $displayImage   = $item['featured_image'] ?? 'default.jpg';
                                @endphp
                            <div class="flex gap-4 border-b border-outline-variant/10 pb-4 last:border-none last:pb-0">
                                <div class="w-20 h-20 bg-surface-container-highest overflow-hidden rounded border border-outline-variant/10 flex-shrink-0">
                                    <img class="w-full h-full object-cover" src="{{ asset('admin/images/' . $imageSubfolder . $displayImage) }}" onerror="this.src='{{ asset('admin/images/products/default.jpg') }}'"/>
                                </div>
                                <div class="flex-1 min-w-0">
                                    @if($isItemBundle)
                                        <span class="text-[9px] bg-secondary-container/10 text-secondary font-bold uppercase tracking-wider px-2 py-0.5 rounded">Exclusive Bundle</span>
                                    @endif
                                    <h4 class="font-headline-md text-[16px] leading-tight mb-1 text-primary truncate mt-1">{{ $item['name'] }}</h4>
                                    <p class="text-on-surface-variant text-sm mb-1">Quantity: {{ $item['quantity'] }} pcs</p>
                                    <span class="font-label-md text-label-md text-secondary font-bold">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <hr class="border-outline-variant/30"/>

                        <div class="space-y-3 text-sm font-medium">
                            <div class="flex justify-between text-on-surface-variant">
                                <span>Subtotal Item</span>
                                <span class="text-primary font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-on-surface-variant">
                                <span>Shipping Cost</span>
                                <span class="text-primary font-bold" id="shipping-fee">
                                    Rp {{ number_format(($shippings->first()->cost ?? 0), 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="pt-4 flex justify-between items-center font-headline-md text-headline-md border-t border-primary/10 mt-4">
                                <span class="text-base text-primary font-bold">Grand Total</span>
                                <span class="text-xl font-bold text-secondary font-headline-md" id="grand-total" data-subtotal="{{ $subtotal }}">
                                    Rp {{ number_format($subtotal + ($shippings->first()->cost ?? 0), 0, ',', '.') }}
                                </span>
                            </div>

                            <button type="submit" class="w-full bg-primary text-white py-5 font-button text-button uppercase tracking-[0.2em] hover:bg-[#122335] transition-colors active:scale-[0.98] duration-200 cursor-pointer text-center block mt-6">
                                Place Order
                            </button>
                            <p class="text-center text-xs text-on-surface-variant/70 leading-relaxed mt-4">
                                By placing your order, you agree to Hanah's <br/>
                                <a class="underline hover:text-primary" href="#">Terms of Service</a> and <br/>
                                <a class="underline hover:text-primary" href="#">Privacy Policy</a>.
                            </p>
                        </div>
                    </div>
                </aside>
            </form>
        </main>

        <footer class="bg-primary py-12 mt-section-gap">
            <div class="max-w-container-max mx-auto px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-8">
                <span class="font-headline-md text-white">Hanah</span>
                <div class="flex gap-8">
                    <a class="text-on-primary/60 font-label-md text-label-md uppercase tracking-widest hover:text-white transition-colors" href="#">Privacy</a>
                    <a class="text-on-primary/60 font-label-md text-label-md uppercase tracking-widest hover:text-white transition-colors" href="#">Terms</a>
                    <a class="text-on-primary/60 font-label-md text-label-md uppercase tracking-widest hover:text-white transition-colors" href="#">Support</a>
                </div>
                <p class="text-on-primary/40 text-xs">© 2026 Hanah Luxury Fragrance. All Rights Reserved.</p>
            </div>
        </footer>

        <script>
            function calculateGrandTotal(radioInput) {
                const cost = parseFloat(radioInput.getAttribute('data-cost'));
                const grandTotalContainer = document.getElementById('grand-total');
                const subtotal = parseFloat(grandTotalContainer.getAttribute('data-subtotal'));

                document.getElementById('shipping-fee').innerText = 'Rp ' + cost.toLocaleString('id-ID');

                const finalGrandTotal = subtotal + cost;
                grandTotalContainer.innerText = 'Rp ' + finalGrandTotal.toLocaleString('id-ID');

                document.querySelectorAll('.shipping-card-box').forEach(card => {
                    card.classList.remove('border-secondary-container', 'bg-secondary-fixed/10');
                    card.classList.add('border-outline-variant');
                });

                const currentBox = radioInput.closest('label').querySelector('.shipping-card-box');
                currentBox.classList.remove('border-outline-variant');
                currentBox.classList.add('border-secondary-container', 'bg-secondary-fixed/10');
            }

            function updateAddressCardHighlight(radioInput) {
                document.querySelectorAll('.address-card').forEach(card => {
                    card.classList.remove('border-secondary', 'bg-secondary-fixed/5');
                    card.classList.add('border-outline-variant/30', 'bg-surface-container-low');
                });
                const targetCard = radioInput.closest('label').querySelector('.address-card');
                targetCard.classList.remove('border-outline-variant/30', 'bg-surface-container-low');
                targetCard.classList.add('border-secondary', 'bg-secondary-fixed/5');
            }

            function handleVerticalPaymentSwitch(radioInput) {
                document.querySelectorAll('.method-row-container').forEach(container => {
                    container.classList.remove('border-secondary', 'bg-secondary-fixed/5');
                    container.classList.add('border-outline-variant/40', 'bg-white');
                    
                    const icon = container.querySelector('.payment-icon');
                    if (icon) {
                        icon.classList.add('text-on-surface-variant');
                        icon.classList.remove('text-secondary');
                    }

                    const arrow = container.querySelector('.arrow-icon');
                    if (arrow) arrow.classList.remove('rotate-180');

                    const dropdown = container.querySelector('.channel-dropdown-content');
                    if (dropdown) {
                        dropdown.classList.add('hidden');
                        dropdown.querySelectorAll('.channel-radio').forEach(r => {
                            r.checked = false;
                        });
                    }
                });

                const currentContainer = radioInput.closest('.method-row-container');
                currentContainer.classList.remove('border-outline-variant/40', 'bg-white');
                currentContainer.classList.add('border-secondary', 'bg-secondary-fixed/5');

                const activeIcon = currentContainer.querySelector('.payment-icon');
                if (activeIcon) {
                    activeIcon.classList.remove('text-on-surface-variant');
                    activeIcon.classList.add('text-secondary');
                }

                const currentDropdown = currentContainer.querySelector('.channel-dropdown-content');
                const currentArrow = currentContainer.querySelector('.arrow-icon');
                
                if (currentDropdown) {
                    currentDropdown.classList.remove('hidden');
                    if (currentArrow) currentArrow.classList.add('rotate-180');

                    const firstChannelRadio = currentDropdown.querySelector('.channel-radio');
                    if (firstChannelRadio) firstChannelRadio.checked = true;
                }
            }

            document.addEventListener("DOMContentLoaded", function() {
                const defaultRadio = document.querySelector('.main-payment-radio:checked');
                if (defaultRadio) {
                    const activeContainer = defaultRadio.closest('.method-row-container');
                    const dropdown = activeContainer.querySelector('.channel-dropdown-content');
                    if (dropdown) {
                        const firstRadio = dropdown.querySelector('.channel-radio');
                        if (firstRadio) firstRadio.checked = true;
                    }
                }
            });
        </script>
    </body>
</html>