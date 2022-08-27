<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

// api prefix v1
Route::group(['prefix' => 'v1'], function () {
    Route::middleware('guest')->group(function () {
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
        Route::post('/login', [AuthenticatedController::class, 'login'])->name('login');
        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    // api prefix v1/tasks
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', 'App\Http\Controllers\TaskController');
        Route::post('/logout', [AuthenticatedController::class, 'destroy'])->middleware('auth')->name('logout');
    });
});
