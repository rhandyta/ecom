<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('collections', [FrontendController::class, 'categories'])->name('categories');
Route::get('collections/{category:slug}', [FrontendController::class, 'products'])->name('categories.slug');
Route::get('collections/{category:slug}/{product:slug}', [FrontendController::class, 'productView'])->name('productView.slug');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('orders', [OrderController::class, 'index'])->name('order');
    Route::get('order/{order:id}', [OrderController::class, 'show'])->name('order.show');
});

Route::get('thank-you', [FrontendController::class, 'thankyou'])->name('thank-you');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'isAdmin']
], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('category', CategoryController::class);

    Route::get('brand', App\Http\Livewire\Admin\Brand\Index::class)->name('brand.index');

    Route::resource('product', ProductController::class);
    Route::get('product/product-image/{id}/delete', [ProductController::class, 'destroyImage'])->name('product.destroyImage');
    Route::post('product/product-color/{prodColorId}', [ProductController::class, 'updateProdColorQuantity'])->name('product.colorUpdate');
    Route::get('product/product-deletecolor/{prodColorId}', [ProductController::class, 'destroyProdColorQuantity'])->name('product.colorDestroy');

    Route::resource('color', ColorController::class);

    Route::resource('slider', SliderController::class);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders');
    Route::get('orders/{order:id}', [AdminOrderController::class, 'show'])->name('admin.showorders');
    Route::put('orders/{order:id}', [AdminOrderController::class, 'update'])->name('admin.updateorders');
});
