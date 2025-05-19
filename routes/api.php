<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ComunaController;
use App\Http\Controllers\api\DepartamentoController;
use App\Http\Controllers\api\MunicipioController;
use App\Http\Controllers\api\PaisController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//comuna
Route::get('/comunas', [ComunaController::class, 'index'])->name('comunas');
Route::post('/comunas', [ComunaController::class, 'store'])->name('comunas.store');
Route::get('/comunas/{comuna}', [ComunaController::class, 'show'])->name('comunas.show');
Route::put('/comunas/{comuna}', [ComunaController::class, 'update'])->name('comunas.update');
Route::delete('/comunas/{comuna}', [ComunaController::class, 'destroy'])->name('comunas.destroy');

//departamento
Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamentos');
Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');
Route::get('/departamentos/{departamento}', [DepartamentoController::class, 'show'])->name('departamentos.show');
Route::put('/departamentos/{departamento}', [DepartamentoController::class, 'update'])->name('departamentos.update');
Route::delete('/departamentos/{departamento}', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');   
