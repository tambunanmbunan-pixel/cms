@extends('admin.layout.layout')
@section('content')
<main class="lg:ml-[310px] pt-24 px-8 py-8">
    <div class="bg-white p-8 rounded-2xl shadow-sm border max-w-lg">
        <h2 class="text-xl font-bold mb-6">Detail Channel: {{ $channel->name }}</h2>
        <div class="space-y-4">
            <p><strong>Method ID:</strong> {{ $channel->payment_method_id }}</p>
            <p><strong>Code:</strong> {{ $channel->code }}</p>
            <p><strong>Account:</strong> {{ $channel->account_number }}</p>
        </div>
        <a href="{{ route('payments.index') }}" class="mt-6 block text-center bg-gray-100 p-3 rounded-xl font-bold">Kembali</a>
    </div>
</main>
@endsection