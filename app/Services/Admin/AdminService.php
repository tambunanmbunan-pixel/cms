<?php

namespace App\Services\Admin;
use App\Models\Admin;
use Auth;
use Hash;

class AdminService
{
    public function login($data)
    {
        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            
            // Logika Remember Me jika dicentang
            if (!empty($data['remember'])) {
                // Set cookie native PHP selama 30 hari, pastikan pakai path "/" di akhir
                setcookie("email", $data['email'], time() + (86400 * 30), "/");
                setcookie("password", $data['password'], time() + (86400 * 30), "/");
            } else {
                // Jika tidak dicentang, langsung hanguskan cookie lama
                setcookie("email", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }
            
            return 1;
        }
        
        return 0;
    }

    public function verifyPassword($data)
    {
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return true;
        }else {
            return false;
        }
    }

        public function updatePassword($data)
    {
        // Check if current password is correct
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            
            // Check if new password and confirm password match
            if($data['new_pwd'] === $data['confirm_pwd']) {
                
                // Proses update password ke database
                Admin::where('email', Auth::guard('admin')->user()->email)->update(['password' => bcrypt($data['new_pwd'])]);
                
                // PERBAIKAN: Sekarang menggunakan tanda kutip agar dibaca sebagai string, bukan constant!
                $status = "success"; 
                $message = "Password updated successfully!";
                
            } else {
                $status = "error";
                $message = "New password and confirm password do not match!";
            }
        } else {
            $status = "error";
            $message = "Current password is incorrect!";
        }

        return ["status" => $status, "message" => $message];
    }

        /**
     * Memproses pembaruan data profil dan berkas gambar admin
     */
    public function updateProfile($request)
    {
        try {
            $adminId = Auth::guard('admin')->user()->id;
            $admin = Admin::find($adminId);

            // 1. Tangani Upload Gambar jika ada file baru yang dimasukkan
            if ($request->hasFile('admin_image')) {
                $imageTmp = $request->file('admin_image');
                
                if ($imageTmp->isValid()) {
                    // Buat nama file unik: e.g., admin_1_17182345.png
                    $extension = $imageTmp->getClientOriginalExtension();
                    $imageName = 'admin_' . $adminId . '_' . rand(11111, 99999) . '.' . $extension;
                    
                    // Tentukan jalur folder penyimpanan berkas foto profil kamu
                    $imagePath = public_path('admin/images/photos/' . $imageName);
                    
                    // Hapus foto lama dari folder jika foto lamanya bukan default.png dan filenya ada
                    if (!empty($admin->image) && $admin->image != 'default.png') {
                        $oldImagePath = public_path('admin/images/photos/' . $admin->image);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }

                    // Pindahkan file gambar baru ke folder target
                    $imageTmp->move(public_path('admin/images/photos'), $imageName);
                    
                    // Update nama file baru ke database
                    $admin->image = $imageName;
                }
            }

            // 2. Update data string (Nama dan Nomor Handphone)
            $admin->name = $request->input('admin_name');
            $admin->mobile = $request->input('admin_mobile');
            $admin->save();

            return [
                'status' => 'success',
                'message' => 'Profile details updated successfully!'
            ];

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ];
        }
    }

   public function subadmin() 
    {
        // Ambil data admin yang sedang login (untuk info di layout/header)
        $adminDetails = Auth::guard('admin')->user();
        
        // Nyalakan lampu active menu 'subadmins' di sidebar
        Session::put('page', 'subadmins'); 

        // Ambil seluruh staf yang memiliki role subadmin dari Oracle
        $subadmins = Admin::where('role', 'subadmin')->get();

        // WAJIB: Kembalikan ke file view Blade, bukan di-return langsung datanya!
        return view('admin.subadmins.subadmins', compact('subadmins', 'adminDetails'));
    }
}