<header class="bg-surface/80 dark:bg-surface-container-highest/80 backdrop-blur-xl text-primary dark:text-on-primary-fixed docked full-width top-0 sticky border-b border-primary/10 z-50 py-4 shadow-sm">
    <nav class="flex justify-between items-center w-full px-margin-desktop py-4 max-w-container-max mx-auto">
        <div class="flex items-center gap-12">
            <a class="font-headline-md text-headline-md text-primary dark:text-on-primary-fixed" href="{{ route('front.home') }}">Hanah</a>
            <ul class="hidden md:flex gap-8 items-center">
                <li>
                    <a class="{{ Route::is('front.home') ? 'text-secondary-container font-bold border-b-2 border-secondary-container pb-1' : 'text-on-surface-variant dark:text-on-surface-variant hover:text-secondary-container transition-colors duration-300' }} font-label-md text-label-md" href="{{ route('front.home') }}">Home</a>
                </li>
                <li>
                    <a class="{{ Route::is('front.shop*') ? 'text-secondary-container font-bold border-b-2 border-secondary-container pb-1' : 'text-on-surface-variant dark:text-on-surface-variant hover:text-secondary-container transition-colors duration-300' }} font-label-md text-label-md" href="{{ route('front.shop') }}">Shop</a>
                </li>
                <li>
                    <a class="{{ Route::is('front.bundles*') ? 'text-secondary-container font-bold border-b-2 border-secondary-container pb-1' : 'text-on-surface-variant dark:text-on-surface-variant hover:text-secondary-container transition-colors duration-300' }} font-label-md text-label-md" href="{{ route('front.bundles') }}">Bundles</a>
                </li>
                <li>
                    <a class="{{ Route::is('front.about*') ? 'text-secondary-container font-bold border-b-2 border-secondary-container pb-1' : 'text-on-surface-variant dark:text-on-surface-variant hover:text-secondary-container transition-colors duration-300' }} font-label-md text-label-md" href="{{ route('front.about') }}">About</a>
                </li>
                <li>
                    <a class="{{ Route::is('front.blog.index*') || Route::is('front.blog*') ? 'text-secondary-container font-bold border-b-2 border-secondary-container pb-1' : 'text-on-surface-variant dark:text-on-surface-variant hover:text-secondary-container transition-colors duration-300' }} font-label-md text-label-md" href="{{ route('front.blog.index') }}">Blog</a>
                </li>
                <li>
                    <a class="{{ Route::is('front.contact*') ? 'text-secondary-container font-bold border-b-2 border-secondary-container pb-1' : 'text-on-surface-variant dark:text-on-surface-variant hover:text-secondary-container transition-colors duration-300' }} font-label-md text-label-md" href="{{ route('front.contact') }}">Contact</a>
                </li>
            </ul>
        </div>
        
        <div class="flex items-center gap-6">
            <!-- Pencarian Wrapper -->
            <div class="relative inline-block text-left" id="search-wrapper">
                <button id="menu-search-btn" class="material-symbols-outlined text-primary hover:text-secondary-container transition-standard cursor-pointer flex items-center focus:outline-none" data-icon="search">search</button>
                
                <div id="menu-search-dropdown" class="hidden absolute right-0 mt-3 w-80 sm:w-96 origin-top-right rounded-xl bg-white dark:bg-surface-container-highest shadow-[0px_8px_32px_rgba(30,45,61,0.15)] border border-navy/10 p-4 z-[999]">
                    <div class="flex items-center gap-2 border-b border-navy/10 pb-2 mb-3">
                        <span class="material-symbols-outlined text-on-surface-variant">search</span>
                        <input type="text" id="search-input" autocomplete="off" placeholder="Search products or bundles..." class="w-full bg-transparent border-none text-xs text-primary focus:ring-0 outline-none p-0">
                    </div>
                    <div id="search-results-container" class="max-h-64 overflow-y-auto space-y-2 divide-y divide-navy/5 text-xs">
                        <p class="text-on-surface-variant/60 text-center py-4">Type something to begin searching...</p>
                    </div>
                </div>
            </div>
            
            <!-- Profil Account Wrapper (FIXED: Ditambahkan ID pembungkus untuk proteksi JS click) -->
            <div class="relative inline-block text-left" id="profile-wrapper">
                <button type="button" id="menu-profile-btn" class="material-symbols-outlined text-primary hover:text-secondary-container transition-standard cursor-pointer flex items-center focus:outline-none">
                    person
                </button>

                <div id="menu-profile-dropdown" class="hidden absolute right-0 mt-3 w-48 origin-top-right rounded-xl bg-white dark:bg-surface-container-highest shadow-[0px_8px_32px_rgba(30,45,61,0.15)] border border-navy/10 p-2 z-[999]">
                    @auth('customer')
                        <div class="px-3 py-2 border-b border-navy/5 mb-1">
                            <p class="text-[10px] font-medium text-navy/40 uppercase tracking-wider">Account</p>
                            <p class="text-xs font-semibold text-primary truncate">{{ Auth::guard('customer')->user()->name }}</p>
                        </div>

                        <a href="{{ route('front.profile') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-on-surface-variant hover:bg-surface-container-low hover:text-primary rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-base">account_circle</span>
                            My Profile
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="block mt-1 pt-1 border-t border-navy/5">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-semibold text-error hover:bg-error-container/20 rounded-lg transition-colors text-left cursor-pointer">
                                <span class="material-symbols-outlined text-base text-error">logout</span>
                                Sign Out
                            </button>
                        </form>
                    @else
                        <div class="px-1 py-1">
                            <a href="{{ route('auth') }}" class="flex items-center justify-center w-full h-10 bg-tangerine hover:bg-[#ff7b4d] text-ice text-xs font-bold rounded-lg shadow-md transition-soft">
                                Sign In
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Tombol Navigasi Keranjang Belanja Utama -->
            <a href="{{ route('cart.index') }}" class="relative inline-flex items-center p-2 text-primary hover:text-secondary-container transition-all cursor-pointer group">
                <span class="material-symbols-outlined text-[26px]">shopping_bag</span>
                <span id="cart-badge" class="absolute -top-0.5 -right-0.5 bg-rose-600 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white scale-0 transition-transform duration-300 shadow-sm">
                    0
                </span>
            </a>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileBtn = document.getElementById('menu-profile-btn');
        const profileDropdown = document.getElementById('menu-profile-dropdown');
        const profileWrapper = document.getElementById('profile-wrapper');
        const searchBtn = document.getElementById('menu-search-btn');
        const searchDropdown = document.getElementById('menu-search-dropdown');
        const searchWrapper = document.getElementById('search-wrapper');
        const searchInput = document.getElementById('search-input');
        const resultsContainer = document.getElementById('search-results-container');

        // Logic Dropdown Profile
        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
                if(searchDropdown) searchDropdown.classList.add('hidden');
            });
        }

        // Logic Dropdown Search Toggle
        if (searchBtn && searchDropdown) {
            searchBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                searchDropdown.classList.toggle('hidden');
                if(profileDropdown) profileDropdown.classList.add('hidden');
                if (!searchDropdown.classList.contains('hidden')) {
                    setTimeout(() => searchInput.focus(), 50);
                }
            });
        }

        // FIXED GLOBAL CLICK: Memanfaatkan wrapper spesifik agar klik tombol cart terisolasi total
        document.addEventListener('click', function (e) {
            if (profileWrapper && !profileWrapper.contains(e.target) && profileDropdown) {
                profileDropdown.classList.add('hidden');
            }
            if (searchWrapper && !searchWrapper.contains(e.target) && searchDropdown) {
                searchDropdown.classList.add('hidden');
            }
        });

        // LIVE REAL-TIME AJAX SEARCH ENGINE
        let delayTimer;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(delayTimer);
                const query = this.value.trim();

                if (query.length < 2) {
                    resultsContainer.innerHTML = '<p class="text-on-surface-variant/60 text-center py-4">Type at least 2 characters...</p>';
                    return;
                }

                resultsContainer.innerHTML = '<p class="text-on-surface-variant/60 text-center py-4 animate-pulse">Searching global inventory...</p>';

                delayTimer = setTimeout(function () {
                    fetch(`{{ route('api.search') }}?q=${encodeURIComponent(query)}`, {
                        method: "GET",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        resultsContainer.innerHTML = '';
                        
                        if (data.products.length === 0 && data.bundles.length === 0) {
                            resultsContainer.innerHTML = '<p class="text-on-surface-variant/60 text-center py-4">No assets matched your criteria.</p>';
                            return;
                        }

                        if (data.products.length > 0) {
                            const pHeader = document.createElement('div');
                            pHeader.className = "text-[10px] font-bold text-secondary uppercase tracking-wider pt-2 pb-1 px-1";
                            pHeader.innerText = "Products";
                            resultsContainer.appendChild(pHeader);

                            data.products.forEach(item => {
                                const row = document.createElement('a');
                                row.href = `{{ url('/shop/product') }}/${item.slug}`;
                                row.className = "flex items-center gap-3 py-2 hover:bg-surface-container-low dark:hover:bg-surface-container-low/20 rounded-lg transition-colors px-2 block w-full text-left";
                                row.innerHTML = `
                                    <div class="w-8 h-8 bg-surface-dim rounded overflow-hidden flex-shrink-0">
                                        <img src="${item.featured_image ? '{{ asset('storage') }}/' + item.featured_image : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDcYg3P9w77e0X6dOC9InqUNDMYqB7sq_1u7ixV5G6aqKVza6MHGXekhp6eAIBRxT17ew4jgbHWnjjXG18VSsI6bnrXRwht6ZQSzxIyvx9u46NTMMqCRee9OO8KqrNEK-BsTHUZGYzIXLrZfvBWOKi1aVJqUBLddDhZKLUBQwY6BB98hwIceDWmPxUYmm3edt_3Fa_IdT9LKtEgeJJXUTY3VHL6YLQpNGVazffIGAYeIpqLhq3R8lmQe4kMak_mtKTXa7P5dVtEp9Y'}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-primary dark:text-white truncate text-xs">${item.name}</p>
                                        <p class="text-[10px] text-on-surface-variant">Stock: ${item.stock} | Rp ${parseInt(item.price).toLocaleString('id-ID')}</p>
                                    </div>
                                `;
                                resultsContainer.appendChild(row);
                            });
                        }

                        if (data.bundles.length > 0) {
                            const bHeader = document.createElement('div');
                            bHeader.className = "text-[10px] font-bold text-[#FF6B35] uppercase tracking-wider pt-3 pb-1 px-1";
                            bHeader.innerText = "Product Bundles";
                            resultsContainer.appendChild(bHeader);

                            data.bundles.forEach(item => {
                                const row = document.createElement('a');
                                row.href = `{{ url('/bundles') }}/${item.slug}`;
                                row.className = "flex items-center gap-3 py-2 hover:bg-surface-container-low dark:hover:bg-surface-container-low/20 rounded-lg transition-colors px-2 block w-full text-left";
                                row.innerHTML = `
                                    <div class="w-8 h-8 bg-surface-dim rounded overflow-hidden flex-shrink-0">
                                        <img src="${item.image ? '{{ asset('storage') }}/' + item.image : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDWw4ew-KHPPGMXcI6Vx2vn1LxTByGDvJ5QojuWO8UrX8HECDPDIHX-zPtmoAE7HWv-7is47t2Wiu5MQz88-MSZWVI8gUGFtqYgaiYrEpS9gktMJ1-7AlCt-Yg2-QhghV8LSerwLbANnIi2gW86qaagyKWS9eRuVvtuoFSPT7OuJj8iP4XaoJ4wBeLF5IRyaQgW2Ee5bqr-OgHiPxVbyxgA5lyr7pgg3XcC4HX2TvuGup4nLtxm0-JYb-_MtBl3jQB_PPTLlCqs2bM'}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-primary dark:text-white truncate text-xs">${item.name}</p>
                                        <p class="text-[10px] text-on-surface-variant">Package Stock: ${item.stock} | Rp ${parseInt(item.price).toLocaleString('id-ID')}</p>
                                    </div>
                                `;
                                resultsContainer.appendChild(row);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        resultsContainer.innerHTML = '<p class="text-error text-center py-4">Search channel failed.</p>';
                    });
                }, 300);
            });
        }
    });

    // Deklarasi Global Badge Keranjang agar terbebas dari siklus DOMContentLoaded
    window.refreshCartBadge = function() {
        const badge = document.getElementById('cart-badge');
        if (!badge) return; 

        fetch("{{ route('api.cart.count') }}", {
            method: "GET",
            headers: { 
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            const count = data.count ?? 0;
            badge.innerText = count;
            
            if (count > 0) {
                badge.classList.remove('scale-0');
                badge.classList.add('scale-100');
            } else {
                badge.classList.remove('scale-100');
                badge.classList.add('scale-0');
            }
        })
        .catch(error => console.error('Error fetching cart count:', error));
    };

    // Sinkronisasi pemanggilan data awal saat halaman selesai dimuat
    window.addEventListener('load', function() {
        if(typeof window.refreshCartBadge === 'function') {
            window.refreshCartBadge();
        }
    });
</script>