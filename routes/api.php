<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//buyers
Route::apiResource('buyers', BuyerController::class, ['only' => ['index', 'show']]);

//categories
Route::apiResource('categories', CategoryController::class);

//products
Route::apiResource('products', ProductController::class, ['only' => ['index', 'show']]);

//sellers
Route::apiResource('sellers', SellerController::class, ['only' => ['index', 'show']]);

//transaction
Route::apiResource('transactions', TransactionController::class, ['only' => ['index', 'show']]);

Route::apiResource('users', UserController::class);
