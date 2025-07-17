<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\StoreShow;
use App\Livewire\ProductDetail;
use App\Livewire\ShoppingCart;
use App\Livewire\Order;
use App\Livewire\OrderDetail;
use App\Livewire\Checkout;

Route::get('/', StoreShow::class)->name('home');
Route::get('/product', ProductDetail::class)->name('product.detail');
Route::get('/cart', ShoppingCart::class)->name('shopping.cart');
Route::get('/order', Order::class)->name('order');
Route::get('/orderdetail', OrderDetail::class)->name('order.detail');
Route::get('/checkout', Checkout::class)->name('checkout');
