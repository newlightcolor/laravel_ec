<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Models\Product;
use App\Services\Form\OrderForm;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/product', function (Request $request) {
    return Product::first();
});
Route::get('/order_form', function (Request $request) {
    $OrderForm = new OrderForm($request);
    return response()->json(['options'=>$OrderForm->default()]);
});
Route::post('/order', [Api\OrderController::class, 'store'])->middleware('auth.customer');
Route::post('/test', function() {
    return response()->json(['message' => '注文が完了しました。']);
});
