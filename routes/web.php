<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\WhislistController;
use App\Models\Product;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Password;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function PHPUnit\Framework\callback;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('test/{id}', function () {
//     dd('testt');
// });
// Route::get('/home', function () {
//     return view('frontpage/index-template');
// });
// Route::get('program', function () {
//     return view('frontpage/category/category', ['title' => 'Homepage | PBL-SHOP']);
// });
// Route::get('checkouts', function () {
//     return view('frontpage/cart/checkouts', ['title' => 'Homepage | PBL-SHOP']);
// });
// Route::get('cartall', function () {
//     return view('frontpage/cart/cart-all', ['title' => 'Homepage | PBL-SHOP']);
// });




//ORDER-TAMPILAN DI ADMIN-PEMBAYARAN
Route::get('detail-cart/{id}', [OrderController::class, 'index']);
Route::post('/detail-cart', [OrderController::class, 'checkout']);
Route::get('/dashboard/all-order', [OrderController::class, 'allOrder'])->name('manage_order.all');
// Route untuk melakukan filter berdasarkan bulan yang dipilih
Route::get('/manage_order/filter_by_month', [OrderController::class, 'filterByMonth'])->name('manage_order.filter_by_month');
Route::get('/dashboard/order/{order:id}', [OrderController::class, 'detailOrder'])->name('manage_order.detail');
// Route::get('/dashboard/order/{order:id}/update', [OrderController::class, 'updateOrder'])->name('manage_order.update');
Route::get('/update/{order}', [OrderController::class, 'updateOrder'])->name('manage_order.update');
Route::put('/update/{order}', [OrderController::class, 'saveUpdate'])->name('manage_order.save_update');
Route::patch('/dashboard/order/{order:id}', [OrderController::class, 'patchOrder'])->name('manage_order.patch');
// Route::delete('/dashboard/order/{order:id}/delete', [OrderController::class], 'deleteOrder')->name('manage_order.delete');
Route::delete('/delete/{order}', [OrderController::class, 'delete'])->name('manage_order.delete');
Route::get('status_pengiriman/{order}', [OrderController::class, 'status_pengiriman'])->name('status_pengiriman');
Route::get('laporan-order/{tahun}/{bulan}', [OrderController::class, 'cetakLaporanOrder'])->name('cetakLaporanOrder');

//ORDER UNTUK DI TAMPILAN USER ** ORDER UNTUK DI TAMPILAN USER//
Route::get('/frontpage/my-all-order', [OrderController::class, 'myallOrder'])->name('manage_my_order.all');
// Route::delete('/delete/{order}', [OrderController::class, 'softdelete'])->name('manage_my_order.delete');
Route::get('/frontpage/invoice/{order:id}', [OrderController::class, 'invoice'])->name('invoice');
// Route::get('/invoice/{orderId}', [OrderController::class, 'printInvoice'])->name('print.invoice');
Route::get('print/invoice/{id}', [OrderController::class, 'printInvoice'])->name('print.invoice');
Route::post('/orders/{id}/send_invoice', [OrderController::class, 'sendInvoice'])->name('send_invoice');



//WISHLIST
Route::middleware(['auth'])->controller(WhislistController::class)->group(function () {
    Route::get('/whislist', 'whislist')->name('whislist');
    Route::get('/whislist-all', 'allWhislist')->name('allWhislist');
    Route::delete('/manage_whislist/{whislist}', 'deleteWhislist')->name('manage_whislist.delete');
});

//CART-CART_LIST-FORM_CHECKOUT
Route::controller(CartController::class)->group(function () {
    Route::get('/cartlist', 'cart')->name('cartlist');
    Route::get('/cartall', 'cartall')->name('cartall');
    Route::get('/product/{product:product_code}', 'show')->name('product-detail');
    // Route::post('/detail-cart{product:product_id}', 'checkout');
    // Route::delete('/frontpage/cart/{cart:id}/delete', 'deleteCart')->name('manage_cart.delete');
    Route::delete('/manage_cart/{cart}', 'deleteCart')->name('manage_cart.delete');
    Route::get('/cart-qty', 'getCartQty');
    // Route::get('/payment/{product_id}', 'showPaymentForm')->name('payment');
    Route::get('/payment/{id}', 'showPaymentForm')->name('payment');
});


//FUNGSI GENERAL-FRONTPAGE ALUR
Route::controller(GeneralController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::get('/frontpage/product', 'product_all')->name('product.all');
    Route::get('/frontpage/e-commerces', 'ecommerce_cat')->name('ecommerce.cat');
    Route::get('/frontpage/business', 'business_cat')->name('business.cat');
    Route::get('/product/{product:product_code}', 'product_detail')->name('product-detail');
    // Route::get('/thankyou', 'thankyou')->name('thankyou')->middleware('auth');
    // Route::get('/cart', 'cart')->name('cart')->middleware('auth');
    // Route::get('/category', 'category')->name('category');
    // Route::get('/category', 'category')->name('category');
    // Route::get('/brand/{brand:name}', 'brand')->name('brand');
    // Route::get('/quickview/{product:product_code}', 'quickview')->name('quickview');
    // Route::get('/product/{product:product_code}', 'product_all')->name('product-all');
    // Route::match(['GET', 'POST'], '/checkout', 'checkout')->name('checkout')->middleware('auth');
    // Route::post('/execute-order', 'execute_order')->name('execute_order')->middleware('auth');
    // Route::get('/order/{order}', 'order_detail')->name('order_detail')->middleware('auth');
    // Route::get('/blog-detail', 'blog_detail')->name('blog-detail');
    // Route::get('/blog-page', 'blog')->name('blog');
    // Route::get('/order-history', 'order_history')->name('order-history')->middleware('auth');
});

//USER-REGISTER-LOGIN-LOGOUT
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');
Route::get('register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'attemptRegister'])->name('attempt_register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'only_admin']);

