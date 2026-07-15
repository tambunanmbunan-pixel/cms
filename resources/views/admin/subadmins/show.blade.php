@extends('admin.layout.layout')

@section('content')
<main class="ml-[280px] pt-24 pb-32 px-8 min-h-screen bg-gray-50/50">
    <div class="max-w-[700px] mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.subadmins') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-[#FF6B35] transition-colors group">
                <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Manajemen Staf
            </a>

            <a href="{{ route('admin.edit-subadmin', $subadminData->id) }}" 
               class="inline-flex items-center gap-1.5 bg-[#FF6B35] hover:bg-[#e05a2b] text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 group">
                <span class="material-symbols-outlined text-[16px] text-white transition-transform group-hover:rotate-12 duration-150">edit</span>
                Edit Profile
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="h-28 bg-gradient-to-r from-[#081828] to-[#FF6B35]/90 relative"></div>

            <div class="px-6 pb-6 relative">
                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between -mt-14 mb-6 gap-4">
                    <div class="w-24 h-24 rounded-full border-4 border-white bg-gray-100 shadow-md overflow-hidden shrink-0">
                        @if(!empty($subadminData->image) && file_exists(public_path('admin/images/photos/'.$subadminData->image)))
                            <img src="{{ asset('admin/images/photos/'.$subadminData->image) }}" class="w-full h-full object-cover" alt="Avatar">
                        @else
                            <img src="{{ asset('admin/images/photos/default.png') }}" class="w-full h-full object-cover" alt="Default Avatar">
                        @endif
                    </div>

                    <div class="pb-1">
                        @if($subadminData->status == 1)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-full border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Akun Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-500 text-xs font-bold rounded-full border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="border-b border-gray-100 pb-5 mb-5 space-y-1">
                    <h2 class="text-2xl font-extrabold text-[#081828] tracking-tight">{{ $subadminData->name }}</h2>
                    <p class="text-xs font-semibold text-gray-400 flex items-center gap-1.5 uppercase tracking-wider">
                        <span class="material-symbols-outlined text-[16px] text-[#FF6B35]">shield_person</span>
                        Hak Akses: <span class="text-[#081828]">{{ $subadminData->role }}</span>
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="p-4 rounded-xl border border-gray-50 bg-gray-50/40 space-y-1">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID Anggota</span>
                        <p class="text-sm font-bold text-[#081828]">#{{ $subadminData->id }}</p>
                    </div>

                    <div class="p-4 rounded-xl border border-gray-50 bg-gray-50/40 space-y-1">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Nomor Handphone</span>
                        <p class="text-sm font-semibold text-gray-700 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px] text-gray-400">call</span>
                            {{ $subadminData->mobile }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-gray-50 bg-gray-50/40 space-y-1 sm:col-span-2">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Alamat Email Terdaftar</span>
                        <p class="text-sm font-semibold text-gray-700 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px] text-gray-400">mail</span>
                            {{ $subadminData->email }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
@endsection