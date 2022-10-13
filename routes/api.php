<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OutletController;


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


Route::post('register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('users',UserController::class)->except('create', 'edit');

    Route::apiResource('outlets',OutletController::class)->except('create', 'edit');
});

