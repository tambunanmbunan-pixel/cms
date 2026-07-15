@extends('admin.layout.layout')

@section('content')
<div class="w-full md:w-1/2 px-2 mx-auto pt-6">
    <div class="bg-white border-t-[4px] border-[#FF6B35] rounded-[12px] shadow-sm mb-4 overflow-hidden">
        
        <div class="px-6 py-4 border-b border-outline-variant/30 flex items-center justify-between">
            <h3 class="text-title-md font-bold text-on-surface">Update Password</h3>
            
            <a href="{{ route('admin.settings') }}" 
               class="flex items-center gap-2 px-3 py-1.5 bg-white border border-gray-200 hover:border-gray-300 rounded-[8px] text-[13px] font-bold text-gray-700 hover:bg-gray-50 transition-all shadow-sm group">
                <span class="material-symbols-outlined text-[16px] text-gray-400 group-hover:text-[#FF6B35] group-hover:-translate-x-0.5 transition-all">arrow_back</span>
                Back
            </a>
        </div>
        
        <div class="px-6 pt-4">
            {{-- Alert Sukses --}}
            @if(Session::has('success_message'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-[12px] font-body-sm">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <span>{{ Session::get('success_message') }}</span>
                </div>
            @endif

            {{-- Alert Gagal / Error dari Session --}}
            @if(Session::has('error_message'))
                <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-[12px] font-body-sm">
                    <span class="material-symbols-outlined text-red-600">error</span>
                    <span>{{ Session::get('error_message') }}</span>
                </div>
            @endif

            {{-- Alert Validasi PasswordRequest --}}
            @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-[12px] font-body-sm space-y-1">
                    <div class="flex items-center gap-3 font-semibold mb-1">
                        <span class="material-symbols-outlined text-red-600">warning</span>
                        <span>Periksa Kembali Inputan Anda:</span>
                    </div>
                    <ul class="list-disc list-inside pl-7 text-[13px] space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
        <form action="{{ route('admin.update-password.request') }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                
                <div class="space-y-2">
                    <label class="font-label-caps text-on-surface-variant block">Admin Email</label>
                    <input type="email" 
                           value="{{ $adminDetails->email ?? '' }}" 
                           disabled 
                           class="w-full px-4 py-3 bg-gray-100 border border-outline-variant rounded-[12px] text-gray-500 cursor-not-allowed outline-none" />
                </div>
                
                <div class="space-y-2">
                    <label for="current_pwd" class="font-label-caps text-on-surface-variant block">Current Password</label>
                    <input type="password" 
                           id="current_pwd_form" 
                           name="current_pwd"
                           placeholder="Enter current password"
                           required
                           class="w-full px-4 py-3 bg-white border border-outline-variant rounded-[12px] focus:outline-none focus:border-[#FF6B35] transition-all" />
                </div>
                
                <div class="space-y-2">
                    <label for="new_pwd" class="font-label-caps text-on-surface-variant block">New Password</label>
                    <input type="password" 
                           id="new_pwd" 
                           name="new_pwd"
                           placeholder="Enter new password"
                           required
                           class="w-full px-4 py-3 bg-white border border-outline-variant rounded-[12px] focus:outline-none focus:border-[#FF6B35] transition-all" />
                </div>
                
                <div class="space-y-2">
                    <label for="confirm_pwd" class="font-label-caps text-on-surface-variant block">Confirm New Password</label>
                    <input type="password" 
                           id="confirm_pwd" 
                           name="confirm_pwd"
                           placeholder="Confirm new password"
                           required
                           class="w-full px-4 py-3 bg-white border border-outline-variant rounded-[12px] focus:outline-none focus:border-[#FF6B35] transition-all" />
                </div>
                
            </div>
            
            <div class="px-6 py-4 bg-surface-container/20 border-t border-outline-variant/30 flex justify-end gap-3">
                <a href="{{ route('admin.settings') }}" 
                   class="px-5 py-2.5 bg-white border border-gray-200 hover:border-gray-300 rounded-[12px] text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all shadow-sm">
                    Cancel
                </a>
                
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#FF6B35] text-white font-title-sm rounded-[12px] hover:shadow-lg hover:shadow-[#FF6B35]/20 active:scale-95 transition-all duration-200">
                    Update Password
                </button>
            </div>
        </form>
        
    </div>
</div>
@endsection