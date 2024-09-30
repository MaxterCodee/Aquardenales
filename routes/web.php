<?php

use App\Http\Controllers\BrokersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeminiController;
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


});