// PROSES FORGOT PASSWORD
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request')->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'passwordEmail'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'passwordReset'])->name('password.reset')->middleware('guest');
Route::post('/reset-password', [AuthController::class, 'passwordUpdate'])->name('password.update')->middleware('guest');


//CATEGORY
Route::middleware(['auth', 'only_admin'])->controller(CategoryController::class)->group(function () {
    Route::get('/dashboard/categories', 'allCategory')->name('manage_category.all');
    Route::get('/dashboard/category/create', 'createCategory')->name('manage_category.create');
    Route::post('/dashboard/category/create', 'storeCategory')->name('manage_category.store');
    Route::get('/dashboard/category/{category:id}', 'detailCategory')->name('manage_category.detail');
    Route::get('/dashboard/category/{category:id}/update', 'updateCategory')->name('manage_category.update');
    Route::patch('/dashboard/category/{category:id}', 'patchCategory')->name('manage_category.patch');
    Route::delete('/dashboard/category/{category:id}/delete', 'deleteCategory')->name('manage_category.delete');
});


//PRODUCT
Route::middleware(['auth', 'only_admin'])->controller(ProductController::class)->group(function () {
    // products
    Route::get('/dashboard/products', 'allProduct')->name('manage_product.all')->middleware(['auth', 'only_admin']);
    Route::get('/dashboard/product/create', 'createProduct')->name('manage_product.create');
    Route::post('/dashboard/product/create', 'storeProduct')->name('manage_product.store');
    Route::get('/dashboard/product/{product:product_code}', 'detailProduct')->name('manage_product.detail');
    Route::get('/dashboard/product/{product:product_code}/update', 'updateProduct')->name('manage_product.update');
    Route::patch('/dashboard/product/{product:product_code}', 'patchProduct')->name('manage_product.patch');
    // Route::patch('/dashboard/product/{product:product_code}', 'profile')->name('manage_product.patch');
    Route::delete('/dashboard/product/{product:product_code}', 'deleteProduct')->name('manage_product.delete');
});

//USER-DASHBOARD DI ADMIN
Route::middleware(['auth'])->controller(UsersController::class)->group(function () {
    Route::get('/dashboard/users', 'allUser')->name('manage_user.all');
    // Route::post('/register', 'attemptRegister')->name('attempt_register')->middleware('guest');
    // Route::get('/dashboard/profile/detail/{user:email}', 'detailProfile')->name('profile.detail')->middleware(['auth', 'admin']);
    Route::delete('/dashboard/user/{user:email}', 'deleteUser')->name('manage_user.delete')->middleware(['auth', 'only_admin']);
    Route::delete('/dashboard/user/{user:id}/delete', 'deleteUser')->name('manage_user.delete');

    //ROUTE UNTUK DI DASHBOARD USER [FOLDER MY-ACCOUNT->CONTROLLER USERS]
    Route::get('/my-account', 'my_account')->name('my-account')->middleware('auth');
    Route::get('/dashboard/profile/update/{user:email}', 'updateProfile')->name('profile.update')->middleware(['auth']);
    Route::patch('/dashboard/profile/{user:email}', 'patchProfile')->name('profile.patch')->middleware(['auth']);
    Route::get('/change-password', 'showPassword')->name('change-password')->middleware(['auth']);
    Route::post('/change-password', 'updatePassword')->name('update-password')->middleware(['auth']);
});
