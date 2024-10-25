<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboadController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth2\AuthController2;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Project2\FrontController;
use App\Http\Controllers\Project2\ShopController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Project 2 Fron Route
Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('front.shop');
Route::get('/product2/{slug}',[ShopController::class,'product'])->name('front.product');
Route::get('/cart2',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');   // add to card items
Route::post('/update-cart',[CartController::class,'updateCart'])->name('front.updateCart'); //update card items
// Route for removing item from cart
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('front.removeFromCart');

Route::post('/delete-item',[CartController::class,'deleteItem'])->name('front.deleteItem.cart'); //Delete card items from cart
Route::get('/checkout2',[CartController::class,'checkout'])->name('front.checkout');//Project 2 checkout route
Route::post('/process-checkout2',[CartController::class,'processCheckout'])->name('front.processCheckout');

Route::get('/thankyou/{orderId}',[CartController::class,'thankyoupage'])->name('front.thankyou');//Project 2 
//applyDiscount Route
Route::post('/apply-discount',[CartController::class,'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount',[CartController::class,'removeCoupon'])->name('front.removeCoupon');
Route::post('/add_To_Wishlist',[FrontController::class,'add_To_Wishlist'])->name('front.add_To_Wishlist');

Route::get('/page/{slug}',[FrontController::class,'page'])->name('front.page');
Route::post('/send-contact-email',[FrontController::class,'sendContactEmail'])->name('front.sendContactEmail');
// AdminLoginCongroller
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboadController::class, 'dashboard'])->name('admin.dashboard')->middleware('exclude.admin');
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');
        // Route::get('admin/dashboard', [DashboadController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('admin/profile', [DashboadController::class, 'profile'])->name('admin.profile');
        
        //Category Routes  Project2
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
       //edit Category route  Project2
        Route::get('/categories/{Category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        
        Route::put('/categories/{Category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{Category}', [CategoryController::class, 'destroy'])->name('categories.delete');
       
        
        //temp-images.create   Project2
        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');
        Route::delete('/temp-images/{id}', [TempImagesController::class, 'destroy'])->name('temp-images.destroy');
          Route::get('/getSlug', function(Request $request){
            $slug='';
    
            if(! empty($request->title) ){
            $slug  =  Str::slug($request->title);
            } 
            return response()->json([
                    'status'    => true,
                    'slug'      => $slug
                ]);
          })->name('getSlug');
    
     //Sub Category Routes  Project2
     Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');
     Route::get('/sub-categories/create',[SubCategoryController::class,'create'])->name('sub-categories.create');
     Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        //edit subCategory route  Project2
    Route::get('/sub-categories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
    Route::put('/sub-categories/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update');  
    //delete subCategory route//edit subCategory route < Project2 >
    Route::delete('/sub-categories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.delete'); 
    
    //Brands Routes< Project2 >
    
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');  
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brands.delete'); 
    
    // Project2 => Products2 Routes 
    Route::get('/products',[ProductController::class,'index'])->name('products.index'); //go to products listing page
    Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
    Route::get('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories.index');
    Route::post('/products2', [ProductController::class, 'store'])->name('products2.store');
    Route::get('/products2/{id}/edit', [ProductController::class, 'edit'])->name('products2.edit');
    Route::put('/products3/{id}', [ProductController::class, 'update'])->name('products2.update'); 
    Route::get('/get-products', [ProductController::class, 'getProducts'])->name('products2.getProducts'); 
    
    Route::get('/ratings',[ProductController::class,'productRatings'])->name('product.productRatings');
    Route::get('/change-rating-status',[ProductController::class,'changeRatingStatus'])->name('product.changeRatingStatus');
    Route::delete('/delete-rating/{ratingId}', [ProductController::class, 'rating_destroy'])->name('rating.delete');

    Route::get('/shipping/create',[ShippingController::class,'create'])->name('shipping.create'); //Project 2: shipping Charges route
    Route::post('/shipping',[ShippingController::class,'store'])->name('shipping.store');
    Route::get('/shipping/{id}',[ShippingController::class,'edit'])->name('shipping.edit'); 
    Route::put('/shipping/{id}',[ShippingController::class,'update'])->name('shipping.update'); 
    Route::delete('/shipping/{id}',[ShippingController::class,'destroy'])->name('shipping.delete'); 
    
    Route::post('/products2-images/update', [ProductImageController::class, 'update'])->name('products2-images.update');
    //image delete from edite page
    Route::delete('/products2-images', [ProductImageController::class, 'destroy'])->name('products2-images.destroy');
    // product delete form list
    Route::delete('/products2/{product}',[ProductController::class,'destroy'])->name('products2.delete');
    
    // Project 2 : Order Route
    Route::get('/orders',[OrderController::class,'index'])->name('order.index');
    Route::get('/orders/{id}',[OrderController::class,'detail'])->name('order.detail');
    Route::post('/order/change-status/{id}',[OrderController::class,'changeOrderStatus'])->name('order.changeOrderStatus');
    Route::post('/order/send-invoice-email/{id}',[OrderController::class,'sendInvoiceEmail'])->name('order.sendInvoiceEmail');
    
    // Discount Coupon Related routes 
    Route::get('/coupons',[DiscountCodeController::class,'index'])->name('coupons.index');
    Route::get('/coupons/create',[DiscountCodeController::class,'create'])->name('coupons.create');
    Route::post('/coupons',[DiscountCodeController::class,'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit',[DiscountCodeController::class,'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}',[DiscountCodeController::class,'update'])->name('coupons.update');
    Route::delete('/coupons/delete/{id}', [DiscountCodeController::class, 'destroy'])->name('coupons.delete');
    
    // User Route(Project2) : Admin Can create edit, delete, update those
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    Route::get('/users/create',[UserController::class,'create'])->name('users.create');
    Route::post('/users',[UserController::class,'store'])->name('users.store');
    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
    Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.delete');
    
    // Route for Pages(Project2)
    Route::get('/pages',[PageController::class,'index'])->name('pages.index');
    Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
    Route::post('/pages',[PageController::class,'store'])->name('pages.store');
    Route::get('/pages/{page}/edit',[PageController::class,'edit'])->name('pages.edit');
    Route::put('/pages/{page}',[PageController::class,'update'])->name('pages.update');
    Route::delete('/pages/{page}',[PageController::class,'destroy'])->name('pages.delete');

    
    });
});

