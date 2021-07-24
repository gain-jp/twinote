<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwinoteUserController;

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
Route::get('/twinote_user/register', [TwinoteUserController::class, 'register']);
Route::post('/twinote_user/register/send', [TwinoteUserController::class, 'send']);
Route::get('/twinote_user/register/complete', [TwinoteUserController::class, 'complete']);
Route::get('/twinote_user/login', function(){return View('login');});
Route::post('/twinote_user/login', [TwinoteUserController::class, 'login']);
Route::get('/twinote_user', [TwinoteUserController::class, 'mypage']);