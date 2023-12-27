<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product', [ProductController::class, 'showAll'])->name('product');
    Route::get('/product/available', [ProductController::class, 'showAllAvailable'])
        ->name('productAvailable');
    Route::post('/product/add', [ProductController::class, 'add'])->name('addProduct');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('showProduct');
    Route::delete('/product', [ProductController::class, 'delete'])->name('deleteProduct');
    Route::put('/product', [ProductController::class, 'update'])->name('updateProduct');
});

require __DIR__.'/auth.php';
