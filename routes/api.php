<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/doctores', function () {
    return 'Lista de doctores';
});

Route::get('/doctores/{id}', function () {
    return 'Obteniendo un doctor';
});


Route::post('/doctores', function () {
    return 'Creando doctores';
});

Route::put('/doctores/{id}', function () {
    return 'Actualizando doctores';
});


Route::delete('/doctores/{id}', function () {
    return 'Eliminando doctores';
});

