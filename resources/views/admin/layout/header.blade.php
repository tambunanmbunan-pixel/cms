<header class="sticky top-0 h-[72px] w-full z-40 glass-nav flex justify-between items-center px-gutter ml-[280px] max-w-[calc(100%-280px)]">
            <div class="flex items-center flex-1 max-w-xl">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input class="w-full bg-surface-container-low border-none rounded-full pl-12 pr-4 py-2 text-body-md focus:ring-2 focus:ring-primary/10" placeholder="Search orders, products, analytics..." type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="font-label-caps text-label-caps">Status:</span>
                    <span class="flex items-center gap-1.5 text-on-tertiary-container font-medium">
                    <span class="w-2 h-2 rounded-full bg-on-tertiary-container animate-pulse"></span>
                    Live
                    </span>
                </div>
                <button class="relative text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-secondary rounded-full"></span>
                </button>
                
                <div class="relative inline-block text-left">
                    <button id="profileBtn" class="text-on-surface-variant hover:text-primary transition-colors flex items-center">
                        <span class="material-symbols-outlined">account_circle</span>
                    </button>

                    <div id="dropdownMenu" class="absolute right-0 mt-2 w-40 bg-white border border-outline-variant rounded-xl shadow-lg z-50 hidden overflow-hidden">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-container hover:text-primary">Profile</a>
                            
                            <hr class="border-outline-variant/20">
                            
                            <form method="POST" action="{{ url('admin/logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-container hover:text-primary">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>