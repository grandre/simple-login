<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('get-cep', [AddressController::class, 'getCep'])->name('cep');

Route::view('/register', 'register')->name('register');