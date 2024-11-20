<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/auth/{provider}', [SocialiteController::class, 'socialiteLogin']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleSocialiteCallback']);

// Email verification routes
Route::post('/email/verificationNotification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('/verifyEmail/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])->name('verification.verify')->middleware('auth:sanctum');

// Password reset routes
Route::post('/forgotPassword', [PasswordResetController::class, 'sendPasswordResetLink']);
Route::post('/resetPassword', [PasswordResetController::class,'resetPassword'])->name('password.reset');

// User routes
Route::apiResource('users', UserController::class);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});