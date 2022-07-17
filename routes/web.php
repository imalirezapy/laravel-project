<?php

use App\Http\Controllers\Admin\ShopController as adminShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\EmailController;
use \App\Http\Controllers\Auth\GoogleAuthController;
Auth::routes(['verify'=>true]);
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name("google.auth");
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);


Route::get('/', [HomeController::class, 'newFoods'])->name("home");
Route::match(['get', 'post'], '/shop',[ShopController::class, 'ShowProducts'])->name("shop");


//=========================== shop ===================================
Route::prefix("shop")->group(function () {
    Route::put("", [ShopController::class, 'AddToCart'])->name('foods');
    Route::get("/{food}", [ShopController::class, 'show'])->name('food.show');
    Route::post("/{food}/comment", [CommentController::class, 'create'])->middleware('auth')->middleware('verified')->name("comment.create");
    Route::delete("/{food}/comment/{comment}", [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::post("/{food}/rate", [CommentController::class, 'rate'])->name('rate');
    Route::post('/favorite/{food}', [ShopController::class, 'favorite'])->name('favorite');
    Route::post('/favorite/{food}/delete', [ShopController::class, 'favorite_delete'])->name('favorite_delete');
    Route::post('/like/{comment}', [CommentController::class, 'like'])->name('like');
});

Route::get('/favorites', [ShopController::class, 'favorites'])->name('favorites.index');
Route::get('/product',fn()=>view('product', ['foods'=>\App\Models\Food::all()]) );

Route::get("/profile", [ProfileController::class, "index"])->name("profile");

Route::get('/mail', fn()=>view("mails.factor"));
Route::get('/nav', fn() => view("text"));


Route::namespace("\App\Http\Controllers")->middleware("auth")->group(function () {
    Route::resource("profile", "ProfileController")->except(['show', 'create']);
    Route::put('/profile/notification/{setting}', [ProfileController::class, 'notification']);
    Route::put('/profile/coupon_notification/{setting}', [ProfileController::class, 'coupon_notification']);
});


//============================cart=====================================
Route::namespace("App\Http\Controllers")->group(function () {
    Route::resource("cart", "CartController")->except(['show']);
//    Route::post("/update", [CartController::class, 'update'])->name('cart.update');

    Route::get("/cart/profile-details", [CartController::class, "profile_details"])->middleware("auth")->name("cart.profile-details");
    Route::match(['get','post'],"/cart/payment", [CartController::class, "payment"])->name("coupon.index");
//    Route::match(['get','post', 'put'],"/cart/payment/so", [CartController::class, "payment"]);
    Route::post("/cart/payment/store", [CartController::class, "create_profile_details"])->middleware("auth")->name("cart.profile-details.create");

//    Route::post('cart/payment/coupon', [CartController::class, 'coupon'])->name('cart.coupon');
    Route::put("/cart/payment/coupon", [CartController::class, "coupon_use"])->name("coupon.use");

});

//========================== factor ===================================
Route::namespace("App\Http\Controllers")->group(function () {
    Route::resource("factor", "FactorController")->except(['show']);
});

//=========================== admin ====================================
Route::prefix("admin")->namespace("\App\Http\Controllers\Admin")->middleware('auth')->middleware("admin")->group(function () {

    //=========================== users ====================================
    Route::get("/users/manage", [UserController::class, "index"])->name('users.index');
    Route::resource("users", "UserController")->except(['show', 'index']);

    //=========================== foods ====================================
    Route::get("/foods/manage", [adminShopController::class, "index"])->name('foods.index');
    Route::resource("foods", "ShopController")->except(['show', 'index']);

    //========================== coupons ===================================
    Route::resource("coupons", "CouponController")->except(['show']);

    //========================== email =====================================
    Route::get('/email/creat', [EmailController::class, 'create'])->name('email.create');
    Route::post('/email/creat', [EmailController::class, 'store'])->name('email.store');


});

//Route::get('/apply-coupon', [\App\Http\Controllers\Admin\CoupnController::class, 'index'])->name('coupon.apply');
Route::get("/nav", fn() => view("text"));


