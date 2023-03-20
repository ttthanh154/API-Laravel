<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileUpdateController;
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



Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('password/forgot-password',[ForgetPasswordController::class, 'forgetPassword']);
Route::post('password/reset-password',[ResetPasswordController::class, 'passwordReset']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('profile', function (Request $request) {
        return $request->user();
    });
    Route::put('profile', [ProfileUpdateController::class, 'update']);
    Route::post('email-verification', [EmailVerificationController::class,'email_verification']);
    Route::get('email-verification', [EmailVerificationController::class,'sendEmailVerification']);
    Route::post('password/change-password', [ChangePasswordController::class,'changePassword']);
    Route::post('logout', [LogoutController::class,'logout']);
});