<main class="ml-sidebar-width pt-16 min-h-screen px-margin-desktop py-stack-lg">
            <!-- Summary Dashboard -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-stack-lg">
                <!-- Total Products Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-primary-container/10 rounded-lg text-primary">
                            <span class="material-symbols-outlined">inventory_2</span>
                        </div>
                        <span class="text-xs font-label-caps text-on-surface-variant">+12% vs last month</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-on-surface-variant text-body-sm font-medium">Total Fragrances</h3>
                        <p class="text-display-lg font-display-lg text-primary">1,284</p>
                    </div>
                </div>
                <!-- In Stock Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-on-tertiary-container/10 text-on-tertiary-container rounded-lg">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <span class="text-xs font-label-caps text-on-tertiary-container">Optimal</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-on-surface-variant text-body-sm font-medium">Healthy Stock</h3>
                        <p class="text-display-lg font-display-lg text-primary">1,156</p>
                    </div>
                </div>
                <!-- Low Stock Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-1 bg-secondary-container h-full"></div>
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-secondary-container/10 text-secondary-container rounded-lg">
                            <span class="material-symbols-outlined">warning</span>
                        </div>
                        <span class="text-xs font-label-caps text-secondary">Attention Req.</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-on-surface-variant text-body-sm font-medium">Low Stock Items</h3>
                        <p class="text-display-lg font-display-lg text-secondary">92</p>
                    </div>
                </div>
                <!-- Out of Stock Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-1 bg-error h-full"></div>
                    <div class="flex justify-between items-start">
                        <div class="p-2 bg-error-container/20 text-error rounded-lg">
                            <span class="material-symbols-outlined">cancel</span>
                        </div>
                        <span class="text-xs font-label-caps text-error">Critical</span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-on-surface-variant text-body-sm font-medium">Out of Stock</h3>
                        <p class="text-display-lg font-display-lg text-error">36</p>
                    </div>
                </div>
            </div>
            <!-- Inventory Layout: Main Table & Side Panels -->
            <div class="grid grid-cols-12 gap-gutter">
                <!-- Main Table Section (Bento Style Card) -->
                <section class="col-span-12 lg:col-span-8 space-y-stack-md">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/10 overflow-hidden">
                        <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
                            <h2 class="font-headline-md text-headline-md text-primary">Product Inventory</h2>
                            <div class="flex gap-2">
                                <button class="px-4 py-2 border border-outline-variant rounded-lg text-body-sm font-medium hover:bg-surface-container-low transition-colors">
                                Export CSV
                                </button>
                                <button class="px-4 py-2 bg-primary text-on-primary rounded-lg text-body-sm font-medium hover:opacity-90 transition-opacity flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">filter_list</span>
                                Advanced Filter
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container-low text-on-surface-variant font-label-caps text-[10px] tracking-widest uppercase">
                                        <th class="px-6 py-4">Product Details</th>
                                        <th class="px-6 py-4">Category</th>
                                        <th class="px-6 py-4">SKU</th>
                                        <th class="px-4 py-4 text-center">In Stock</th>
                                        <th class="px-4 py-4 text-center">Reserved</th>
                                        <th class="px-4 py-4 text-center">Status</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/10">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-surface-container-lowest/50 group transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded bg-surface-container-low overflow-hidden border border-outline-variant/20">
                                                    <img class="w-full h-full object-cover" data-alt="A minimalist, high-end perfume bottle with a matte black finish and gold metallic cap, centered on a pristine white marble surface. The lighting is sharp, casting elegant shadows that emphasize the bottle's sleek architectural form. The overall aesthetic is one of ultra-luxury and modern sophistication, fitting for a premium fragrance catalog." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZWn5oVzGZWd6P3NYHKtIb7VaxLuZfxBj_NW5Yobqp891DyE91hUzOh0Yw31rlhLTGuZw_PXpFenzKNbV2EO42vlB0KpUsouTH2Ge_lpLpo5B9SDfIJ0ZLpU4P2oTtW1uLIPeRyeNqALr9EwpTfrpiKYo267ROc963i7GbApryN8m0ubrJmMPEChny1ik317DrmicJt959MclTyvHeUWkUDvctP3WAV6g1DPR9JqvsOtbOLRHstsscLvdqfsYuB8mkD6aBkjzdzmU"/>
                                                </div>
                                                <div>
                                                    <p class="font-title-sm text-primary">Midnight Noir EDP</p>
                                                    <p class="text-[11px] text-on-surface-variant">50ml | Spray</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-body-sm text-on-surface-variant">Oriental Woody</td>
                                        <td class="px-6 py-4 font-mono text-[12px] text-on-surface-variant">HN-MD-293</td>
                                        <td class="px-4 py-4 text-center font-bold text-primary">428</td>
                                        <td class="px-4 py-4 text-center text-on-surface-variant">12</td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="px-3 py-1 bg-on-tertiary-container/10 text-on-tertiary-container text-[11px] font-bold rounded-full">In Stock</span>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">visibility</span></button>
                                            <button class="p-2 text-on-surface-variant hover:text-secondary transition-colors"><span class="material-symbols-outlined text-lg">edit_square</span></button>
                                        </td>
                                    </tr>
                                    <!-- Row 2 (Low Stock) -->
                                    <tr class="hover:bg-surface-container-lowest/50 group transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded bg-surface-container-low overflow-hidden border border-outline-variant/20">
                                                    <img class="w-full h-full object-cover" data-alt="A translucent frosted glass perfume bottle filled with a golden liquid, featuring a minimal white label. It sits on a smooth, curved concrete pedestal under a warm, golden-hour light. The atmosphere is serene and expensive, emphasizing the delicate craftsmanship of the glass and the premium nature of the fragrance contents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBh4tJ8kjiJ4Eh3dC9flFcDXaj1TZvMF6LPf_ibn3ChUWeZI9SBsUNt5xuChKaJNUwHnrodwZrj52-hK_NtUnase0l8uR18ScWDzZvapii-nx8ZJpdryX5_Mzm_C1ZDbbT7TGghVyeEm_D0kQVE1s1ZBDQFErLA4Srgl2rvxIcvar1r13PTGMMGA7M584k0DG1VPTqG_EXOGsGqbLhBycBkdbLyQ48MRYhd6Lwcp--IgabEgKRUbntCR7LdzOeQcmuQZbK1_GGCxNU"/>
                                                </div>
                                                <div>
                                                    <p class="font-title-sm text-primary">Citrus Bloom Essence</p>
                                                    <p class="text-[11px] text-on-surface-variant">100ml | Oil</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-body-sm text-on-surface-variant">Fresh Floral</td>
                                        <td class="px-6 py-4 font-mono text-[12px] text-on-surface-variant">HN-CB-411</td>
                                        <td class="px-4 py-4 text-center font-bold text-secondary">15</td>
                                        <td class="px-4 py-4 text-center text-on-surface-variant">4</td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="px-3 py-1 bg-secondary-container/10 text-secondary text-[11px] font-bold rounded-full">Low Stock</span>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">visibility</span></button>
                                            <button class="p-2 text-on-surface-variant hover:text-secondary transition-colors"><span class="material-symbols-outlined text-lg">edit_square</span></button>
                                        </td>
                                    </tr>
                                    <!-- Row 3 (Out of Stock) -->
                                    <tr class="hover:bg-surface-container-lowest/50 group transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded bg-surface-container-low overflow-hidden border border-outline-variant/20">
                                                    <img class="w-full h-full object-cover" data-alt="A group of sleek, minimalist clear glass fragrance vials with silver atomizers arranged in a staggered geometric composition. The background is a clean, neutral grey with soft studio lighting that creates high-fidelity reflections on the glass. The image represents the technical precision of a high-end fragrance lab and inventory management." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3B9_kjmwXnz3jNpLnPFuniVFeaky_VC8CDwR00LKIW-zthcSIahgLg3e5qudWyL3mPV6Oa85jRqVRfjvqpXCEk9Oaf6IGgT2nAhsjxfArzpi-BzlABwNb_gXsuvU4ntY0LugK5dhX8hm-hOnLeAAToCVdmjbOs_tvilUaC1jIIR0_PIKeX3qT8KkRBomyuaEh-RizDrQUXK2MxHpa5knkZrOD7r9mZbxFf1sYQ9_S4aWsKAaMx7fTmSB9BVolKCMDiIgOVDkyXsY"/>
                                                </div>
                                                <div>
                                                    <p class="font-title-sm text-primary">Velvet Sandalwood</p>
                                                    <p class="text-[11px] text-on-surface-variant">75ml | Spray</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-body-sm text-on-surface-variant">Spicy Woody</td>
                                        <td class="px-6 py-4 font-mono text-[12px] text-on-surface-variant">HN-VS-882</td>
                                        <td class="px-4 py-4 text-center font-bold text-error">0</td>
                                        <td class="px-4 py-4 text-center text-on-surface-variant">0</td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="px-3 py-1 bg-error-container/20 text-error text-[11px] font-bold rounded-full">Out of Stock</span>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button class="p-2 text-on-surface-variant hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">visibility</span></button>
                                            <button class="p-2 text-on-surface-variant hover:text-secondary transition-colors"><span class="material-symbols-outlined text-lg">edit_square</span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-6 border-t border-outline-variant/10 flex justify-between items-center text-body-sm text-on-surface-variant">
                            <span>Showing 1-10 of 1,284 products</span>
                            <div class="flex gap-2">
                                <button class="p-2 rounded hover:bg-surface-container-low border border-outline-variant/20 disabled:opacity-30" disabled="">
                                <span class="material-symbols-outlined">chevron_left</span>
                                </button>
                                <button class="px-3 py-1 rounded bg-primary text-on-primary font-medium">1</button>
                                <button class="px-3 py-1 rounded hover:bg-surface-container-low transition-colors">2</button>
                                <button class="px-3 py-1 rounded hover:bg-surface-container-low transition-colors">3</button>
                                <button class="p-2 rounded hover:bg-surface-container-low border border-outline-variant/20">
                                <span class="material-symbols-outlined">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Side Information Panels -->
                <aside class="col-span-12 lg:col-span-4 space-y-gutter">
                    <!-- Low Stock Alert Panel -->
                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <div class="flex items-center gap-2 mb-stack-lg">
                            <span class="material-symbols-outlined text-secondary">notification_important</span>
                            <h2 class="font-headline-md text-headline-md text-primary">Stock Alerts</h2>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3 p-3 bg-secondary-container/5 rounded-lg border-l-4 border-secondary-container">
                                <div class="flex-1">
                                    <p class="text-body-sm font-bold text-primary">Citrus Bloom Essence (100ml)</p>
                                    <p class="text-[11px] text-on-surface-variant mt-1">15 units remaining • Threshold: 20</p>
                                </div>
                                <button class="text-secondary font-bold text-[11px] uppercase tracking-wider hover:underline">Reorder</button>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-error-container/5 rounded-lg border-l-4 border-error">
                                <div class="flex-1">
                                    <p class="text-body-sm font-bold text-primary">Velvet Sandalwood (75ml)</p>
                                    <p class="text-[11px] text-on-surface-variant mt-1">Out of Stock • 12 Backorders Pending</p>
                                </div>
                                <button class="text-error font-bold text-[11px] uppercase tracking-wider hover:underline">Restock</button>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-secondary-container/5 rounded-lg border-l-4 border-secondary-container">
                                <div class="flex-1">
                                    <p class="text-body-sm font-bold text-primary">Amber Gold Mist (50ml)</p>
                                    <p class="text-[11px] text-on-surface-variant mt-1">8 units remaining • Threshold: 15</p>
                                </div>
                                <button class="text-secondary font-bold text-[11px] uppercase tracking-wider hover:underline">Reorder</button>
                            </div>
                        </div>
                        <button class="w-full mt-6 py-2 text-center text-body-sm text-on-primary-container font-medium hover:text-primary transition-colors border border-outline-variant/20 rounded-lg">
                        View All Alerts
                        </button>
                    </div>
                    <!-- Stock Activity Timeline -->
                    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                        <div class="flex items-center gap-2 mb-stack-lg">
                            <span class="material-symbols-outlined text-primary">history</span>
                            <h2 class="font-headline-md text-headline-md text-primary">Stock Activity</h2>
                        </div>
                        <div class="relative space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-px before:bg-outline-variant/30">
                            <div class="relative pl-8">
                                <div class="absolute left-0 top-1.5 w-4 h-4 rounded-full bg-on-tertiary-container flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[10px] text-on-primary">add</span>
                                </div>
                                <div>
                                    <p class="text-body-sm font-bold text-primary">Shipment Received</p>
                                    <p class="text-[11px] text-on-surface-variant">Midnight Noir EDP • +200 Units</p>
                                    <p class="text-[10px] text-on-surface-variant/60 mt-0.5">2 hours ago by Sarah J.</p>
                                </div>
                            </div>
                            <div class="relative pl-8">
                                <div class="absolute left-0 top-1.5 w-4 h-4 rounded-full bg-secondary-container flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[10px] text-on-primary">sync</span>
                                </div>
                                <div>
                                    <p class="text-body-sm font-bold text-primary">Stock Adjustment</p>
                                    <p class="text-[11px] text-on-surface-variant">Citrus Bloom • -5 Units (Damaged)</p>
                                    <p class="text-[10px] text-on-surface-variant/60 mt-0.5">5 hours ago by Mark R.</p>
                                </div>
                            </div>
                            <div class="relative pl-8">
                                <div class="absolute left-0 top-1.5 w-4 h-4 rounded-full bg-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[10px] text-on-primary">local_shipping</span>
                                </div>
                                <div>
                                    <p class="text-body-sm font-bold text-primary">Bulk Order Fulfilled</p>
                                    <p class="text-[11px] text-on-surface-variant">Various Products • 48 Units</p>
                                    <p class="text-[10px] text-on-surface-variant/60 mt-0.5">Yesterday, 4:15 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Warehouse Condition Monitor (Atmospheric Micro-interaction) -->
                    <div class="bg-primary p-6 rounded-xl shadow-xl text-on-primary relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-[80px]">thermostat</span>
                        </div>
                        <h3 class="font-title-sm mb-4">Storage Environment</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/10 p-3 rounded-lg backdrop-blur-md border border-white/10">
                                <p class="text-[10px] uppercase tracking-widest text-on-primary/60">Temperature</p>
                                <p class="text-xl font-display-lg mt-1">18.4°C</p>
                                <div class="mt-2 h-1 bg-white/20 rounded-full overflow-hidden">
                                    <div class="h-full bg-on-tertiary-container w-[45%]"></div>
                                </div>
                            </div>
                            <div class="bg-white/10 p-3 rounded-lg backdrop-blur-md border border-white/10">
                                <p class="text-[10px] uppercase tracking-widest text-on-primary/60">Humidity</p>
                                <p class="text-xl font-display-lg mt-1">42%</p>
                                <div class="mt-2 h-1 bg-white/20 rounded-full overflow-hidden">
                                    <div class="h-full bg-on-tertiary-container w-[60%]"></div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 text-[11px] text-on-primary/70 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-on-tertiary-container animate-pulse"></span>
                            Real-time climate monitoring active
                        </p>
                    </div>
                </aside>
            </div>
        </main>
        <!-- Interactive Layer / Tooltips Script (Simulation) -->
        <script>
            // Simple micro-interactions for table rows
            document.querySelectorAll('tbody tr').forEach(row => {
                row.addEventListener('mouseenter', () => {
                    row.style.cursor = 'pointer';
                });
            });
            
            // Toggle dark mode (visual only, logic as per theme config)
            const darkModeBtn = document.querySelector('button .material-symbols-outlined:contains("dark_mode")');
            if(darkModeBtn) {
                darkModeBtn.parentElement.addEventListener('click', () => {
                    document.documentElement.classList.toggle('dark');
                });
            }
        </script>