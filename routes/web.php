<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [ProductController::class, 'show']);
Route::get('/product', [ProductController::class, 'show']);
Route::get('/order/create', [OrderController::class, 'create']);
Route::post('/order', [OrderController::class, 'store'])->middleware('auth.customer');
