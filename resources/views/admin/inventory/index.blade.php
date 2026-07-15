@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-stack-lg">
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
            <h3 class="text-on-surface-variant text-body-sm">Total Fragrances</h3>
            <p class="text-display-lg text-primary">{{ $products->count() }}</p>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
            <h3 class="text-on-surface-variant text-body-sm">Active Bundles</h3>
            <p class="text-display-lg text-primary">{{ $bundles->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-gutter">
        <section class="col-span-12 lg:col-span-8 space-y-stack-md">
            
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/10 overflow-hidden mb-8">
                <div class="p-6 border-b border-outline-variant/10">
                    <h2 class="font-headline-md text-primary">Product Inventory</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-outline-variant/10">
                            @foreach($products as $product)
                            <tr class="hover:bg-surface-container-lowest/50">
                                <td class="px-6 py-4 font-title-sm text-primary">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-4 py-4 text-center font-bold">{{ $product->stock }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('inventory.edit', $product->id) }}" class="text-secondary hover:text-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/10 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/10">
                    <h2 class="font-headline-md text-primary">Bundle Inventory</h2>
                </div>
                <table class="w-full text-left">
                    <tbody class="divide-y divide-outline-variant/10">
                        @foreach($bundles as $bundle)
                        <tr class="hover:bg-surface-container-lowest/50">
                            <td class="px-6 py-4 font-title-sm text-primary">{{ $bundle->name }}</td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">Bundle</td>
                            <td class="px-6 py-4 text-center font-bold">{{ $bundle->stock }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('bundles.edit', $bundle->id) }}" class="text-secondary hover:text-primary">Edit Stock</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <aside class="col-span-12 lg:col-span-4 space-y-gutter">
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10">
                <h2 class="font-headline-md text-primary mb-4">Stock Alerts</h2>
                <div class="space-y-4">
                    @foreach($products->where('stock', '<', 10) as $p)
                        <div class="p-3 bg-error-container/5 border-l-4 border-error rounded-r-lg text-xs">
                            {{ $p->name }} ({{ $p->stock }} left)
                        </div>
                    @endforeach
                    @foreach($bundles->where('stock', '<', 5) as $b)
                        <div class="p-3 bg-secondary-container/5 border-l-4 border-secondary rounded-r-lg text-xs">
                            {{ $b->name }} ({{ $b->stock }} left)
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection