<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\BookingController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});
Route::get('/users', [UserController::class, 'users']);
Route::get('/discount/create', [DiscountController::class, 'showCreateForm'])->name('discount.create');
Route::post('/discount/store', [DiscountController::class, 'store'])->name('discount.store');
Route::get('/discount/apply', [DiscountController::class, 'showApplyForm'])->name('discount.applyForm');
Route::post('/discount/apply', [DiscountController::class, 'applyDiscount'])->name('discount.apply');
Route::get('/booking', [BookingController::class, 'showBookingPage'])->name('booking.page');
Route::post('/booking/apply-discount', [BookingController::class, 'applyDiscount'])->name('booking.applyDiscount');
require __DIR__.'/auth.php';
