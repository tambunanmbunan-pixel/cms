@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[310px] pt-24 px-8 py-8 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Payment Management</h2>
        <a href="{{ route('payments.create') }}" class="bg-[#FF6B35] text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 shadow-lg">
            <span class="material-symbols-outlined">add</span> Add New Channel
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="p-6 text-xs font-bold text-gray-400 uppercase">Payment Method</th>
                    <th class="p-6 text-xs font-bold text-gray-400 uppercase text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach($methods as $method)
            <tr x-data="{ open: false }" class="group hover:bg-gray-50 transition-colors">
                <td class="p-6">
                    <button @click="open = !open" class="flex items-center gap-3 w-full font-bold text-gray-800">
                        <span class="material-symbols-outlined transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                        {{ $method->name }}
                    </button>

                    <div x-show="open" x-cloak class="mt-4 ml-10 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <table class="w-full text-sm">
                            @forelse($method->channels as $channel)
                            <tr class="border-b last:border-0 border-gray-200">
                                <td class="py-2">{{ $channel->name }}</td>
                                <td class="py-2 font-mono text-gray-500">{{ $channel->account_number }}</td>
                                <td class="py-2 text-right flex justify-end gap-3">
                                    <a href="{{ route('payments.edit', $channel->id) }}" class="text-[#FF6B35] font-bold hover:underline">Edit</a>
                                    
                                    <form action="{{ route('payments.destroy', $channel->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus channel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 font-bold hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="py-2 text-gray-400 italic">No channels found.</td></tr>
                            @endforelse
                        </table>
                    </div>
                </td>
                <td class="p-6 text-right">
                    <span class="text-xs text-green-500 font-bold px-2 py-1 bg-green-50 rounded-lg">ACTIVE</span>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</main>
@endsection