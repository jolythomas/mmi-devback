<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowAllCategoriesController;
use App\Http\Controllers\ShowAllProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AddItemController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// })->name('home');

Route::get('/', HomeController::class)->name('home');

Route::get('/categories', ShowAllCategoriesController::class)->name('categories');
Route::get('/categories/{category}', ShowAllCategoriesController::class)->name('categories.show');

Route::get('/products', ShowAllProductsController::class)->name('products');
Route::get('/products/{product}', ShowAllProductsController::class)->name('products.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::patch('/cart/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/add/{product}', AddItemController::class)->name('cart.add');
});
