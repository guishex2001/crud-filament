<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('/user/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get('/user/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::put('/user/profile', [RegisteredUserController::class, 'update'])
                ->name('profile.update');

    Route::delete('/user/profile', [RegisteredUserController::class, 'destroy'])
                ->name('profile.destroy');

    Route::get('/user/password', function () {
        return view('profile.password');
    })->name('profile.password');

    Route::put('/user/password', [PasswordController::class, 'update'])
                ->name('profile.password.update');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['throttle:6,1'])
                ->name('verification.send');

    Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);
});
