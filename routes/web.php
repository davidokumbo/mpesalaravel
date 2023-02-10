<?php

use App\Http\Controllers\mpesaController;
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
Route::get('mpesaroute', [mpesaController::class, 'getdata']);
Route::get('accesstoken', [mpesaController::class, 'newAccessToken']);
Route::post('mpesacallback', [mpesaController::class, 'mpesacallback']);
Route:: get('jsonlink',[mpesaController::class, 'jsonmethod']);
Route::get('jsoncontroller', [mpesaController::class, 'jsoncontroller']);
