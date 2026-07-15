<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\Admin\AdminService;
use Session;
use App\Http\Requests\Admin\PasswordRequest;

class AdminController extends Controller
{
    protected $adminService;

    /**
     * Constructor dengan Dependency Injection AdminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource (Dashboard Utama).
     */
    public function index()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource (Halaman Login).
     */
    public function create()
    {
        return view('admin.login');
    }

    /**
     * Store a newly created resource in storage (Proses Login).
     */
    public function store(LoginRequest $request)
    {
        $data = $request->all();
        $loginStatus = $this->adminService->login($data);

        if ($loginStatus == 1) {
            return redirect()->route('admin.dashboard'); 
        } else {
            return redirect()->back()->with('error_message', 'Invalid Email or Password');
        }
    }

    /**
     * Menampilkan Halaman Pusat Pengaturan (Settings Bento Box).
     */
    public function settings()
    {
        $adminDetails = Auth::guard('admin')->user();
        Session::put('page', 'settings'); // Menyalakan active menu 'Settings' di sidebar

        return view('admin.settings', compact('adminDetails'));
    }

        /**
     * Memproses pembaruan data profil admin (Nama, Mobile, & Image)
     */
    public function updateProfile(Request $request)
    {
        // Validasi dasar langsung di controller agar data aman
        $request->validate([
            'admin_name'   => 'required|string|max:255',
            'admin_mobile' => 'required|numeric',
            'admin_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Panggil service untuk memproses pembaruan data dan upload file
        $profileStatus = $this->adminService->updateProfile($request);

        if ($profileStatus['status'] == 'success') {
            return redirect()->back()->with('success_message', $profileStatus['message']);
        } else {
            return redirect()->back()->with('error_message', $profileStatus['message']);
        }
    }

    /**
     * Show the form for editing the specified resource (Halaman Form Update Password).
     */
    public function edit()
    {
        $adminDetails = Auth::guard('admin')->user();
        Session::put('page', 'settings'); // Tetap nyalakan menu 'Settings' karena ini bagian di dalamnya

        return view('admin.update_password', compact('adminDetails'));
    }

    public function subadmin()
    {
        // 1. Ambil data profil admin yang sedang login saat ini
        $adminDetails = Auth::guard('admin')->user();
        
        // 2. Menyalakan active menu 'subadmins' di sidebar
        Session::put('page', 'subadmins'); 
        
        // 3. PERBAIKAN: Langsung panggil Model Admin, jangan lewat Service Layer yang kosong
        $subadmins = Admin::where('role', 'subadmin')->get();
        
        // 4. Lempar data ke view Blade dengan compact
        return view('admin.subadmins.subadmins', compact('subadmins', 'adminDetails'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Verifikasi password secara real-time lewat AJAX keyup
     */
    public function verifyPassword(Request $request)
    {
        $adminPassword = Auth::guard('admin')->user()->password;

        if (Hash::check($request->current_pwd, $adminPassword)) {
            return "true";
        } else {
            return "false";
        }
    }

    /**
     * Memproses eksekusi perubahan password dari form submit
     */
    public function updatePassword(PasswordRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $pwdStatus = $this->adminService->updatePassword($data);

            if ($pwdStatus['status'] == 'success') {
                return redirect()->back()->with('success_message', $pwdStatus['message']);
            } else {
                return redirect()->back()->with('error_message', $pwdStatus['message']);
            }
        }
    }

    /**
     * Mengubah status aktif/nonaktif akun admin via AJAX Request
     */
    public function updateStatus(Request $request)
    {
        try {
            // Gunakan where() eksplisit untuk mengantisipasi sensitivitas kapital Oracle
            $admin = Admin::where('id', $request->admin_id)->first();
            
            if ($admin) {
                // Paksa perubahan kolom status menjadi integer (0 atau 1)
                $admin->status = (int) $request->status; 
                $admin->save();
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Oracle berhasil diperbarui menjadi ' . $request->status
                ]);
            }
            return response()->json(['status' => 'error', 'message' => 'Admin tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Menampilkan Halaman Form Tambah Sub-Admin
     */
    public function addEditSubadmin()
    {
        $adminDetails = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        \Illuminate\Support\Facades\Session::put('page', 'subadmins'); 

        // SELESAI: Sekarang diarahkan murni ke file create.blade.php sesuai maumu
        return view('admin.subadmins.create', compact('adminDetails'));
    }

    /**
     * Memproses Penyimpanan Data Sub-Admin Baru ke Oracle
     */
    public function saveSubadmin(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'mobile'   => 'required|numeric',
            'email'    => 'required|email|unique:ADMINS,EMAIL', 
            'password' => 'required|string|min:6',
        ], [
            'email.unique' => 'Email ini sudah terdaftar di sistem!',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.'
        ]);

        try {
            $subadmin = new Admin();
            $subadmin->name = $request->name;
            $subadmin->mobile = $request->mobile;
            $subadmin->email = $request->email;
            $subadmin->password = \Illuminate\Support\Facades\Hash::make($request->password);
            $subadmin->role = 'subadmin'; 
            $subadmin->status = 1;        
            $subadmin->save();

            return redirect()->route('admin.subadmins')->with('success_message', 'Akun Sub-Admin baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal menyimpan ke Oracle: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan Detail Akun Sub-Admin Secara Lengkap
     */
    public function showSubadmin($id)
    {
        // Ambil data sub-admin atau lempar error jika tidak ditemukan
        $subadminData = Admin::findOrFail($id);
        
        $adminDetails = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        \Illuminate\Support\Facades\Session::put('page', 'subadmins'); 

        return view('admin.subadmins.show', compact('subadminData', 'adminDetails'));
    }

    /**
     * Menampilkan Form Edit Akun Sub-Admin
     */
    public function editSubadmin($id)
    {
        // Ambil data sub-admin yang mau diedit
        $subadminData = Admin::findOrFail($id);
        
        $adminDetails = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        \Illuminate\Support\Facades\Session::put('page', 'subadmins'); 

        // Melempar data lama menggunakan compact ke file edit.blade.php
        return view('admin.subadmins.edit', compact('subadminData', 'adminDetails'));
    }

    /**
     * Memproses Eksekusi Pembaruan Data Sub-Admin ke Oracle
     */
    public function updateSubadmin(Request $request, $id)
    {
        // 1. Validasi Input Data (Abaikan keunikan email untuk ID sub-admin ini sendiri)
        $request->validate([
            'name'     => 'required|string|max:255',
            'mobile'   => 'required|numeric',
            'email'    => 'required|email|unique:ADMINS,EMAIL,' . $id, 
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh admin lain!',
            'image.image'  => 'Berkas harus berupa gambar.'
        ]);

        try {
            $subadmin = Admin::findOrFail($id);
            $subadmin->name = $request->name;
            $subadmin->mobile = $request->mobile;
            $subadmin->email = $request->email;

            // Jika admin mengisi password baru, maka update passwordnya
            if (!empty($request->password)) {
                $request->validate(['password' => 'string|min:6']);
                $subadmin->password = \Illuminate\Support\Facades\Hash::make($request->password);
            }

            // Proses Upload Gambar Baru jika ada
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Hapus gambar lama di folder jika ada agar tidak memenuhi storage
                    if (!empty($subadmin->image) && file_exists(public_path('admin/images/photos/' . $subadmin->image))) {
                        unlink(public_path('admin/images/photos/' . $subadmin->image));
                    }
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111, 99999) . '.' . $extension;
                    $image_tmp->move(public_path('admin/images/photos'), $image_name);
                    $subadmin->image = $image_name;
                }
            }

            $subadmin->save();

            return redirect()->route('admin.subadmins')->with('success_message', 'Data Sub-Admin berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Gagal memperbarui database Oracle: ' . $e->getMessage())->withInput();
        }
    }

    

    /**
     * Remove the specified resource from storage (Proses Logout).
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
            
        return redirect()->route('admin.login');
    }
}