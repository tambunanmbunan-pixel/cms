<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProductBundleController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CartAnalyticController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\front\FrontShopController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminDashboardController;









// =========================================================
// RUTE PUBLIK KONSUMEN (TANPA PROTEKSI CACHE)
// =========================================================
Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('front.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/shop', [FrontShopController::class, 'index'])->name('front.shop');
Route::get('/shop/product/{slug}', [FrontShopController::class, 'detail'])->name('front.shop.detail');
Route::get('/bundles', [FrontShopController::class, 'bundles'])->name('front.bundles');
Route::get('/bundles/{slug}', [FrontShopController::class, 'bundleDetail'])->name('front.bundles.detail');
Route::get('/about', [App\Http\Controllers\Front\AboutController::class, 'index'])->name('front.about');
Route::get('/journal', [BlogController::class, 'index'])->name('front.blog.index');
Route::get('/journal/{slug}', [BlogController::class, 'show'])->name('front.blog.show');
Route::get('/contact', [ContactController::class, 'index'])->name('front.contact');
Route::get('/api/global-search', [SearchController::class, 'search'])->name('api.search');


// =========================================================
// RUTE KONSUMEN TERPROTEKSI MIDDLEWARE (ANTI-BACK HISTORY)
// =========================================================
Route::middleware(['prevent-back'])->group(function () {
    Route::get('/', [FrontController::class, 'home'])->name('front.home');
    // Rute untuk halaman utama Toko/Shop (Front)
    Route::get('/shop', [FrontShopController::class, 'index'])->name('front.shop');

    // Rute opsional jika Anda memiliki halaman detail produk
    Route::get('/shop/product/{slug}', [FrontShopController::class, 'detail'])->name('front.shop.detail');
    Route::get('/product/{id}', [FrontController::class, 'productDetail'])->name('front.product_detail');

    // JALUR PROTEKSI UTAMA AKUN CUSTOMER
    Route::middleware('auth:customer')->group(function () {
        Route::get('/profile', [CustomerController::class, 'profile'])->name('front.profile');
        Route::put('/profile/update', [AuthController::class, 'profileUpdate'])->name('front.profile.update');

        // Alamat
        Route::get('/profile/address/create', [CustomerController::class, 'createAddress'])->name('front.address.create');
        Route::post('/profile/address/store', [CustomerController::class, 'storeAddress'])->name('front.address.store');
        Route::get('/profile/address/{address}', [CustomerController::class, 'showAddress'])->name('front.address.show');
        Route::get('/profile/address/{address}/edit', [CustomerController::class, 'editAddress'])->name('front.address.edit');
        Route::put('/profile/address/{address}', [CustomerController::class, 'updateAddress'])->name('front.address.update');
        Route::delete('/profile/address/{address}', [CustomerController::class, 'destroyAddress'])->name('front.address.destroy');
        

        Route::middleware(['prevent-back', 'auth:customer'])->group(function () {
            Route::post('/transaction/buy-now', [OrderController::class, 'buyNowStore'])->name('front.transaction.buy_now');
            Route::get('/transaction/checkout/{order_id}/create', [OrderController::class, 'createTransaction'])->name('front.transaction.create');
            Route::post('/transaction/checkout/{order_id}/store', [OrderController::class, 'storeTransaction'])->name('front.transaction.store');
            
            // SATU RUTE RESMI: Mengarah langsung ke fungsi sukses awaiting payment
            Route::get('/transaction/awaiting-payment/{id}', [OrderController::class, 'checkoutSuccess'])->name('front.transaction.awaiting_payment');
            Route::post('/transaction/awaiting-payment/{id}/simulate-pay', [OrderController::class, 'confirmPaymentSimulator'])->name('front.transaction.simulate_pay');
            // Pembayaran & Riwayat Tagihan (Sudah Aktif)
            Route::get('/payments', [OrderController::class, 'indexPayment'])->name('front.payment.index');
            Route::get('/checkout/payment/{order_id}/create', [OrderController::class, 'createPayment'])->name('front.payment.create');
            Route::post('/checkout/payment/{id}/simulate-pay-profile', [OrderController::class, 'confirmPaymentFromProfile'])->name('front.payment.simulate_profile_pay');
            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
            // cart
            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
            Route::post('/cart', [CartController::class, 'store'])->name('front.cart.store');
            Route::patch('/cart/{id}/quantity', [CartController::class, 'updateQuantity'])->name('front.quantity');
            Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('front.destroy');
            Route::get('/api/cart-count', [CartController::class, 'getCartCount'])->name('api.cart.count');

            // contact
            Route::post('/contact', [ContactController::class, 'store'])->name('front.contact.store');
            });
    });
   
}); // <-- Penutup prevent-back diletakkan di sini


