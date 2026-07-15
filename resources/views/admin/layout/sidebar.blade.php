<aside class="fixed left-0 top-0 h-screen w-[280px] bg-[#0d1d2c] flex flex-col py-6 shadow-2xl z-50 overflow-y-auto custom-scrollbar border-r border-white/5">
    
    <div class="px-6 mb-8 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#FF6B35] rounded-lg flex items-center justify-center shadow-md shadow-[#FF6B35]/20">
                <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">water_drop</span>
            </div>
            <div>
                <h1 class="text-lg font-bold text-white leading-tight">Hanah Admin</h1>
                <p class="text-[10px] font-bold text-gray-400 tracking-wider uppercase">LUXURY FRAGRANCE SUITE</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 space-y-1 overflow-y-auto">
        
        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'dashboard' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Session::get('page') == 'dashboard' ? 1 : 0 }};">dashboard</span>
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'analytics' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="#">
            <span class="material-symbols-outlined">insights</span>
            <span class="text-sm font-medium">Analytics</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'categories' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('categories.index') }}">
            <span class="material-symbols-outlined">category</span>
            <span class="text-sm font-medium">Product Categories</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'products' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
        href="{{ route('products.index') }}">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Session::get('page') == 'products' ? 1 : 0 }};">resume</span>
            <span class="text-sm font-medium">Products</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'bundles' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('bundles.index') }}">
            <span class="material-symbols-outlined">auto_awesome_motion</span>
            <span class="text-sm font-medium">Bundle Collections</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 
            {{ Session::get('page') == 'inventory' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
        href="{{ route('inventory.index') }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="text-sm font-medium">Inventory</span>
        </a>


        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'orders' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('orders.index') }}">
            <span class="material-symbols-outlined">shopping_cart</span>
            <span class="text-sm font-medium">Orders</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'cart' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('carts.index') }}">
            <span class="material-symbols-outlined">shopping_bag</span>
            <span class="text-sm font-medium">Carts</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'payments' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('payments.index') }}">
            <span class="material-symbols-outlined">payments</span>
            <span class="text-sm font-medium">Payments</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'shipments' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('shippings.index') }}">
            <span class="material-symbols-outlined">local_shipping</span>
            <span class="text-sm font-medium">Shippings</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'blog' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('blogs.index') }}">
            <span class="material-symbols-outlined">article</span>
            <span class="text-sm font-medium">Blog Posts</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'contact' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('contacts.index') }}">
            <span class="material-symbols-outlined">Message</span>
            <span class="text-sm font-medium">Contact Messages</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'subadmins' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('admin.subadmins') }}">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Session::get('page') == 'subadmins' ? 1 : 0 }};">shield_person</span>
            <span class="text-sm font-medium">Subadmins</span>
        </a>

        <a class="flex items-center gap-3 px-5 py-3 rounded-xl transition-all duration-200 {{ Session::get('page') == 'settings' ? 'text-[#FF6B35] font-bold bg-white/5 border-r-4 border-[#FF6B35]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}" 
           href="{{ route('admin.settings') }}">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ Session::get('page') == 'settings' ? 1 : 0 }};">settings</span>
            <span class="text-sm font-medium">Settings</span>
        </a>
        
    </nav>
</aside>