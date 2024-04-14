<?php

use App\Http\Controllers\Admin\DashboadController;
use App\Http\Controllers\Site\indexController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('site.index');
// });

Route::get('/',[indexController::class,'openHomePage'])->name('site.home');
Route::get('product/{slug}',[indexController::class,'openProductDetails'])->name('site.product.details');

Route::get('cart',[indexController::class, 'openCartPage'])->name('site.cart');

Route::middleware('auth')->group(function(){
    Route::get('add_to_card',[indexController::class, 'addProductIntoCart'])->name('add.to.cart');
    Route::get('cart/delete/{id}',[indexController::class,'deleteItemFromCart'])->name('delete.cart');
    Route::get('/cart/quantity/update',[indexController::class,'updateCartQuantity'])->name('cart.quantity.update');
    Route::get('/cart/items/total_amount',[indexController::class,'calculateTotalItemsAmount'])->name('cart.items.total_amount');
    Route::get('checkout',[indexController::class, 'openCheckoutPage'])->name('site.checkout');   
    Route::post('charge',[indexController::class,'chargeCustomer'])->name('charge');

    Route::get('success',[indexController::class, 'openSuccessPage'])->name('success');
    Route::get('error', [indexController::class, 'openErrorPage'])->name('error');
} );


Route::get('calculate/cart-items',[indexController::class,'calculateCartItems'])->name('calculate.add_to_cart');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

// Route::view('success','site.success')->name('success');
// Route::view('cancel','site.cancel')->name('cancel');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

Route::get('admin/dashboard',[DashboadController::class,'dashboard'])->name('admin.dashboard');
Route::get('admin/profile',[DashboadController::class,'profile'])->name('admin.profile');