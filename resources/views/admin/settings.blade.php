@extends('admin.layout.layout')

@section('content')
<main class="ml-[280px] pt-24 pb-32 px-8 min-h-screen bg-gray-50/50">
    <div class="max-w-[1000px] mx-auto space-y-8">
        
        @if(Session::has('success_message'))
            <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-semibold shadow-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <span>{{ Session::get('success_message') }}</span>
            </div>
        @endif

        @if(Session::has('error_message'))
            <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm font-semibold shadow-sm">
                <span class="material-symbols-outlined text-red-600">error</span>
                <span>{{ Session::get('error_message') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm mb-8">
                <div class="flex items-start justify-between mb-8">
                    <div>
                        <h3 class="font-extrabold text-2xl text-[#081828] mb-1">Admin Profile</h3>
                        <p class="text-gray-500 text-sm">Manage your personal information, contact number, and avatar image.</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 hover:border-gray-300 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50 transition-all shadow-sm group">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 group-hover:text-[#FF6B35] group-hover:-translate-x-0.5 transition-all">arrow_back</span>
                            Back
                        </a>
                        
                        <button type="submit" class="px-5 py-2 bg-[#FF6B35] text-white font-bold text-sm rounded-xl hover:shadow-lg hover:shadow-[#FF6B35]/20 transition-all duration-200">
                            Save Changes
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-12">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-100 shadow-inner bg-gray-100 flex items-center justify-center">
                                @if(!empty($adminDetails->image))
                                    <img alt="Avatar" class="w-full h-full object-cover" src="{{ asset('admin/images/photos/'.$adminDetails->image) }}"/>
                                @else
                                    <img alt="Default Avatar" class="w-full h-full object-cover" src="{{ asset('admin/images/photos/default.png') }}"/>
                                @endif
                            </div>
                            <label for="admin_image" class="absolute bottom-0 right-0 bg-[#FF6B35] text-white p-2 rounded-full shadow-lg hover:scale-105 transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                                <input type="file" id="admin_image" name="admin_image" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase">Update Photo</p>
                    </div>

                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Full Name</label>
                            <input class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-[#081828] outline-none focus:border-[#FF6B35] focus:bg-white transition-all" 
                                   type="text" name="admin_name" value="{{ $adminDetails->name ?? '' }}" required />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email Address</label>
                            <input class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-400 cursor-not-allowed outline-none" 
                                   type="email" value="{{ $adminDetails->email ?? '' }}" disabled />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mobile Number</label>
                            <input class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-[#081828] outline-none focus:border-[#FF6B35] focus:bg-white transition-all" 
                                   type="text" name="admin_mobile" value="{{ $adminDetails->mobile ?? '' }}" placeholder="Enter phone number" required />
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">System Role</label>
                            <input class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-500 italic cursor-not-allowed outline-none" 
                                   type="text" value="{{ $adminDetails->role ?? 'Administrator' }}" disabled />
                        </div>
                    </div>
                </div>
            </section>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <section class="lg:col-span-2 bg-white rounded-2xl p-8 border border-gray-100 shadow-sm flex flex-col">
                <div class="mb-6">
                    <h3 class="font-bold text-xl text-[#081828] mb-1">Brand Identity</h3>
                    <p class="text-gray-500 text-sm">Global assets for the customer-facing storefront.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1">
                    <div class="border border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center space-y-3 bg-gray-50 hover:bg-gray-100/50 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-gray-400 text-[36px]">upload_file</span>
                        <div class="text-center">
                            <p class="font-semibold text-sm text-[#081828]">Main Logo</p>
                            <p class="text-xs text-gray-400 mt-0.5">PNG or SVG, max 2MB</p>
                        </div>
                    </div>
                    <div class="border border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center space-y-3 bg-gray-50 hover:bg-gray-100/50 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-gray-400 text-[36px]">tab</span>
                        <div class="text-center">
                            <p class="font-semibold text-sm text-[#081828]">Favicon</p>
                            <p class="text-xs text-gray-400 mt-0.5">ICO or PNG, 32x32px</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h3 class="font-bold text-xl text-[#081828] mb-4">System</h3>
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Language</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-[#081828] outline-none focus:border-[#FF6B35]">
                            <option>English (United Kingdom)</option>
                            <option>French (Paris)</option>
                            <option>Japanese (Tokyo)</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Timezone</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-[#081828] outline-none focus:border-[#FF6B35]">
                            <option>GMT +0:00 (London)</option>
                            <option>EST -5:00 (New York)</option>
                            <option>JST +9:00 (Tokyo)</option>
                        </select>
                    </div>
                </div>
            </section>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <section class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-[#FF6B35]">security</span>
                        <h3 class="font-bold text-xl text-[#081828]">Security & Access</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div>
                                <p class="font-semibold text-sm text-[#081828]">Two-Factor Authentication</p>
                                <p class="text-xs text-gray-400 mt-0.5">Protect your account with an extra layer.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input checked class="sr-only peer" type="checkbox"/>
                                <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF6B35]"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('admin.update-password') }}" 
                       class="w-full px-4 py-3.5 rounded-xl border border-gray-200 text-[#081828] text-sm font-bold bg-white hover:bg-gray-50 hover:border-gray-300 transition-all flex justify-between items-center group shadow-sm">
                        <span>Change Master Password</span>
                        <span class="material-symbols-outlined text-[18px] text-gray-400 group-hover:text-[#FF6B35] group-hover:translate-x-1 transition-all">chevron_right</span>
                    </a>
                </div>
            </section>

            <section class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-[#0d1d2c]">notifications_active</span>
                    <h3 class="font-bold text-xl text-[#081828]">Notification Settings</h3>
                </div>
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-[#081828]">Inventory Alerts</span>
                        <input checked class="w-4 h-4 text-[#FF6B35] border-gray-300 focus:ring-[#FF6B35] rounded" type="checkbox"/>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-[#081828]">New Order Updates</span>
                        <input checked class="w-4 h-4 text-[#FF6B35] border-gray-300 focus:ring-[#FF6B35] rounded" type="checkbox"/>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm font-medium text-[#081828]">System Maintenance</span>
                        <input class="w-4 h-4 text-[#FF6B35] border-gray-300 focus:ring-[#FF6B35] rounded" type="checkbox"/>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm font-medium text-[#081828]">Security Logs (Email)</span>
                        <input checked class="w-4 h-4 text-[#FF6B35] border-gray-300 focus:ring-[#FF6B35] rounded" type="checkbox"/>
                    </div>
                </div>
            </section>
        </div>
        
    </div>
</main>
@endsection