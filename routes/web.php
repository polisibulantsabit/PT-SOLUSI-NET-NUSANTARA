<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::post('/kontak', [PageController::class, 'submitContact'])->name('contact.submit');

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::post('/produk/{product}/langganan', [ProductController::class, 'subscribe'])->name('products.subscribe')->middleware('auth');

Route::get('/galeri', [GalleryController::class, 'index'])->name('galleries.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/langganan', [AuthController::class, 'createSubscription'])->name('subscriptions.create');
});
