<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataBrokerController;
use App\Http\Controllers\GeminiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// api.php
Route::post('texto', [GeminiController::class, 'texto']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::post('/data-brokers', [DataBrokerController  ::class, 'store']);

