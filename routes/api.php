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
