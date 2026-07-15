@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[290px] xl:ml-[310px] pt-24 min-h-screen px-4 sm:px-6 lg:px-8 py-8 max-w-[1400px] mx-auto">
    
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <nav class="flex items-center gap-2 text-on-surface-variant font-label-caps text-label-caps mb-2">
                <a href="{{ route('contacts.index') }}" class="hover:text-primary cursor-pointer transition-colors">COMMUNICATIONS</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-primary font-bold">MESSAGE DETAIL</span>
            </nav>
            <h3 class="text-2xl md:text-3xl font-extrabold text-primary tracking-tight">Customer Inquiry</h3>
        </div>
        <a href="{{ route('contacts.index') }}" class="px-6 py-2.5 bg-surface-container text-on-surface-variant rounded-xl font-title-sm flex items-center gap-2 hover:bg-outline-variant/20 transition-all active:scale-95 duration-200">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Back to List</span>
        </a>
    </section>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl luxury-shadow border border-outline-variant/10 p-8">
        
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <div>
                    <h4 class="font-bold text-primary">{{ $message->name }}</h4>
                    <p class="text-xs text-on-surface-variant">{{ $message->email }}</p>
                </div>
            </div>
            
            <div class="bg-surface-container-low/50 p-6 rounded-xl border border-outline-variant/10">
                <p class="text-xs font-bold text-secondary uppercase tracking-widest mb-2">Subject: {{ $message->subject }}</p>
                <p class="text-on-surface-variant font-body-md leading-relaxed">{{ $message->message }}</p>
                <p class="text-[10px] text-on-surface-variant/50 mt-4 italic">{{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <hr class="border-outline-variant/10 mb-8">

        <div>
            <h2 class="text-lg font-bold text-primary mb-4">Official Reply</h2>
            
            @if($message->reply)
                <div class="p-6 bg-primary/5 border-l-4 border-primary rounded-r-xl">
                    <p class="text-primary font-body-md leading-relaxed">{{ $message->reply }}</p>
                    <small class="text-[10px] font-bold text-primary/60 mt-4 block uppercase tracking-wider">
                        Replied on: {{ \Carbon\Carbon::parse($message->replied_at)->format('d M Y, H:i') }}
                    </small>
                </div>
            @else
                <form action="{{ route('admin.contacts.reply', $message->id) }}" method="POST">
                    @csrf
                    <textarea name="reply" rows="5" 
                        class="w-full bg-surface-container-low border-none rounded-xl p-4 focus:ring-1 focus:ring-primary outline-none transition-all text-sm" 
                        placeholder="Tulis balasan profesional Anda di sini..." required></textarea>
                    
                    <button type="submit" class="mt-4 px-6 py-3 bg-primary text-on-primary rounded-xl font-title-sm text-title-sm flex items-center gap-2 hover:bg-primary/90 transition-all luxury-shadow active:scale-95 duration-200 cursor-pointer">
                        <span class="material-symbols-outlined text-sm">send</span>
                        <span>Send Reply</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</main>
@endsection