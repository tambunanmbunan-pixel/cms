@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <span class="text-primary font-bold">CONTACT MESSAGES</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Customer Inquiries</h3>
            <p class="text-on-surface-variant font-body-md text-sm mt-1">Manage and respond to messages from your customers.</p>
        </div>
    </section>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl luxury-shadow overflow-hidden border border-outline-variant/10">
        <div class="px-8 py-5 border-b border-outline-variant/10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="font-title-sm text-title-sm text-primary">Messages List</span>
                <span class="px-2 py-0.5 bg-surface-container text-on-surface-variant rounded-full text-[10px] font-bold uppercase">{{ $messages->count() }} Total</span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Customer</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Subject</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Status</th>
                        <th class="px-6 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10">Received</th>
                        <th class="px-8 py-4 font-label-caps text-label-caps text-on-surface-variant border-b border-outline-variant/10 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse($messages as $msg)
                        <tr data-href="{{ route('contacts.show', $msg->id) }}" class="category-row hover:bg-surface-container-low transition-colors group cursor-pointer select-none">
                            <td class="px-8 py-5">
                                <p class="font-title-sm text-primary font-bold">{{ $msg->name }}</p>
                                <p class="text-on-surface-variant text-[11px]">{{ $msg->email }}</p>
                            </td>
                            <td class="px-6 py-5 text-sm text-primary font-medium">{{ $msg->subject }}</td>
                            <td class="px-6 py-5">
                                @if($msg->reply)
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded-full uppercase">Replied</span>
                                @else
                                    <span class="px-2 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold rounded-full uppercase">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-on-surface-variant text-xs">{{ $msg->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-5 text-right">
                                <div class="action-area flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all duration-200">
                                    <a href="{{ route('contacts.show', $msg->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-surface-container hover:bg-primary/10 text-on-surface-variant hover:text-primary text-xs font-bold rounded-xl border border-outline-variant/20 transition-all">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        <span>Detail</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-on-surface-variant text-sm">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.category-row');
        rows.forEach(row => {
            row.addEventListener('click', function(event) {
                if (event.target.closest('.action-area')) return;
                const url = this.getAttribute('data-href');
                if (url) window.location.href = url;
            });
        });
    });
</script>
@endsection