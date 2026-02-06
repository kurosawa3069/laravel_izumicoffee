<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/company', [HomeController::class, 'company'])->name('company');
Route::get('/oem', [HomeController::class, 'oem'])->name('oem');
Route::get('/information', [HomeController::class, 'information'])->name('information');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/information', [InformationController::class, 'index'])->name('information.index');
Route::get('/information/create', [InformationController::class, 'create'])->name('information.create');
Route::post('/information', [InformationController::class, 'store'])->name('information.store');
Route::get('/information/{id}', [InformationController::class, 'show'])->name('information.show');
Route::get('/information/{id}/edit', [InformationController::class, 'edit'])->name('information.edit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__.'/auth.php';
