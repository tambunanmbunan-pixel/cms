@extends('admin.layout.layout')
@section('content')
<main class="lg:ml-[310px] pt-24 px-8 py-8">
    <form action="{{ route('payments.update', $channel->id) }}" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border max-w-2xl">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block font-bold mb-2">Channel Name</label>
            <input type="text" name="name" value="{{ $channel->name }}" class="w-full p-4 border rounded-xl" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-bold mb-2">Account Number</label>
            <input type="text" name="account_number" value="{{ $channel->account_number }}" class="w-full p-4 border rounded-xl">
        </div>

        <button type="submit" class="bg-[#FF6B35] text-white px-8 py-4 rounded-xl font-bold">Update Channel</button>
    </form>
</main>
@endsection