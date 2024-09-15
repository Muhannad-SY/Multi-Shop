<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('categories',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::post('delete/one/product/{image}',[ProductController::class,'destroyOneImage'])->name('delete.one.product');
    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('/order/{order}',[OrderController::class,'show'])->name('order.show');
});


// Verification customer route
Route::get('/email/verify', function () {

    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Email verification request route
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//To resend verification requests to the user route
use Illuminate\Http\Request;

Route::post('/email/verification-notification', function (Request $r) {

    $r->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent ');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');