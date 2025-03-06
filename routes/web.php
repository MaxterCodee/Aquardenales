<?php

use App\Http\Controllers\BrokersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBrokerController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/brokers', [BrokersController::class, 'index'])->name('brokers.index');

    Route::get('/empty', [DashboardController::class, 'empty'])->name('empty');

    Route::get('/usuarios', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
});








