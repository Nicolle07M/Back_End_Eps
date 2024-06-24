<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\AuthController;

// Rutas de autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {
    // API de Doctores
    Route::get('/doctores', [DoctorController::class, 'index']);
    Route::post('/doctores', [DoctorController::class, 'store']);
    Route::get('/doctores/{id}', [DoctorController::class, 'show']);
    Route::put('/doctores/{id}', [DoctorController::class, 'update']);
    Route::delete('/doctores/{id}', [DoctorController::class, 'destroy']);

    // API de Especialidades
    Route::get('/especialidades', [EspecialidadController::class, 'index']);
    Route::get('/especialidades/{id}', [EspecialidadController::class, 'show']);
    Route::post('/especialidades', [EspecialidadController::class, 'store']);
    Route::put('/especialidades/{id}', [EspecialidadController::class, 'update']);
    Route::delete('/especialidades/{id}', [EspecialidadController::class, 'destroy']);
});
Route::get('/especialidades', [EspecialidadController::class, 'index']);
Route::post('/doctores', [DoctorController::class, 'store']);