// =========================================================
// JARING PENGAMAN GLOBAL LARAVEL
// =========================================================
Route::get('login', function () {
    return redirect()->route('auth'); // <-- FIX: Mengarah ke halaman auth customer
})->name('login');


// =========================================================
// GRUP RUTE MANAJEMEN ADMIN (CMS BACKEND)
// =========================================================
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminController::class, 'store'])->name('admin.login.request');

     Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');
        
        // Sub-Admin
        Route::get('subadmins', [AdminController::class, 'subadmin'])->name('admin.subadmins');
        Route::post('update-subadmin-status', [AdminController::class, 'updateStatus'])->name('admin.update-subadmin-status');
        
        Route::get('add-edit-subadmin', [AdminController::class, 'addEditSubadmin'])->name('admin.add-edit-subadmin');
        Route::post('save-subadmin', [AdminController::class, 'saveSubadmin'])->name('admin.save-subadmin');
        Route::get('subadmins/show/{id}', [AdminController::class, 'showSubadmin'])->name('admin.show-subadmin');
        Route::get('subadmins/edit/{id}', [AdminController::class, 'editSubadmin'])->name('admin.edit-subadmin');
        Route::post('update-subadmin/{id}', [AdminController::class, 'updateSubadmin'])->name('admin.update-subadmin');

        // Rute manual untuk Inventory
        Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('inventory/{product}', [InventoryController::class, 'show'])->name('inventory.show');
        Route::get('inventory/{product}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::put('inventory/{product}', [InventoryController::class, 'update'])->name('inventory.update');

        // Rute manual untuk Bundles
        Route::get('bundles', [FrontShopController::class, 'index'])->name('bundles.index');
        Route::get('bundles/{id}/edit', [FrontShopController::class, 'edit'])->name('bundles.edit');
        Route::put('bundles/{id}', [FrontShopController::class, 'update'])->name('bundles.update');

        // Payments
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
        Route::get('payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::put('payments/{id}', [PaymentController::class, 'update'])->name('payments.update');



        // Resources
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('bundles', ProductBundleController::class);
        Route::resource('shippings', ShippingController::class);
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('blogs', BlogsController::class);
        Route::resource('orders', OrderAdminController::class);
        Route::resource('contacts', AdminContactController::class);
        Route::resource('inventory', InventoryController::class);
        Route::resource('payments', PaymentController::class);;
        Route::resource('carts', CartAnalyticController::class);;
        // Tambahkan route khusus jika ingin menambah channel ke method tertentu
        Route::post('payments/add-channel', [PaymentController::class, 'storeChannel'])->name('admin.payments.store_channel');
            

        Route::post('contacts/{id}/reply', [ContactMessageController::class, 'reply'])->name('admin.contacts.reply');

        // Utilities
        Route::get('update-password', [AdminController::class, 'edit'])->name('admin.update-password');
        Route::post('verify-current-pwd', [AdminController::class, 'verifyPassword'])->name('admin.verify.password');
        Route::post('update-password', [AdminController::class, 'updatePassword'])->name('admin.update-password.request');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});