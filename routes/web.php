<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ProductController;
use  App\Http\Controllers\CartController;
use  App\Http\Controllers\shippingAddressController;
use  App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('web.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('web.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class,'index'])->name('cart.show');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart', [CartController::class, 'store']);
    Route::post('/checkout', [CartController::class, 'showCheckout'])->name('checkout');
    Route::post('/edit-address',[shippingAddressController::class, 'editAddress'])->name('editAddress');
    Route::get('/address', [shippingAddressController::class, 'addressForm'])->name('address');
    Route::post('/payment', [PaymentController::class, 'create']);
    Route::get('/transaction', [PaymentController::class, 'transactionShow'])->name('transaction.show');
    Route::post('/checkout/process', [PaymentController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/single-item', [CartController::class, 'showSingleItemCheckout'])->name('checkout.singleItem');
    Route::post('/payment', [PaymentController::class, 'paymentShow'])->name('payment.show');
    Route::post('/payment/update-status', [PaymentController::class, 'updateStatus'])->name('payment.updateStatus');
    Route::post('/payment/mark-as-complete', [PaymentController::class, 'markAsComplete'])->name('payment.markAsComplete');
    Route::post('/delete-cart',[CartController::class, 'deleteCart']);
    Route::post('/delete-transaction',[PaymentController::class, 'deleteTransaction'])->name('delete.transaction');
    });
require __DIR__.'/auth.php';
Route::get('/product', [ProductController::class, 'show'])->name('product');
Route::get('/products/{kategori}', [ProductController::class, 'filterByCategory'])->name('products.filter');

