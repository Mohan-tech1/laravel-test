<?php

use App\Http\Controllers\CountryStateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country', [CountryStateController::class, 'country']);
Route::get('state/{country_id}', [CountryStateController::class, 'state']);
Route::get('city/{state_id}', [CountryStateController::class, 'city']);

Route::post('add-users', [UserController::class, 'addUser']);
