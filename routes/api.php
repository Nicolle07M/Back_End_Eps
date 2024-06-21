<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('doctors', [DoctorController::class, 'index']);
    Route::post('doctors', [DoctorController::class, 'store']);
    Route::get('doctors/{doctor}', [DoctorController::class, 'show']);
    Route::put('doctors/{doctor}', [DoctorController::class, 'update']);
    Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy']);
});

