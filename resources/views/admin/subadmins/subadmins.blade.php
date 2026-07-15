@extends('admin.layout.layout')

@section('content')
<main class="ml-[280px] pt-24 pb-32 px-8 min-h-screen bg-gray-50/50">
    <div class="max-w-[1200px] mx-auto space-y-8">
        
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
                <div>
                    <h3 class="font-extrabold text-xl text-[#081828] mb-1">Sub-Admin Management</h3>
                    <p class="text-gray-500 text-xs">Daftar akun staf operasional pendukung sistem yang aktif saat ini.</p>
                </div>
                
                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    <span class="px-3 py-2 bg-[#FF6B35]/10 text-[#FF6B35] text-xs font-bold rounded-xl border border-[#FF6B35]/10">
                        Total Staf: {{ $subadmins->count() }} Orang
                    </span>
                    
                    <a href="{{ route('admin.add-edit-subadmin') }}" 
                       class="inline-flex items-center gap-2 bg-[#FF6B35] hover:bg-[#e05a2b] text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 group">
                        <span class="material-symbols-outlined text-[18px] text-white transition-transform group-hover:rotate-90 duration-200">add_circle</span>
                        Add Admin
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="p-4 w-12">ID</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">Mobile</th>
                            <th class="p-4">Email</th>
                            <th class="p-4 text-center">Account Status</th> 
                        </tr>
                    </thead>
                    
                    <tbody class="divide-y divide-gray-100 text-sm text-[#081828]">
                        @foreach($subadmins as $subadmin)
                            <tr class="hover:bg-gray-50/70 transition-all duration-150">
                                <td class="p-4 font-bold text-gray-400 text-xs">{{ $subadmin->id }}</td>
                                
                                <td class="p-4 font-bold text-[#081828]">{{ $subadmin->name }}</td>
                                
                                <td class="p-4 text-gray-600 font-medium">{{ $subadmin->mobile }}</td>
                                
                                <td class="p-4 text-gray-600 font-medium">{{ $subadmin->email }}</td>
                                
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('admin.show-subadmin', $subadmin->id) }}" 
                                        class="inline-flex items-center gap-1 bg-gray-100 hover:bg-[#FF6B35]/10 text-gray-600 hover:text-[#FF6B35] text-xs font-bold px-3 py-1.5 rounded-xl border border-gray-200 hover:border-[#FF6B35]/20 transition-all duration-150 shadow-sm">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            Detail
                                        </a>
                                    </div>
                                </td>
                                
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center">
                                        @if($subadmin->status == 1)
                                            <a class="updateSubadminStatus relative inline-flex items-center cursor-pointer select-none" 
                                            data-subadmin_id="{{ $subadmin->id }}" 
                                            href="javascript:void(0)">
                                                <div class="w-11 h-6 bg-emerald-500 rounded-full transition-all duration-200 shadow-inner flex items-center justify-end px-[2px]">
                                                    <div class="bg-white rounded-full h-5 w-5 shadow"></div>
                                                </div>
                                                <i class="hidden" data-status="Active"></i>
                                            </a>
                                        @else
                                            <a class="updateSubadminStatus relative inline-flex items-center cursor-pointer select-none" 
                                            data-subadmin_id="{{ $subadmin->id }}" 
                                            href="javascript:void(0)">
                                                <div class="w-11 h-6 bg-gray-200 rounded-full transition-all duration-200 shadow-inner flex items-center justify-start px-[2px]">
                                                    <div class="bg-white rounded-full h-5 w-5 shadow"></div>
                                                </div>
                                                <i class="hidden" data-status="Inactive"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@endsection