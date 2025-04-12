<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\TarotController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pick-cards', [TarotController::class,'pickCards']);
Route::post('get-result', [TarotController::class,'getResult']);


// Route::get('test', [TarotController::class,'test']);


Route::get('bank-account/search', [BankAccountController::class,'search']);
Route::get('bank-account/{id}', [BankAccountController::class,'getById']);
Route::delete('bank-account/{id}', [BankAccountController::class,'delete']);
Route::put('bank-account/{id}', [BankAccountController::class,'update']);
Route::post('bank-account/', [BankAccountController::class,'create']);

Route::resource('houses', HouseController::class)->except(['show']);
Route::get('houses/search', [HouseController::class,'search']);

<<<<<<< Updated upstream
Route::get('qr-generate', QrController::class);
=======

Route::post('buy-cards', [TarotController::class,'buy']);
Route::get('log', [TarotController::class,'handlePaymentNotification']);
>>>>>>> Stashed changes
