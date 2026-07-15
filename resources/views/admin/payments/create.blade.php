@extends('admin.layout.layout')

@section('content')
<main class="lg:ml-[310px] pt-24 px-8 py-8 bg-gray-50 min-h-screen">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Add New Payment Channel</h2>
        <p class="text-gray-500">Isi detail channel pembayaran baru untuk sistem Anda.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-2xl">
        <form action="{{ route('payments.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Payment Method</label>
                <select name="payment_method_id" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent transition outline-none">
                    @foreach(\App\Models\PaymentMethod::all() as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Channel Name (e.g. BCA)</label>
                <input type="text" name="name" placeholder="Masukan nama bank/e-wallet" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent transition outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Channel Code (Unique ID)</label>
                <input type="text" name="code" placeholder="Contoh: bca_transfer" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent transition outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Account Number</label>
                <input type="text" name="account_number" placeholder="Nomor rekening" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF6B35] focus:border-transparent transition outline-none">
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-[#FF6B35] text-white p-4 rounded-xl font-bold hover:bg-[#e05a2d] transition shadow-lg shadow-[#FF6B35]/20">
                    Save Channel
                </button>
                <a href="{{ route('payments.index') }}" class="px-6 py-4 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>
@endsection