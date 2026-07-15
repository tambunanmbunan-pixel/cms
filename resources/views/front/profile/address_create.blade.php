@extends('front.layout.layout')

@section('content')
<main class="pt-32 pb-section-gap px-margin-mobile md:px-margin-desktop max-w-2xl mx-auto">
    
    <div class="flex items-center justify-between border-b border-outline-variant/20 pb-6 mb-10">
        <div>
            <h1 class="font-headline-lg text-2xl md:text-3xl text-primary tracking-tight font-bold">Add New Address</h1>
            <p class="font-body-md text-sm text-on-surface-variant mt-1">Save a new shipping location for checkout convenience.</p>
        </div>
        <!-- FIX: Tombol Cancel dinamis -->
        @if(request('redirect') === 'checkout')
            <a href="{{ route('front.transaction.create', ['order_id' => rand(1000, 9999), 'pid' => request('pid'), 'qty' => request('qty')]) }}" class="font-button text-sm font-semibold text-secondary hover:underline flex items-center gap-1">
                Cancel
            </a>
        @else
            <a href="{{ route('front.profile') }}" class="font-button text-sm font-semibold text-secondary hover:underline flex items-center gap-1">
                Cancel
            </a>
        @endif
    </div>

    <div class="bg-surface-container-lowest p-6 md:p-10 rounded-2xl border border-outline-variant/20 shadow-sm">
        <form action="{{ route('front.address.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- JALUR PENGAMAN PARAMETER REDIRECT -->
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
            <input type="hidden" name="pid" value="{{ request('pid') }}">
            <input type="hidden" name="qty" value="{{ request('qty') }}">

            <div class="flex flex-col gap-1">
                <label for="address_label" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">Address Label *</label>
                <input type="text" id="address_label" name="address_label" value="{{ old('address_label', 'Rumah') }}" required placeholder="e.g., Rumah, Kantor, Kos" 
                       class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                @error('address_label') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex flex-col gap-1">
                    <label for="recipient_name" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">Recipient Name</label>
                    <input type="text" id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}" placeholder="Leave blank to use account name" 
                           class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                    @error('recipient_name') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="recipient_phone" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">Recipient Phone</label>
                    <input type="text" id="recipient_phone" name="recipient_phone" value="{{ old('recipient_phone') }}" placeholder="e.g., 08123456789" 
                           class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                    @error('recipient_phone') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <label for="full_address" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">Street Address *</label>
                <textarea id="full_address" name="full_address" rows="2" required placeholder="Jalan, Blok, Nomor Rumah, dan detail patokan..." 
                          class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors resize-none shadow-none">{{ old('full_address') }}</textarea>
                @error('full_address') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex flex-col gap-1">
                    <label for="province" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">Province *</label>
                    <input type="text" id="province" name="province" value="{{ old('province') }}" required placeholder="e.g., D.I. Yogyakarta" 
                           class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                    @error('province') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="city" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">City / Regency *</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required placeholder="e.g., Bantul" 
                           class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                    @error('city') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex flex-col gap-1">
                    <label for="district" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">District (Kecamatan)</label>
                    <input type="text" id="district" name="district" value="{{ old('district') }}" placeholder="e.g., Kasihan" 
                           class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                    @error('district') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="postal_code" class="font-label-md text-xs font-bold uppercase tracking-wider text-on-surface-variant">Postal Code *</label>
                    <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required placeholder="e.g., 55183" 
                           class="w-full bg-transparent border-0 border-b-2 border-outline-variant/40 py-2 px-0 font-body-md text-primary focus:border-secondary focus:ring-0 focus:outline-none transition-colors shadow-none"/>
                    @error('postal_code') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center pt-2">
                <input id="is_default" name="is_default" type="checkbox" value="1" 
                       class="h-4 w-4 rounded border-outline-variant text-secondary focus:ring-secondary/20 bg-transparent cursor-pointer shadow-none focus:ring-offset-0"/>
                <label for="is_default" class="ml-3 text-sm text-primary select-none cursor-pointer font-medium">Set as default shipping address</label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-primary hover:bg-[#122335] text-white font-button rounded-xl text-button font-bold shadow-md hover:shadow-lg transition-all cursor-pointer tracking-wide">
                    Save Address
                </button>
            </div>
        </form>
    </div>
</main>
@endsection