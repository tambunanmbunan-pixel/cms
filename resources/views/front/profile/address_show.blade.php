@extends('front.layout.layout')

@section('content')
<main class="pt-32 pb-section-gap px-margin-mobile md:px-margin-desktop max-w-2xl mx-auto">
    
    <div class="flex items-center justify-between border-b border-outline-variant/20 pb-6 mb-10">
        <div class="flex items-center gap-4">
            <a href="{{ route('front.profile') }}" class="material-symbols-outlined text-primary hover:text-secondary text-2xl transition-colors">
                arrow_back
            </a>
            <div>
                <h1 class="font-headline-lg text-2xl md:text-3xl text-primary tracking-tight font-bold">Address Details</h1>
                <p class="font-body-md text-sm text-on-surface-variant mt-1">Reviewing coordinates for your premium deliveries.</p>
            </div>
        </div>
        
        @if($address->is_default)
            <span class="px-3 py-1 bg-secondary-fixed text-secondary font-bold text-xs uppercase tracking-widest rounded-full border border-secondary/20">Default</span>
        @else
            <span class="px-3 py-1 bg-surface-container text-on-surface-variant font-bold text-xs uppercase tracking-widest rounded-full border border-outline-variant/20">Alternative</span>
        @endif
    </div>

    <div class="bg-surface-container-lowest p-8 md:p-10 rounded-2xl border border-outline-variant/20 shadow-sm space-y-6">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-b border-outline-variant/10 pb-6">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-1">Address Label</p>
                <p class="font-body-md text-lg text-primary font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary text-[20px]">home_pin</span>
                    {{ $address->address_label }}
                </p>
            </div>
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-1">Recipient Person</p>
                <p class="font-body-md text-primary font-semibold">{{ $address->recipient_name }}</p>
                <p class="text-sm text-on-surface-variant">{{ $address->recipient_phone ?? 'No phone attached' }}</p>
            </div>
        </div>

        <div class="border-b border-outline-variant/10 pb-6">
            <p class="text-[11px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-2">Full Delivery Address</p>
            <p class="font-body-md text-primary text-base leading-relaxed whitespace-pre-line bg-surface p-4 rounded-xl border border-outline-variant/10 font-medium">
                {{ $address->full_address }}
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 border-b border-outline-variant/10 pb-6">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-1">District</p>
                <p class="text-sm font-semibold text-primary">{{ $address->district ?? '-' }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-1">City / Regency</p>
                <p class="text-sm font-semibold text-primary">{{ $address->city }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-1">Province</p>
                <p class="text-sm font-semibold text-primary">{{ $address->province }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold uppercase tracking-wider text-on-surface-variant/60 mb-1">Postal Code</p>
                <p class="text-sm font-mono font-bold text-secondary">{{ $address->postal_code }}</p>
            </div>
        </div>

        <div class="pt-4 flex gap-4">
            <a href="{{ route('front.address.edit', $address->id) }}" class="w-full py-4 bg-primary hover:bg-[#122335] text-white font-button rounded-xl text-button font-bold text-center shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 cursor-pointer tracking-wide">
                <span class="material-symbols-outlined text-[20px]">edit</span>
                Edit This Address
            </a>
            <a href="{{ route('front.profile') }}" class="px-6 py-4 bg-surface hover:bg-surface-container border border-outline-variant/30 text-primary font-button rounded-xl text-center transition-colors cursor-pointer">
                Back to Dashboard
            </a>
        </div>

    </div>
</main>
@endsection