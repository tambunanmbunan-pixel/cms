@extends('admin.layout.layout')
@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-sm max-w-2xl border border-outline-variant/10">
        <a href="{{ route('inventory.index') }}" class="text-xs font-bold text-on-surface-variant hover:text-primary">← BACK TO LIST</a>
        <h1 class="text-3xl font-extrabold text-primary mt-4 mb-6">{{ $product->name }}</h1>
        <div class="grid grid-cols-2 gap-6">
            <div class="p-6 bg-surface-container-low rounded-xl">
                <p class="text-[10px] uppercase text-on-surface-variant">Current Stock</p>
                <p class="text-4xl font-black text-primary">{{ $product->stock }}</p>
            </div>
            <div class="p-6 bg-surface-container-low rounded-xl">
                <p class="text-[10px] uppercase text-on-surface-variant">Price</p>
                <p class="text-4xl font-black text-primary">Rp{{ number_format($product->price, 0) }}</p>
            </div>
        </div>
    </div>
</main>
@endsection