@extends('front.layout.layout')

@section('content')
<main>
            <!-- Hero Section -->
            <section class="relative h-screen min-h-[700px] flex items-center overflow-hidden">
                <div class="absolute inset-0 z-0">
                    <img alt="Luxury Fragrance Hero" class="w-full h-full object-cover" data-alt="A macro close-up of a high-end luxury perfume bottle standing elegantly on a cool-toned reflective marble surface. Soft, cinematic morning light enters from the side, creating ethereal shadows and highlighting the golden liquid inside the minimalist glass vessel. The overall aesthetic is clean, sophisticated, and tranquil, reflecting the premium Hanah brand identity with a palette of deep navy, muted turquoise, and warm amber." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSB3hRp8FWbQJHiPttChlUGrUQXfEeeuUBieJyVkkFlUYs8rtGZHT2XvExoWLKojwDnWTs1IUdypZwi8d1srA7lkJvJsr5-cQMd05x9ef-1pRUF8CuPhMzQW4EYcSJXvKucGKbtZ-XvTtZtEcIShYm1CZmeJsJvudCKZLeolxr9Gwcmc5GBuk1vS6KBHqKJ5JIQWRLeFGi7exRAa7KLrZwVxJEMgsbaloxTVKWxMK6OtK7TcSoe9CvIgC92A4ODzwXqK-VtQhyPhs">
                    <div class="absolute inset-0 bg-gradient-to-r from-background/40 to-transparent"></div>
                </div>
                <div class="relative z-10 px-margin-desktop max-w-container-max mx-auto w-full">
                    <div class="max-w-2xl">
                        <h1 class="font-display-lg text-display-lg text-primary mb-6 animate-fade-in">Find Happiness Through Every Scent</h1>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-lg">Discover our curated collection of artisanal fragrances designed to evoke memories and inspire tranquility. Crafted with the world's rarest ingredients.</p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('front.shop') }}" class="inline-block bg-[#FF6B35] hover:bg-[#E85A2A] text-surface px-10 py-4 rounded-lg transition-colors duration-300 font-bold shadow-lg text-center">
                                Shop Now
                            </a>

                        </div>
                    </div>
                </div>
            </section>
            <!-- Why Choose Hanah -->
            <section class="py-section-gap px-margin-desktop max-w-container-max mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter">
                    <div class="flex flex-col items-center text-center p-8 bg-surface-container-low rounded-xl border border-outline-variant/10 hover:shadow-md transition-standard group">
                        <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mb-6 text-secondary-container group-hover:scale-110 transition-standard">
                            <span class="material-symbols-outlined text-3xl" data-icon="auto_awesome">auto_awesome</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-2 text-[20px]">Premium Ingredients</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Rare essences sourced from the finest gardens globally.</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-8 bg-surface-container-low rounded-xl border border-outline-variant/10 hover:shadow-md transition-standard group">
                        <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mb-6 text-secondary-container group-hover:scale-110 transition-standard">
                            <span class="material-symbols-outlined text-3xl" data-icon="schedule">schedule</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-2 text-[20px]">Long Lasting</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Complex formulations that stay with you all day and night.</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-8 bg-surface-container-low rounded-xl border border-outline-variant/10 hover:shadow-md transition-standard group">
                        <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mb-6 text-secondary-container group-hover:scale-110 transition-standard">
                            <span class="material-symbols-outlined text-3xl" data-icon="local_shipping">local_shipping</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-2 text-[20px]">Fast Delivery</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">White-glove shipping experience to your doorstep.</p>
                    </div>
                    <div class="flex flex-col items-center text-center p-8 bg-surface-container-low rounded-xl border border-outline-variant/10 hover:shadow-md transition-standard group">
                        <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mb-6 text-secondary-container group-hover:scale-110 transition-standard">
                            <span class="material-symbols-outlined text-3xl" data-icon="verified_user">verified_user</span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-2 text-[20px]">Secure Payment</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Fully encrypted transactions for your peace of mind.</p>
                    </div>
                </div>
            </section>
            <!-- Best Sellers Section -->
            <section class="py-section-gap bg-surface-container">
                <div class="px-margin-desktop max-w-container-max mx-auto">
                    <div class="flex justify-between items-end mb-16">
                        <div>
                            <span class="text-secondary-container font-label-md text-label-md uppercase tracking-widest mb-4 block">Our Curation</span>
                            <h2 class="font-headline-lg text-headline-lg text-primary">The Best Sellers</h2>
                        </div>
                        <a class="text-primary font-label-md text-label-md border-b border-primary hover:text-secondary-container hover:border-secondary-container transition-standard" href="{{ route('front.shop') }}">View All Products</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
                        
                        @forelse($bestSellers ?? [] as $product)
                            @php
                                // Ambil properti adaptif untuk menembus standarisasi huruf kapital Oracle DB
                                $pName  = $product->name ?? ($product->NAME ?? 'Premium Fragrance');
                                $pPrice = $product->price ?? ($product->PRICE ?? 0);
                                $pSlug  = $product->slug ?? ($product->SLUG ?? '#');
                                $pImg   = $product->featured_image ?? ($product->FEATURED_IMAGE ?? null);
                                $pType  = $product->fragrance_type_name ?? ($product->FRAGRANCE_TYPE_NAME ?? 'Artisanal Perfume');
                            @endphp

                            <div class="group bg-surface rounded-xl overflow-hidden hover:shadow-xl transition-standard">
                                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container-highest">
                                    
                                    <!-- Fallback Gambar Otomatis dari Storage atau Link Default Asset -->
                                    <img alt="{{ $pName }}" class="w-full h-full object-cover group-hover:scale-105 transition-standard" 
                                         src="{{ $pImg ? asset('admin/images/products/' . $pImg) : asset('admin/images/products/default.jpg') }}"
                                         onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuDcYg3P9w77e0X6dOC9InqUNDMYqB7sq_1u7ixV5G6aqKVza6MHGXekhp6eAIBRxT17ew4jgbHWnjjXG18VSsI6bnrXRwht6ZQSzxIyvx9u46NTMMqCRee9OO8KqrNEK-BsTHUZGYzIXLrZfvBWOKi1aVJqUBLddDhZKLUBQwY6BB98hwIceDWmPxUYmm3edt_3Fa_IdT9LKtEgeJJXUTY3VHL6YLQpNGVazffIGAYeIpqLhq3R8lmQe4kMak_mtKTXa7P5dVtEp9Y'">
                                    
                                    <a href="{{ url('shop/' . $pSlug) }}" class="absolute bottom-6 left-1/2 -translate-x-1/2 translate-y-12 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 bg-primary text-white text-center py-3 rounded-lg font-button text-xs uppercase tracking-wider transition-all duration-300 w-[80%] block">
                                        View Details
                                    </a>
                                </div>
                                <div class="p-8 text-center">
                                    <span class="text-on-surface-variant font-label-md text-xs uppercase tracking-wider block mb-1">{{ $pType }}</span>
                                    <h3 class="font-headline-md text-primary my-2 text-[22px] font-bold line-clamp-1">{{ $pName }}</h3>
                                    
                                    <div class="flex justify-center gap-1 mb-3 text-[#FF6B35]">
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    </div>
                                    <p class="font-label-md text-base text-secondary font-bold">Rp {{ number_format($pPrice, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-20 text-on-surface-variant/60 font-medium text-sm border border-dashed border-outline-variant/30 bg-surface-container-low rounded-2xl">
                                <span class="material-symbols-outlined text-4xl text-on-surface-variant/40 block mb-2">layers_clear</span>
                                No best sellers curated at the moment.
                            </div>
                        @endforelse

                    </div>
                </div>
            </section>
            <!-- New Arrivals Section (Horizontal Bento Layout) -->
            <section class="py-section-gap px-margin-desktop max-w-container-max mx-auto overflow-hidden">
                <div class="mb-16">
                    <span class="text-secondary-container font-label-md text-label-md uppercase tracking-widest mb-4 block">Newest Release</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary">Exquisite Arrivals</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter h-[600px]">
                    
                    {{-- TAMPILAN PRODUK PALING BARU (Urutan Teratas dari Created_at) --}}
                    @if(isset($newArrivals) && count($newArrivals) > 0)
                        @php $mainNew = $newArrivals[0]; @endphp
                        <div class="md:col-span-2 relative group rounded-xl overflow-hidden">
                            <img alt="{{ $mainNew->name }}" class="w-full h-full object-cover transition-standard duration-700 group-hover:scale-110" src="{{ $mainNew->featured_image ? asset('storage/' . $mainNew->featured_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI-z7kuKFTr20cfwtW5JBTx59AC645b7np5SLqWuFhdNeGs1KkVFJoK1pD0SJESK3dezV4xdqwIeG8UK3d0QHpeIgvW7BuWdlHREpRyd7Q1ghpD-fEXyL-zrrOMRzCxwmJbjczFf41IAep6urLCJinGU_kZ6TOhNuNhRvL3KGujD0bWdJBtWiw-xLMrW8R_Lvx7EawHvIjIc7Riz0qiQY69wouskFQ9UvxkFL0ZuSQBIV_MuojHG0wd_FnBMZq0LTs-Pv1dcMZO94' }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-standard flex flex-col justify-end p-12">
                                <h3 class="font-headline-lg text-headline-lg text-white mb-4">{{ $mainNew->name }}</h3>
                                <p class="text-white/80 font-body-lg mb-6 max-w-md">{{ Str::limit($mainNew->description, 120) }}</p>
                                <a href="{{ url('shop/' . $mainNew->slug) }}" class="bg-secondary-container text-white w-fit px-8 py-3 rounded-lg font-button inline-block">Explore New Scent</a>
                            </div>
                            <button class="absolute top-6 right-6 w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-white hover:text-primary transition-standard">
                                <span class="material-symbols-outlined" data-icon="favorite">favorite</span>
                            </button>
                        </div>
                    @else
                        <div class="md:col-span-2 relative group rounded-xl overflow-hidden bg-surface-container-high flex items-center justify-center text-on-surface-variant">
                            New drop arrival arriving soon.
                        </div>
                    @endif

                    <div class="flex flex-col gap-gutter">
                        {{-- Item Baru Ke-2 jika tersedia --}}
                        @if(isset($newArrivals) && count($newArrivals) > 1)
                            @php $secondNew = $newArrivals[1]; @endphp
                            <div class="relative flex-1 group rounded-xl overflow-hidden bg-surface-container-high p-8 flex flex-col justify-center items-center text-center">
                                <img alt="{{ $secondNew->name }}" class="w-32 h-32 object-contain mb-6 group-hover:rotate-12 transition-standard" src="{{ $secondNew->featured_image ? asset('storage/' . $secondNew->featured_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDWw4ew-KHPPGMXcI6Vx2vn1LxTByGDvJ5QojuWO8UrX8HECDPDIHX-zPtmoAE7HWv-7is47t2Wiu5MQz88-MSZWVI8gUGFtqYgaiYrEpS9gktMJ1-7AlCt-Yg2-QhghV8LSerwLbANnIi2gW86qaagyKWS9eRuVvtuoFSPT7OuJj8iP4XaoJ4wBeLF5IRyaQgW2Ee5bqr-OgHiPxVbyxgA5lyr7pgg3XcC4HX2TvuGup4nLtxm0-JYb-_MtBl3jQB_PPTLlCqs2bM' }}">
                                <h4 class="font-headline-md text-headline-md text-primary text-[22px] mb-2">{{ $secondNew->name }}</h4>
                                <p class="text-on-surface-variant text-sm mb-4">Rp {{ number_format($secondNew->price, 0, ',', '.') }}</p>
                                <a href="{{ url('shop/' . $secondNew->slug) }}" class="text-secondary-container font-label-md border-b border-secondary-container pb-1">Shop Now</a>
                            </div>
                        @else
                            <div class="relative flex-1 group rounded-xl overflow-hidden bg-surface-container-high p-8 flex flex-col justify-center items-center text-center">
                                <span class="material-symbols-outlined text-4xl mb-2 text-primary/20">bubble_chart</span>
                                <h4 class="font-headline-md text-headline-md text-primary text-[22px] mb-2">Discovery Set</h4>
                                <p class="text-on-surface-variant text-sm mb-4">Try all 5 signature scents</p>
                                <button class="text-secondary-container font-label-md border-b border-secondary-container pb-1">Shop Now</button>
                            </div>
                        @endif

                        {{-- Item Baru Ke-3 jika tersedia --}}
                        @if(isset($newArrivals) && count($newArrivals) > 2)
                            @php $thirdNew = $newArrivals[2]; @endphp
                            <div class="relative flex-1 group rounded-xl overflow-hidden">
                                <img alt="{{ $thirdNew->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-standard" src="{{ $thirdNew->featured_image ? asset('storage/' . $thirdNew->featured_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAZUXPx0QLqPoNZJ_ZxILO7Y9vr8XYybGa6JkfMszvSnrQT7ep1ZigR5kzRLjzHlEOhWZ1fvhvHFkWcQDqyFlYJuxtt5bwdaaByedex-g8RzfQZ2-PfYVLJ4i4q-WZ0_bf0J-zN7Iq2kkwZxOo2AsolMkxopogi61MmTklBTL7BwqNGUjpLQxxkBH5SFrhMkiErWcd1p1UYhIGItaBEMOFmZew4550FQ9A5zUTJazDOK-Rz7W8ITINv73DcRUejKpVW7uNA-2GNN9o' }}">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-standard flex items-center justify-center">
                                    <span class="text-white font-headline-md text-[24px]">{{ $thirdNew->name }}</span>
                                </div>
                            </div>
                        @else
                            <div class="relative flex-1 group rounded-xl overflow-hidden">
                                <img alt="Leather &amp; Wood" class="w-full h-full object-cover group-hover:scale-105 transition-standard" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZUXPx0QLqPoNZJ_ZxILO7Y9vr8XYybGa6JkfMszvSnrQT7ep1ZigR5kzRLjzHlEOhWZ1fvhvHFkWcQDqyFlYJuxtt5bwdaaByedex-g8RzfQZ2-PfYVLJ4i4q-WZ0_bf0J-zN7Iq2kkwZxOo2AsolMkxopogi61MmTklBTL7BwqNGUjpLQxxkBH5SFrhMkiErWcd1p1UYhIGItaBEMOFmZew4550FQ9A5zUTJazDOK-Rz7W8ITINv73DcRUejKpVW7uNA-2GNN9o">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-standard flex items-center justify-center">
                                    <span class="text-white font-headline-md text-[24px]">Leather &amp; Wood</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <!-- Bundle Promotion Banner -->
            <section class="my-section-gap px-margin-desktop max-w-container-max mx-auto">
                <div class="relative rounded-[2rem] overflow-hidden bg-primary p-12 md:p-24 flex flex-col md:flex-row items-center gap-12">
                    <div class="absolute top-0 right-0 w-1/2 h-full opacity-30 mix-blend-overlay"></div>
                    <div class="relative z-10 flex-1 text-center md:text-left">
                        <span class="text-secondary-container font-label-md uppercase tracking-[.25em] mb-6 block">Exclusive Offers</span>
                        <h2 class="font-headline-lg text-headline-lg text-white mb-6">Fragrance Bundles: Save up to 25%</h2>
                        <p class="text-on-primary-container font-body-lg mb-10 max-w-lg">Create your own signature scent layers with our curated duo and trio bundles. Limited time seasonal pairing available.</p>
                        <button class="bg-secondary-container text-white px-12 py-5 rounded-lg font-button text-button hover:scale-105 transition-standard">View Bundle Collections</button>
                    </div>
                    <div class="relative z-10 flex-1">
                        <img alt="Bundle Collections" class="rounded-2xl shadow-2xl rotate-3 hover:rotate-0 transition-standard" data-alt="A premium still-life arrangement of three distinct perfume bottles from the Hanah collection, grouped together on a slab of dark volcanic rock. The bottles have metallic caps and minimalist labels. The lighting is dramatic, spotlighting the products while keeping the edges in soft shadow. The mood is one of quiet luxury and high-end curation." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCto4j7oCRBtvUyfzpjiZBPrt0_Z6V_Zq90H_VoRquTFxsswzMbG2bVmwlKPWfAfGnDIQlUYkFG9rOxLYVF4ADfQovD-GOV3XqhRWxf1G2xrXSkRsqcyKchcbO-FrSAbzq44gDGq4vmfxdoiae8lfF4FTlxk4r17Xpq2hFrVMONeqvJQUHj0bM9PIh538qVTQN5oaIWAef1RbPLQ8XN7ZcRL0lp83sdAgvBXvRJQ1ZD4sPK63fVDZEP5Xkt_zFlm6NpBdEG04fPeqM">
                    </div>
                </div>
            </section>
            <!-- Testimonials -->
            <section class="py-section-gap bg-surface-container-low overflow-hidden">
                <div class="px-margin-desktop max-w-container-max mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Reflections of Excellence</h2>
                        <p class="text-on-surface-variant font-body-lg">Voices from our esteemed clientele</p>
                    </div>
                    <div class="flex gap-gutter overflow-x-auto pb-8 snap-x no-scrollbar">
                        <!-- Testimonial 1 -->
                        <div class="min-w-[400px] bg-white p-10 rounded-2xl luxury-shadow border border-outline-variant/10 snap-center">
                            <div class="flex gap-1 text-secondary-container mb-6">
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                            </div>
                            <p class="font-headline-md text-[20px] text-primary italic mb-8">"The Midnight Ocean scent is a masterpiece. I've never received so many compliments in a single day. Pure class."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-secondary-container">
                                    <span class="material-symbols-outlined" data-icon="brush">brush</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-primary">Julian R.</p>
                                    <p class="text-xs text-on-surface-variant">Connoisseur</p>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial 2 -->
                        <div class="min-w-[400px] bg-white p-10 rounded-2xl luxury-shadow border border-outline-variant/10 snap-center">
                            <div class="flex gap-1 text-secondary-container mb-6">
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                            </div>
                            <p class="font-headline-md text-[20px] text-primary italic mb-8">"Fastest delivery I've ever experienced for high-end retail. The packaging itself was a sensorial delight."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-tertiary-container flex items-center justify-center text-tertiary-fixed-dim">
                                    <span class="material-symbols-outlined" data-icon="ink_pen">ink_pen</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-primary">Marcus W.</p>
                                    <p class="text-xs text-on-surface-variant">Frequent Shopper</p>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial 3 -->
                        <div class="min-w-[400px] bg-white p-10 rounded-2xl luxury-shadow border border-outline-variant/10 snap-center">
                            <div class="flex gap-1 text-secondary-container mb-6">
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                                <span class="material-symbols-outlined" style="font-variation-settings: "FILL" 1;">star</span>
                            </div>
                            <p class="font-headline-md text-[20px] text-primary italic mb-8">"Hanah doesn't just sell perfume; they curate experiences. Each scent tells a complex, evolving story."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-secondary-fixed-dim flex items-center justify-center text-on-secondary-container">
                                    <span class="material-symbols-outlined" data-icon="architecture">architecture</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-primary">Alexander V.</p>
                                    <p class="text-xs text-on-surface-variant">Design Critic</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Newsletter Section -->
            <section class="py-section-gap px-margin-desktop">
                <div class="max-w-4xl mx-auto bg-surface-container-low rounded-3xl p-12 md:p-20 text-center border border-outline-variant/20">
                    <span class="material-symbols-outlined text-4xl text-secondary-container mb-6" data-icon="mail">mail</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Join The Hanah Circle</h2>
                    <p class="font-body-lg text-on-surface-variant mb-10">Receive early access to limited edition drops and olfactory insights from our master perfumers.</p>
                    <form class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                        <input class="flex-1 px-6 py-4 rounded-lg bg-surface border border-outline-variant focus:border-secondary-container focus:ring-0 transition-standard outline-none" placeholder="Your Email Address" type="email">
                        <button class="bg-primary text-white px-8 py-4 rounded-lg font-button hover:opacity-90 transition-standard">Subscribe</button>
                    </form>
                </div>
            </section>
        </main>

        <script>
            // Simple scroll interaction for header
            window.addEventListener('scroll', () => {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    if(header) {
                        header.classList.add('py-2', 'shadow-md');
                        header.classList.remove('py-4', 'shadow-sm');
                    }
                } else {
                    if(header) {
                        header.classList.add('py-4', 'shadow-sm');
                        header.classList.remove('py-2', 'shadow-md');
                    }
                }
            });
            
            // Testimonial scroll control
            const scrollContainer = document.querySelector('.snap-x');
            if (scrollContainer) {
                let isDown = false;
                let startX;
                let scrollLeft;
                
                scrollContainer.addEventListener('mousedown', (e) => {
                    isDown = true;
                    scrollContainer.classList.add('active');
                    startX = e.pageX - scrollContainer.offsetLeft;
                    scrollLeft = scrollContainer.scrollLeft;
                });
                scrollContainer.addEventListener('mouseleave', () => {
                    isDown = false;
                });
                scrollContainer.addEventListener('mouseup', () => {
                    isDown = false;
                });
                scrollContainer.addEventListener('mousemove', (e) => {
                    if(!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - scrollContainer.offsetLeft;
                    const walk = (x - startX) * 2;
                    scrollContainer.scrollLeft = scrollLeft - walk;
                });
            }
        </script>
@endsection