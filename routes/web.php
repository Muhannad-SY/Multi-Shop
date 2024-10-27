<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
    return redirect()->route('home');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/all' , [ProductController::class , 'shop'])->name('products.shop');
Route::get('/product/fillter/all' , [ProductController::class , 'filter'])->name('products.price.filter.shop');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/category/show/{category}' , [CategoryController::class , 'show'])->name('category.show');
Route::get('/categories/shop' , [CategoryController::class , 'shopCategories'])->name('category.shop');
Route::get('/category/fillter/{category}' , [CategoryController::class , 'filterd'])->name('category.show.filter');
Route::get('/product/show/{prod}' , [ProductController::class , 'show'])->name('product.details');
Route::get('/cart' , [CartController::class , 'index'])->name('cart.index');
Route::get('/edit/cart/product/count' , [CartController::class , 'editProductCountInCart'])->name('cart.edit.count');
Route::get('/apply/coupon' , [CouponController::class , 'applyCoupon'] )->name('apply.coupon');

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('categories',CategoryController::class);
    Route::resource('coupon',CouponController::class);
    Route::get('/all/review',[ReviewController::class , 'index'])->name('review.index');
    Route::get('/panding/review',[ReviewController::class , 'panding'])->name('review.panding');
    Route::put('/accept/panding/review/{id}',[ReviewController::class , 'accept'])->name('review.accept');
    Route::delete('/delete/panding/review/{id}',[ReviewController::class , 'delete'])->name('review.delete');
    Route::post('/edit/category/status/{category}' , [CategoryController::class , 'setStatus'])->name('category.status');
    Route::post('/edit/product/status/{product}' , [ProductController::class , 'setStatus'])->name('product.status');
    Route::resource('product',ProductController::class);
    Route::post('delete/one/product/{image}',[ProductController::class,'destroyOneImage'])->name('delete.one.product');
    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('/order/{order}',[OrderController::class,'show'])->name('order.show');
});


Route::middleware(['auth','role:customer'])->group(function () {
    Route::resource('address' , AddressController::class );
    Route::post('/make/address/def/{address}' , [AddressController::class , 'editDefLocation'] )->name('make.address.default');
    Route::resource('/checkout' , CheckoutController::class );
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