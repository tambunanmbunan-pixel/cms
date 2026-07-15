@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-stack-lg">
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-primary-container/10 rounded-lg text-primary"><span class="material-symbols-outlined">shopping_cart</span></div>
            </div>
            <div class="mt-4">
                <h3 class="text-on-surface-variant text-body-sm font-medium">Total Active Carts</h3>
                <p class="text-display-lg font-display-lg text-primary">{{ $stats['total_carts'] }}</p>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-on-tertiary-container/10 text-on-tertiary-container rounded-lg"><span class="material-symbols-outlined">layers</span></div>
            </div>
            <div class="mt-4">
                <h3 class="text-on-surface-variant text-body-sm font-medium">Total Items</h3>
                <p class="text-display-lg font-display-lg text-primary">{{ $stats['total_items_count'] }}</p>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-secondary-container/10 text-secondary-container rounded-lg"><span class="material-symbols-outlined">shopping_bag</span></div>
            </div>
            <div class="mt-4">
                <h3 class="text-on-surface-variant text-body-sm font-medium">Carts > 3 Items</h3>
                <p class="text-display-lg font-display-lg text-secondary">{{ $stats['carts_with_many_items'] }}</p>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant/10 flex flex-col justify-between">
            <div class="flex justify-between items-start">
                <div class="p-2 bg-error-container/20 text-error rounded-lg"><span class="material-symbols-outlined">person</span></div>
            </div>
            <div class="mt-4">
                <h3 class="text-on-surface-variant text-body-sm font-medium">Unique Customers</h3>
                <p class="text-display-lg font-display-lg text-error">{{ $stats['total_users_active'] }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-gutter">
        <section class="col-span-12 lg:col-span-12 space-y-stack-md">
            <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/10 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
                    <h2 class="font-headline-md text-headline-md text-primary">Cart Analysis Details</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low text-on-surface-variant font-label-caps text-[10px] tracking-widest uppercase">
                                <th class="px-6 py-4">Customer Name</th>
                                <th class="px-6 py-4">Items Summary</th>
                                <th class="px-6 py-4 text-center">Total Qty</th>
                                <th class="px-6 py-4 text-right">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @foreach($carts as $cart)
                            <tr class="hover:bg-surface-container-lowest/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-primary">
                                    {{ $cart->customer->name ?? 'Unregistered User' }}
                                </td>
                                <td class="px-6 py-4 text-body-sm text-on-surface-variant">
                                    {{ $cart->items->take(3)->map(fn($i) => $i->product->name ?? ($i->bundle->name ?? 'Unknown'))->implode(', ') }}
                                    @if($cart->items->count() > 3) 
                                        <span class="text-primary font-bold">... +{{ $cart->items->count() - 3 }} more</span> 
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-primary">{{ $cart->items->sum('quantity') }}</td>
                                <td class="px-6 py-4 text-right text-on-surface-variant">{{ $cart->updated_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection