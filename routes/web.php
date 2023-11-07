<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\PageController;

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

Route::get('locale/{locale}', 'App\Http\Controllers\MainController@changeLocale')->name('locale');
Route::get('currency/{currencyCode}', 'App\Http\Controllers\MainController@changeCurrency')->name('currency');
Route::get('/logout', 'App\Http\Controllers\ProfileController@logout')->name('get-logout');


Route::middleware('set_locale')->group(function(){
    Route::middleware('auth')->group(function()
    {
        Route::group([
            "prefix" => "person",
            "as" => "person.",
        ], function ()
        {
            Route::get('/orders', [\App\Http\Controllers\Person\OrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{order}',
                [\App\Http\Controllers\Person\OrderController::class, 'show'])->name('orders.show');
        });

        Route::group([
            "prefix" => "admin"
        ], function ()
        {
            Route::group(["middleware" => "is_admin"], function ()
            {
                Route::get('/dashboard',
                    [App\Http\Controllers\Admin\OrderController::class, 'dashboard'])->name('dashboard');
                Route::resource("orders", "App\Http\Controllers\Admin\OrderController");
                Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
                Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
                Route::resource('products/{product}/skus', 'App\Http\Controllers\Admin\SkuController');
                Route::resource("contacts", "App\Http\Controllers\Admin\ContactController");
                Route::resource("pages", "App\Http\Controllers\Admin\PageController");
                Route::resource("properties", "App\Http\Controllers\Admin\PropertyController");
                Route::resource("coupons", "App\Http\Controllers\Admin\CouponController");
                Route::resource("properties/{property}/property-options", "App\Http\Controllers\Admin\PropertyOptionController");
                Route::resource("sliders", "App\Http\Controllers\Admin\SliderController");
                Route::resource("reviews", "App\Http\Controllers\Admin\ReviewController");
            });
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//        Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
//        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
//        Route::resource('contacts', 'App\Http\Controllers\Admin\ContactController');
//        Route::resource('pages', 'App\Http\Controllers\Admin\PageController');
//        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';


    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('/catalog', [MainController::class, 'catalog'])->name('catalog');
    Route::get('/categories', [MainController::class, 'categories'])->name('categories');
    Route::get('/delivery', [PageController::class, 'delivery'])->name('delivery');
    Route::get('/payment', [PageController::class, 'payment'])->name('payment');
    Route::get('/refund', [PageController::class, 'refund'])->name('refund');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contactspage', [PageController::class, 'contacts'])->name('contactspage');
    Route::get('/cooperation', [PageController::class, 'cooperation'])->name('cooperation');
    Route::get('/where', [PageController::class, 'where'])->name('where');
    Route::get('/policy', [PageController::class, 'policy'])->name('policy');
    Route::get('/reviews', [PageController::class, 'reviews'])->name('reviews');
    Route::post('/subscription/{skus}', [MainController::class, 'subscribe'])->name('subscription');
    Route::get('/search', [MainController::class, 'search'])->name('search');

    Route::group([], function (){
        Route::post('/basket/add/{skus?}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
        Route::get('/basket/reset', 'App\Http\Controllers\BasketController@resetBasket')->name('basket-reset');
        Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
        Route::post('/wishlist/add/{skus?}', 'App\Http\Controllers\WishlistController@wishlistAdd')->name('wishlist-add');
        Route::post('/wishlist/remove/{skus}', 'App\Http\Controllers\WishlistController@wishlistRemove')->name('wishlist-remove');
        Route::get('/wishlist/reset', 'App\Http\Controllers\WishlistController@resetWishlist')->name('wishlist-reset');
        Route::group(['middleware' => 'basket_not_empty'], function (){
            Route::get('/basket', [BasketController::class, 'basket'])->name('basket');
            Route::get('/order', [BasketController::class, 'order'])->name('order');
            Route::post('/order/confirm', [BasketController::class, 'orderConfirm'])->name('order-confirm');
            Route::post('/basket/remove/{skus}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
            Route::post('/basket/coupon', 'App\Http\Controllers\BasketController@setCoupon')->name('set-coupon');
        });
    });

    Route::get('/{category}', [MainController::class, 'category'])->name('category');
    Route::get('/{category}/{product}/{skus}', [MainController::class, 'sku'])->name('sku');

});

