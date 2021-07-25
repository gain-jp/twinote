<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\AIController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/*
Route::post('/name/{twitter_id}/{change_twitter_id}/edit', [NameController::class, 'edit']);
Route::get('/name/{twitter_id}/{change_twitter_id}', [NameController::class, 'get']);
Route::post('/memo/{twitter_id}/edit', [MemoController::class, 'edit']);
Route::get('/memo/{twitter_id}', [MemoController::class, 'get']);
*/
Route::match(['post', 'options'], '/name/{twitter_id}/{change_twitter_id}/edit', [NameController::class, 'edit']);
Route::match(['get', 'options'], '/name/{twitter_id}/{change_twitter_id}', [NameController::class, 'get']);
Route::match(['post', 'options'], '/memo/{twitter_id}/{memo_twitter_id}/edit', [MemoController::class, 'edit']);
Route::match(['get', 'options'], '/memo/{twitter_id}/{memo_twitter_id}', [MemoController::class, 'get']);
Route::match(['get', 'options'], '/ai', [AIController::class, 'get']);