<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\UserController;

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


Route::group(["middleware" => ["api.auth"]], function () {
    Route::group(["prefix" => "users"], function () {
        Route::get("profile", [UserController::class, 'profile'])->name("user.profile");
    });
});
