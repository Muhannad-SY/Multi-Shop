<?php

use App\Http\Controllers\CategoryController;
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


Route::get('/category/show/{category}' , [CategoryController::class , 'show'])->name('category.show');
Route::middleware(['auth','role:customer'])->group(function () {
    
});
// route to make a cokie for the product ( add to cart fucntion )
// Route::get('/add_product_to_cart' , function (){
//      Cookie::make('id' , '1005' , 0.5);
//      $cookie = Cookie::get('id');
//     var_dump( json_decode($cookie)) ;
// })->name('cookie.new');


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