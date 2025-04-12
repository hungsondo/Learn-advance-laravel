<?php

use App\Http\Controllers\TarotController;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-mail', function () {
    $email = "user@example.com";
    SendEmailJob::dispatch($email);
    echo "Email is sent!";
});


Route::get('IPN', [TarotController::class,'handlePaymentNotification']);
Route::get('payment-result', [TarotController::class,'handlePaymentResult']);