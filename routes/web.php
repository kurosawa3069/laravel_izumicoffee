<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminInformationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ProductListController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('home');
// })->name('home');


// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/company', [HomeController::class, 'company'])->name('company');
Route::get('/oem', [HomeController::class, 'oem'])->name('oem');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');

// お知らせ公開側
Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');

// お知らせ管理側
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/information', [AdminInformationController::class, 'index'])->name('information.index');
    Route::get('/information/create', [AdminInformationController::class, 'create'])->name('information.create');
    Route::post('/information', [AdminInformationController::class, 'store'])->name('information.store');
    Route::get('/information/{information}', [AdminInformationController::class, 'show'])->name('information.show');
    Route::get('/information/{information}/edit', [AdminInformationController::class, 'edit'])->name('information.edit');
    Route::put('/information/{information}', [AdminInformationController::class, 'update'])->name('information.update');
    Route::delete('/information/{information}', [AdminInformationController::class, 'destroy'])->name('information.destroy');
});

// お問い合わせ公開側
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');;
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/complete', [ContactController::class, 'store'])->name('contact.complete');

// お問い合わせ管理側
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}', [AdminContactController::class, 'show'])->name('contact.show');
});

// 商品一覧公開用
Route::get('/product/list', [ProductListController::class, 'index'])->name('products.list');

// オンラインショップ公開用
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');

// オンラインショップ管理用
Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', AdminProductController::class);
});

// 決済処理公開用
Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');

// 決済処理管理用
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
Route::post('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
