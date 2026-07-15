@extends('admin.layout.layout')
@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <div class="max-w-xl bg-white p-8 rounded-xl shadow-sm border border-outline-variant/10">
        <h2 class="text-2xl font-bold mb-6">Edit Stock: {{ $product->name }}</h2>
        <form action="{{ route('inventory.update', $product->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-6">
                <label class="block text-[10px] font-bold uppercase mb-2">Stock Level</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full p-4 bg-surface-container-low rounded-xl border border-outline-variant/20 focus:ring-2 focus:ring-primary outline-none">
            </div>
            <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:opacity-90 transition-all">Update Stock</button>
        </form>
    </div>
</main>
@endsection