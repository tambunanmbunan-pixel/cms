<?php

namespace App\Services\Admin;
use App\Models\ProductCategory;
use App\Models\AdminsRole;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function getAllCategories()
    {
       $categories = Category::all();
       $admin = Auth::guard('admin')->user();
       $status = "success";
       $message = "";
       $categoriesModule = [];
    

    // Admin has full acces
    if($admin->role =="admin"){
        $categoriesModule = [
            'view_access'=>1,
            'edit_access'=>1,
            'full_access'=>1
        ];
    }else{
        $categoriesModuleCount = AdminsRole::where(['admin_id'=>$admin->id,'module'=>'products_categories'])->count();
        if($productCategoriesModuleCount==0){
            $status = "error";
            $message = "You don't have access to this module";
        }else{
            $categoriesModule = AdminsRole::where(['admin_id'=>$admin->id,'module'=>'products_categories'])->first()->toArray();
        }
    }
        return [
            'status'=>$status,
            'message'=>$message,
            'categories'=>$categories,
            'categoriesModule'=>$categoriesModule
        ];
    }
}