//account related route in project 2
//user can reset th
Route::get('/forgot-password',[AuthController2::class,'forgatePassword'])->name('front.forgatePassword');
Route::post('/process-forgot-password',[AuthController2::class,'processForgatePassword'])->name('front.processForgatePassword');
Route::get('/reset-password/{token}',[AuthController2::class,'resetPassword'])->name('front.resetPassword');
Route::post('/prcess-reset-password',[AuthController2::class,'processResetPassword'])->name('front.processResetPassword');
Route::post('/save-rating/{productId}',[ShopController::class,'saveRating'])->name('front.saveRating');

Route::group(['prefix' => 'account'],function(){
    Route::group(['middleware' => 'guest'],function(){
        Route::get('/register2',[AuthController2::class,'register'])->name('account.register');
        Route::post('/process-register',[AuthController2::class,'processRegister'])->name('account.processRegister');
        Route::get('/login2',[AuthController2::class,'login'])->name('account.login');
        Route::post('/login2',[AuthController2::class,'authenticate'])->name('account.authenticate');
    });
    Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    // Route::group(['middleware' => 'auth'],function(){
        Route::get('/profile2',[AuthController2::class,'profile'])->name('account.profile'); //user Athencate profile p2
        Route::post('/update-profile',[AuthController2::class,'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address',[AuthController2::class,'updateAddress'])->name('account.updateAddress');
        Route::get('/logout2',[AuthController2::class,'logout'])->name('account.logout');
        Route::post('/get-order-summery',[CartController::class,'getOrderSummery'])->name('front.getOrderSummery');
        Route::get('/my-orders',[AuthController2::class,'orders'])->name('account.orders'); 
        Route::get('/my-wishlist',[AuthController2::class,'wishlist'])->name('account.wishlist'); 
        Route::post('/remove-product-from-wishlist',[AuthController2::class,'remove_Wishlist_Product'])->name('account.remove_Wishlist_Product'); 
        Route::get('/order-detail/{orderId}',[AuthController2::class,'orderDetail'])->name('account.orderDetail'); 
        //Project2: password Change route
        Route::get('/change-password',[AuthController2::class, 'showChange_PasswordForm'])->name('account.changePassword');
        Route::post('/process-change-password',[AuthController2::class,'changePassword'])->name('account.processChangePassword');
    
    });
} );

// end Project 2 front Fron Route 