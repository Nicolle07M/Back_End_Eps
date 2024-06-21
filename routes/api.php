<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadController;

//API DE DOCTORES//

Route::get('/doctores', [DoctorController::class, 'index']);
Route::get('/doctores/{id}', [DoctorController::class, 'show']);
Route::post('/doctores', [DoctorController::class, 'store']);
Route::put('/doctores/{id}', [DoctorController:: class, 'update']);
Route::delete('/doctores/{id}', [DoctorController:: class, 'destroy']);

// API DE ESPECIALIDADES // 

Route::get('/especialidades', [EspecialidadController::class, 'index']);
Route::get('/especialidades/{id}', [EspecialidadController::class, 'show']);
Route::post('/especialidades', [EspecialidadController::class, 'store']);
Route::put('/especialidades/{id}', [EspecialidadController:: class, 'update']);
Route::delete('/especialidades/{id}', [EspecialidadController:: class, 'destroy']);
