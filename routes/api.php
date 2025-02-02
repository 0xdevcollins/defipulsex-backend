<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\PlanController;
use App\Http\Controllers\API\TradeController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {

    //wallets
    Route::post('/wallets', [WalletController::class, 'create']);
    Route::get('/wallets', [WalletController::class, 'listWallets']);

    //users
    Route::get('/user', [UserController::class, 'show']);

    //transaction
    Route::get('/transactions', [TransactionController::class, 'index']);

    //Trades
    Route::get('/trades', [TradeController::class, 'index']);
    Route::get('/trades/active', [TradeController::class, 'active']);

    //Dashboard

    Route::get('/dashboard', [DashboardController::class, 'index']);

});
//plans
Route::get('/plans', [PlanController::class, 'index']);

