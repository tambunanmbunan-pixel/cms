@extends('front.layout.layout')

@section('content')

<main class="pt-32 pb-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <!-- Header Greeting -->
    <section class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Bonjour, {{ $customer->name }}</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Welcome back to your private curation.</p>
        </div>
        <div class="flex items-center gap-4 bg-surface-container-low px-6 py-4 rounded-xl border border-outline-variant/10 shadow-sm">
            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-surface">
                <span class="material-symbols-outlined" data-icon="stars" style="font-variation-settings: 'FILL' 1;">stars</span>
            </div>
            <div>
                <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest">Membership Status</p>
                <p class="font-body-md text-body-md text-primary font-bold">Platinum Member</p>
            </div>
        </div>
    </section>

    <!-- TAMPILAN NOTIFIKASI PROGRAM FLASHDATA -->
    @if (session('success'))
        <div class="mb-6 p-4 text-sm text-white bg-[#028090] rounded-xl shadow-md max-w-none">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Left Column: Information & Security -->
        <div class="lg:col-span-4 flex flex-col gap-gutter">
            
            <!-- My Information (Bento Card Personal) -->
            <div class="bento-card bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-headline-md text-headline-md text-primary">Personal</h2>
                    <button type="button" id="edit-toggle-btn" onclick="enableEditMode()" class="text-secondary hover:underline font-button text-label-md cursor-pointer">Edit</button>
                </div>
                
                <form action="{{ route('front.profile.update') }}" method="POST" class="flex flex-col gap-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1">
                        <label class="font-label-md text-label-md text-on-surface-variant">Full Name</label>
                        <input name="name" id="input_name" class="w-full bg-transparent border-b border-outline-variant/30 py-2 font-body-md text-primary focus:border-secondary transition-colors" readonly type="text" value="{{ old('name', $customer->name) }}" required/>
                        @error('name') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="space-y-1">
                        <label class="font-label-md text-label-md text-on-surface-variant">Email Address</label>
                        <!-- Email di-lock disabled demi integritas data akun Oracle -->
                        <input class="w-full bg-transparent border-b border-outline-variant/10 py-2 font-body-md text-primary/50 cursor-not-allowed focus:border-none" disabled type="email" value="{{ $customer->email }}"/>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="font-label-md text-label-md text-on-surface-variant">Phone Number</label>
                        <input name="phone_number" id="input_phone" class="w-full bg-transparent border-b border-outline-variant/30 py-2 font-body-md text-primary focus:border-secondary transition-colors" readonly type="text" value="{{ old('phone_number', $customer->phone_number) }}" placeholder="Not set"/>
                        @error('phone_number') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="space-y-1">
                        <label class="font-label-md text-label-md text-on-surface-variant">Gender</label>
                        <select name="gender" id="input_gender" disabled class="w-full bg-transparent border-none border-b border-outline-variant/30 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 transition-colors cursor-not-allowed">
                            <option value="" {{ old('gender', $customer->gender) == null ? 'selected' : '' }}>Select Gender</option>
                            <option value="Male" {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tombol Action Simpan (Tersembunyi secara bawaan, muncul via JS) -->
                    <div id="action-save-wrapper" class="hidden pt-2 transition-all duration-300">
                        <button type="submit" class="w-full py-3 bg-secondary hover:bg-[#c93e00] text-white font-button rounded-lg text-button shadow-md cursor-pointer transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Security -->
            <div class="bento-card bg-primary-container p-8 rounded-xl text-surface">
                <h2 class="font-headline-md text-headline-md mb-6">Security</h2>
                <p class="font-body-md text-on-primary-container mb-8">Manage your credentials and account access settings.</p>
                <div class="space-y-4">
                    <button class="w-full py-4 border border-surface/20 rounded-lg font-button text-button hover:bg-surface hover:text-primary transition-all flex items-center justify-center gap-3 cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]" data-icon="lock">lock</span>
                        Change Password
                    </button>
                    <button class="w-full py-4 border border-surface/20 rounded-lg font-button text-button hover:bg-surface hover:text-primary transition-all flex items-center justify-center gap-3 cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]" data-icon="phonelink_setup">phonelink_setup</span>
                        Two-Factor Auth
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Middle Column: Order History & Addresses -->
        <div class="lg:col-span-8 flex flex-col gap-gutter">
            <!-- Order History -->
            <div class="bento-card bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 overflow-hidden">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-headline-md text-headline-md text-primary">Order History</h2>
                    <a class="font-button text-label-md text-secondary-container hover:text-secondary" href="#">View All Archive</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-outline-variant/10">
                                <th class="pb-4 font-label-md text-label-md text-on-surface-variant">Order #</th>
                                <th class="pb-4 font-label-md text-label-md text-on-surface-variant">Date</th>
                                <th class="pb-4 font-label-md text-label-md text-on-surface-variant">Total</th>
                                <th class="pb-4 font-label-md text-label-md text-on-surface-variant">Status</th>
                                <th class="pb-4 font-label-md text-label-md text-on-surface-variant text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @forelse($orders ?? [] as $order)
                                <tr class="group">
                                    <td class="py-6 font-body-md text-primary">{{ $order->order_number }}</td>
                                    <td class="py-6 font-body-md text-on-surface-variant">
                                        {{ $order->created_at ? $order->created_at->format('M d, Y') : '-' }}
                                    </td>
                                    <td class="py-6 font-body-md text-primary font-bold">
                                        {{ 'Rp ' . number_format($order->grand_total ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="py-6">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-amber-100 text-amber-700',
                                                'paid' => 'bg-mint-teal/10 text-mint-teal',
                                                'delivered' => 'bg-surface-container-high text-on-surface-variant'
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 {{ $statusColors[$order->status ?? 'pending'] ?? 'bg-surface-container-high' }} rounded-full text-xs font-bold uppercase tracking-wider">
                                            {{ $order->status ?? 'pending' }}
                                        </span>
                                    </td>
                                    <td class="py-6 text-right">
                                        <button class="text-secondary-container hover:text-secondary font-button text-button group-hover:translate-x-1 transition-transform cursor-pointer bg-transparent border-0 p-0 shadow-none">
                                            View Order
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-on-surface-variant">
                                        You don't have any order history yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Scent Profile (Luxury Feature) -->
            <div class="bento-card bg-surface-container-low p-8 rounded-xl border border-outline-variant/10">
                <h2 class="font-headline-md text-headline-md text-primary mb-8">Personal Scent Profile</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest mb-4">Olfactory DNA</p>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-body-md text-primary">Woody &amp; Amber</span>
                                    <span class="font-body-md text-on-surface-variant">85%</span>
                                </div>
                                <div class="h-1 bg-surface-variant rounded-full overflow-hidden">
                                    <div class="h-full bg-primary" style="width: 85%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-body-md text-primary">Citrus &amp; Fresh</span>
                                    <span class="font-body-md text-on-surface-variant">40%</span>
                                </div>
                                <div class="h-1 bg-surface-variant rounded-full overflow-hidden">
                                    <div class="h-full bg-primary" style="width: 40%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-body-md text-primary">Spicy Oriental</span>
                                    <span class="font-body-md text-on-surface-variant">60%</span>
                                </div>
                                <div class="h-1 bg-surface-variant rounded-full overflow-hidden">
                                    <div class="h-full bg-primary" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest mb-4">Signature Scents</p>
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-4 bg-surface p-3 rounded-lg border border-outline-variant/10">
                                <div class="w-12 h-12 bg-surface-dim rounded flex items-center justify-center overflow-hidden">
                                    <img class="object-cover w-full h-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuFlld3UJ6r0J7ESzdfpiwq7M3oDjgfgZID3h7fXDg9SvqM5D6zcu-UhhyCKrDlj0IQBSYgPTVnUv7I9__wywo2evbQLywXJhnxMuJ820KOc5E0zPdnbnuI0hSr-aX-35V4HpKip1XA7PnvE158BiZl32RV2SEKkU9o50gip_Hx5MO6t9X4KgQJQ-Hh8HannstFkClR_W6WP0Myg1pUPg8AVo24EgPA5u3bYNo8nUTSDYXhBxa_mrGyMMUpcE9MAScVUTz_T8olO1c"/>
                                </div>
                                <div>
                                    <p class="font-body-md text-primary font-bold">Midnight Oak</p>
                                    <p class="font-label-md text-on-surface-variant text-[12px]">Extrait de Parfum</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 bg-surface p-3 rounded-lg border border-outline-variant/10">
                                <div class="w-12 h-12 bg-surface-dim rounded flex items-center justify-center overflow-hidden">
                                    <img class="object-cover w-full h-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC90NfT2HJ_HGqBWQ27hndwWnf5C7_yYEc52cbNA7fh_TKC8Xz7adz-mXlpsyTULdUtAq0PEybxke5OYRWUcFLRuNjX0KMhIIIu8SsBjYmiPEX8-mvYUppeRkMhDJkzM8iq7U_iFia5DtUtCraQyv3c1RvFMZREyTxcuAX4K8Wsy4tJo8gGSRF3xrO_zz5Y7T1dIKD4AM-ZK4tEnYl4x1LGnxUbO3jhQ1JwGe6FbUXAWRP-B7LbS0havNWx_F69GHc206GiNVJaJrs"/>
                                </div>
                                <div>
                                    <p class="font-body-md text-primary font-bold">Azure Vetiver</p>
                                    <p class="font-label-md text-on-surface-variant text-[12px]">Eau de Parfum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Shipping Addresses -->
            <div class="bento-card bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 mb-gutter">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-headline-md text-headline-md text-primary">Shipping Addresses</h2>
                    <a href="{{ route('front.address.create') }}" class="inline-flex items-center justify-center bg-secondary text-on-secondary px-6 py-2 rounded-full font-button text-label-md hover:shadow-lg transition-all cursor-pointer">
                        Add New
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    @forelse($addresses as $address)
                        <div class="p-6 border {{ $address->is_default ? 'border-secondary bg-secondary-fixed/5' : 'border-outline-variant/30' }} rounded-xl flex flex-col justify-between h-full transition-all duration-300">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    @if($address->is_default)
                                        <span class="font-label-md text-secondary uppercase tracking-widest text-[10px] font-bold">Default</span>
                                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                    @else
                                        <span class="font-label-md text-on-surface-variant uppercase tracking-widest text-[10px]">Alternative</span>
                                    @endif
                                </div>
                                
                                <p class="font-body-md text-primary font-bold mb-1">{{ $address->address_label }}</p>
                                <p class="text-xs text-on-surface-variant mb-3 font-semibold">Recipient: {{ $address->recipient_name }} ({{ $address->recipient_phone ?? '-' }})</p>
                                
                                <p class="font-body-md text-on-surface-variant text-sm leading-relaxed whitespace-pre-line">
                                    {{ $address->full_address }}
                                    {{ $address->district ? $address->district . ', ' : '' }}{{ $address->city }}
                                    {{ $address->province }} - {{ $address->postal_code }}
                                </p>
                            </div>
                            
                            <!-- INTEGRASI TOMBOL AKSI BARU: VIEW DETAIL & DELETE -->
                            <div class="mt-6 flex justify-between items-center border-t border-outline-variant/10 pt-4">
                                
                                <!-- Tombol Show / View Detail -->
                                <a href="{{ route('front.address.show', $address->id) }}" class="font-button text-sm font-medium text-secondary hover:underline flex items-center gap-1 cursor-pointer">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    View Detail
                                </a>
                                
                                <!-- Tombol Delete Langsung dengan Proteksi Form Token -->
                                <form action="{{ route('front.address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus alamat ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-button text-sm font-medium text-on-surface-variant hover:text-error transition-colors bg-transparent border-0 p-0 flex items-center gap-1 cursor-pointer shadow-none">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-2 text-center py-12 text-on-surface-variant/60 bg-surface-container-low rounded-xl border border-dashed border-outline-variant/40 flex flex-col items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-4xl mb-2 block text-navy/30">home_pin</span>
                            <p class="font-body-md font-medium text-primary">No shipping addresses found.</p>
                            <p class="text-xs text-on-surface-variant">Click "Add New" to save an address.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bento-card bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-primary">Payment Methods</h2>
                        <p class="font-body-md text-sm text-on-surface-variant mt-1">Your available secure checkout channels for checkout.</p>
                    </div>
                    <span class="px-3 py-1 bg-surface-container text-primary text-[10px] font-bold uppercase tracking-wider rounded">Sandbox Mode</span>
                </div>

                <div class="bento-card bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 mb-gutter">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="font-headline-md text-headline-md text-primary">System Integration Status</h2>
                            <p class="text-xs text-on-surface-variant mt-0.5">Real-time payment gateway network operational parameters.</p>
                        </div>
                        
                        <!-- TOMBOL STRATEGIS UNTUK NAVIGASI KE INDEX / CREATE PEMBAYARAN -->
                        <div class="flex gap-3">
                            <a href="{{ route('front.payment.index') }}" class="inline-flex items-center justify-center bg-surface hover:bg-surface-container border border-outline-variant/30 text-primary px-5 py-2 rounded-full font-button text-xs font-semibold transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-[16px] mr-1.5">receipt_long</span>
                                Riwayat Tagihan
                            </a>
                            
                            <a href="{{ route('front.payment.create', 102) }}" class="inline-flex items-center justify-center bg-secondary text-on-secondary px-5 py-2 rounded-full font-button text-xs font-bold hover:shadow-lg transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-[16px] mr-1.5">credit_card</span>
                                Bayar Pesanan Terakhir
                            </a>
                        </div>
                    </div>

                    <!-- BLOK KODE INTEGRASI UTAMA -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter items-start">
                        <div class="space-y-4">
                            <!-- Gateway 1: Midtrans -->
                            <div class="flex items-center justify-between p-4 bg-surface rounded-xl border border-outline-variant/10">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-primary/5 rounded-lg flex items-center justify-center text-primary font-bold text-xs tracking-tight">
                                        MD
                                    </div>
                                    <div>
                                        <p class="font-body-md text-primary font-bold text-sm">Digital Gateways</p>
                                        <p class="text-[11px] text-on-surface-variant">QRIS, Virtual Account, Credit Card (Midtrans)</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 bg-mint-teal/10 text-mint-teal font-medium text-[10px] rounded border border-mint-teal/20">Active</span>
                            </div>

                            <!-- Gateway 2: Manual Bank Transfer -->
                            <div class="flex items-center justify-between p-4 bg-surface rounded-xl border border-outline-variant/10">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-primary/5 rounded-lg flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-[20px]">account_balance</span>
                                    </div>
                                    <div>
                                        <p class="font-body-md text-primary font-bold text-sm">Direct Bank Transfer</p>
                                        <p class="text-[11px] text-on-surface-variant">Manual Verification via Admin</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 bg-on-surface-variant/10 text-on-surface-variant font-medium text-[10px] rounded border border-outline-variant/20">Backup</span>
                            </div>
                        </div>

                        <!-- Info Box Sandbox Simulated Environment -->
                        <div class="p-5 bg-secondary-fixed/10 border border-secondary/20 rounded-xl flex gap-3 items-start h-full">
                            <span class="material-symbols-outlined text-secondary text-[22px]">error</span>
                            <div>
                                <p class="font-body-md text-primary font-bold text-sm mb-1">Simulated Environment</p>
                                <p class="text-xs text-on-secondary-container leading-relaxed">
                                    Integration is currently hooked into the payment gateway development sandbox. You can perform full checkout testing workflows safely using mock credentials or simulation portals without any monetary charge.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    /**
     * Mengaktifkan mode edit komponen personal data secara real-time
     */
    function enableEditMode() {
        const nameInput = document.getElementById('input_name');
        const phoneInput = document.getElementById('input_phone');
        const genderSelect = document.getElementById('input_gender');
        const saveWrapper = document.getElementById('action-save-wrapper');
        const editBtn = document.getElementById('edit-toggle-btn');

        // Buka proteksi readonly dan disabled
        nameInput.removeAttribute('readonly');
        phoneInput.removeAttribute('readonly');
        genderSelect.removeAttribute('disabled');

        // Berikan fokus ke input nama
        nameInput.focus();

        // Ubah styling border bawah agar user tahu komponen bisa diedit
        nameInput.classList.add('border-secondary');
        phoneInput.classList.add('border-secondary');
        genderSelect.classList.remove('cursor-not-allowed');

        // Tampilkan tombol simpan perubahan secara visual
        saveWrapper.classList.remove('hidden');
        
        // Sembunyikan atau ubah teks tombol edit
        editBtn.innerText = "Editing...";
        editBtn.style.pointerEvents = "none";
        editBtn.style.opacity = "0.5";
    }

    // Memaksa tombol save muncul kembali jika form direfresh dan membawa validasi error bawaan dari session laravel
    @if ($errors->any())
        enableEditMode();
    @endif

    // Sticky Navbar background change on scroll
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('nav');
        if (window.scrollY > 20) {
            nav.classList.add('shadow-md');
        } else {
            nav.classList.remove('shadow-md');
        }
    });
</script>
@endsection