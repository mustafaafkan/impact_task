<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreditPaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
    return view('index');
});

Route::get('credits', function () {
    return view('credits');
});

Route::get('create-payment', function () {
    return view('create-payment');
});

Route::post('/register', [RegisterController::class, 'register']);
Route::get('get-users', [UserController::class, 'getUsers']);
Route::post('credit', [CreditController::class, 'postCredit']);
Route::get('get-credits', [CreditController::class, 'getCredits']);
Route::post('monthly-installment', [CreditPaymentController::class, 'postMonthlyInstallment']);
