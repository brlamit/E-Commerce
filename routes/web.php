<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Public Routes (No authentication required)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'ShopPage'])->name('user.shop');
Route::get('/contact', [HomeController::class, 'ContactPage'])->name('user.contact');
Route::get('/product_details/{id}', [HomeController::class, 'ProductDetails'])->name('user.product_details');
Route::get('/search-a-product', [HomeController::class, 'SearchProduct'])->name('user.search_product');
Route::get('/technology-news', [HomeController::class, 'GetTechnologyNews'])->name('news');

// Authenticated User Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'Home'])->name('home');
    Route::get('/my-account', [HomeController::class, 'UserAccount'])->name('user.account');
    Route::get('/user/logout', [HomeController::class, 'UserLogout'])->name('user.logout');
    Route::get('/my-cart', [HomeController::class, 'CartPage'])->name('user.cart');
    Route::post('/add-to-cart/{id}', [HomeController::class, 'AddToCart'])->name('user.add_to_cart');
    Route::get('/remove-product-from-cart/{id}', [HomeController::class, 'RemoveProductFromCart'])->name('user.remove_from_cart');
    Route::get('/clear-cart', [HomeController::class, 'ClearCart'])->name('user.clear_cart');
    Route::get('/checkout', [HomeController::class, 'Checkout'])->name('user.checkout');
    Route::get('/orders', [HomeController::class, 'UserOrders'])->name('user.orders');
    Route::get('/order-received/{id}', [HomeController::class, 'OrderReceived'])->name('user.order_received');
    Route::get('/cancel-order/{id}', [HomeController::class, 'CancelOrder'])->name('user.cancel_order');
    Route::get('/update-password', [HomeController::class, 'UpdatePassword'])->name('user.update_password');
    Route::get('/cash-order', [HomeController::class, 'CashOrder'])->name('user.cash_order');
    Route::get('/stripe/{totalPrice}', [HomeController::class, 'Stripe'])->name('user.stripe');
    Route::post('/stripe/{totalPrice}', [HomeController::class, 'StripePost'])->name('stripe.post');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->group(function () {
    Route::get('/view_category', [AdminController::class, 'ViewCategory'])->name('admin.category');
    Route::post('/add_category', [AdminController::class, 'AddCategory'])->name('admin.add_category');
    Route::get('/delete_category/{id}', [AdminController::class, 'DeleteCategory'])->name('admin.delete_category');
    Route::get('/view_product', [AdminController::class, 'ViewProduct'])->name('admin.view_product');
    Route::get('/add_product', [AdminController::class, 'AddProduct'])->name('admin.add_product');
    Route::post('/add_product', [AdminController::class, 'AddProductPost'])->name('admin.add_product_post');
    Route::get('/show_product', [AdminController::class, 'ShowProduct'])->name('admin.show_product');
    Route::get('/delete_product/{id}', [AdminController::class, 'DeleteProduct'])->name('admin.delete_product');
    Route::get('/edit_product/{id}', [AdminController::class, 'EditProduct'])->name('admin.edit_product');
    Route::post('/update_product/{id}', [AdminController::class, 'UpdateProduct'])->name('admin.update_product');
    Route::get('/search-product', [AdminController::class, 'SearchProduct'])->name('admin.search_product');
    Route::get('/search-order', [AdminController::class, 'SearchOrder'])->name('admin.search_order');
    Route::get('/user-orders', [AdminController::class, 'UserOrders'])->name('admin.user_orders');
    Route::get('/update-order/{user_id}/{order_id}/{delivery_status}', [AdminController::class, 'UpdateOrder'])->name('admin.update_order');
    Route::get('/print-bill/{order_id}', [AdminController::class, 'PrintBill'])->name('admin.print_bill');
    Route::get('/customers', [AdminController::class, 'Customers'])->name('admin.customers');
    Route::get('/delete-user/{id}', [AdminController::class, 'DeleteUser'])->name('admin.delete_user');
    Route::get('/search-user', [AdminController::class, 'SearchUser'])->name('admin.search_user');
});