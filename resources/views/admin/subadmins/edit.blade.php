@extends('admin.layout.layout')

@section('content')
<main class="ml-[280px] pt-24 pb-32 px-8 min-h-screen bg-gray-50/50">
    <div class="max-w-[800px] mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.subadmins') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-500 hover:text-[#FF6B35] transition-colors group">
                <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Manajemen Staf
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-extrabold text-xl text-[#081828] mb-1">Edit Sub-Admin Profile</h3>
                <p class="text-gray-500 text-xs">Ubah data operasional atau perbarui foto profil staf sub-admin #{{ $subadminData->id }}.</p>
            </div>

            @if(session('error_message'))
                <div class="m-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-xl text-xs font-semibold">
                    {{ session('error_message') }}
                </div>
            @endif

            <form action="{{ route('admin.update-subadmin', $subadminData->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-1.5">
                        <label for="name" class="block text-xs font-bold text-[#081828] uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $subadminData->name) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF6B35] focus:ring-1 focus:ring-[#FF6B35] transition-all" 
                               placeholder="Contoh: Muhammad Farhan">
                        @error('name') <p class="text-red-500 text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="mobile" class="block text-xs font-bold text-[#081828] uppercase tracking-wider">Nomor Handphone</label>
                        <input type="text" name="mobile" id="mobile" value="{{ old('mobile', $subadminData->mobile) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF6B35] focus:ring-1 focus:ring-[#FF6B35] transition-all" 
                               placeholder="Contoh: 0895xxxxxxxx">
                        @error('mobile') <p class="text-red-500 text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-[#081828] uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $subadminData->email) }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF6B35] focus:ring-1 focus:ring-[#FF6B35] transition-all" 
                               placeholder="admin1@gmail.com">
                        @error('email') <p class="text-red-500 text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-bold text-[#081828] uppercase tracking-wider">Password Baru (Opsional)</label>
                        <input type="password" name="password" id="password"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#FF6B35] focus:ring-1 focus:ring-[#FF6B35] transition-all" 
                               placeholder="Kosongkan jika tidak ingin diubah">
                        @error('password') <p class="text-red-500 text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="image" class="block text-xs font-bold text-[#081828] uppercase tracking-wider">Foto Profil Staf</label>
                        <div class="flex items-center gap-5 p-4 border border-dashed border-gray-200 rounded-xl bg-gray-50/50">
                            <div class="w-16 h-16 rounded-full border border-gray-200 bg-white overflow-hidden shrink-0 shadow-sm">
                                @if(!empty($subadminData->image) && file_exists(public_path('admin/images/photos/'.$subadminData->image)))
                                    <img src="{{ asset('admin/images/photos/'.$subadminData->image) }}" class="w-full h-full object-cover" alt="Current Photo">
                                @else
                                    <img src="{{ asset('admin/images/photos/default.png') }}" class="w-full h-full object-cover" alt="Default">
                                @endif
                            </div>
                            
                            <div class="w-full">
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#FF6B35]/10 file:text-[#FF6B35] hover:file:bg-[#FF6B35]/20 file:cursor-pointer transition-all">
                                <p class="text-[11px] text-gray-400 mt-1">Pilih berkas baru jika ingin mengganti foto saat ini (Max: 2MB).</p>
                            </div>
                        </div>
                        @error('image') <p class="text-red-500 text-[11px] font-semibold mt-0.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.subadmins') }}" 
                       class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-500 text-xs font-bold hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[#FF6B35] hover:bg-[#e05a2b] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</main>
@endsection