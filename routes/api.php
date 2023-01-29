<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\TopicsController;

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



Route::group(["prefix" => "auth"], function () {
    Route::post("refresh-token", [AuthController::class, 'refreshToken'])->name("auth.refreshToken");
    Route::group(["middleware" => ["api.auth"]], function () {
        Route::get("logout", [AuthController::class, 'logout'])->name("auth.logout");
    });
});

Route::group(["prefix" => "users"], function () {
    Route::group(["middleware" => ["api.auth"]], function () {
        Route::get("profile", [UserController::class, 'profile'])->name("users.profile");
        Route::get("topics", [UserController::class, 'topics'])->name("users.topics");
    });
});

Route::group(["prefix" => "topics"], function () {
    Route::get(null, [TopicsController::class, 'index'])->name("topics.index");
    Route::get("{topicCode}", [TopicsController::class, 'show'])->name("topics.show");
    Route::group(["middleware" => ["api.auth"]], function () {
        Route::post(null, [TopicsController::class, 'create'])->name("topics.create");
        Route::post("{topicCode}", [TopicsController::class, 'update'])->name("topics.update");
        Route::delete("{topicCode}", [TopicsController::class, 'delete'])->name("topics.delete");
    });
});
