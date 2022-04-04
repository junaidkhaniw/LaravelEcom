<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Admin Controllers
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\StripeController;

// Front Controllers
use App\Http\Controllers\Website\WebsiteController;
    
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

/*
|---------------------
| Front Routes
|---------------------
|
*/
Route::get('/', [WebsiteController::class, 'index'])->name('site');

Route::get('/cart', [WebsiteController::class, 'cart'])->name('cart');
Route::get('/addtocart/{product}', [WebsiteController::class, 'addtocart'])->name('addtocart');
Route::get('/update_cart/{id}', [WebsiteController::class, 'update_cart'])->name('update_cart');
Route::get('/remove_all_in_cart', [WebsiteController::class, 'remove_all_in_cart'])->name('remove_all_in_cart');
Route::get('/remove_product_from_cart/{id}', [WebsiteController::class, 'remove_product_from_cart'])->name('remove_product_from_cart');

Route::post('/checkout', [WebsiteController::class, 'checkout'])->name('checkout');
Route::post('/add_customer', [WebsiteController::class, 'add_customer'])->name('add_customer');

/*
|---------------------
| Admin Routes
|---------------------
|
*/
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);

Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

Route::get('/stripe-payment', [StripeController::class, 'handleGet'])->name('stripe');
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');