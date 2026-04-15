<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/',[ProductController::class,'index'])->name('products.index');
Route::get('/products/detail/{id}', [ProductController::class, 'show'])->name('products.show');
Route::patch('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/register', [ProductController::class, 'register'])->name('products.register');
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
