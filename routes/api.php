<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PropriedadeController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::get('propriedades', [PropriedadeController::class, 'index']);
Route::post('propriedades', [PropriedadeController::class, 'store']);
Route::delete('propriedades/{model}', [PropriedadeController::class, 'destroy']);

Route::get('contratos', [ContratoController::class, 'index']);
Route::post('contratos', [ContratoController::class, 'store']);
Route::delete('contratos/{model}', [ContratoController::class, 'destroy']);

Route::get('contratos/propriedades', [ContratoController::class, 'getPropriedades']);
Route::get('contratos/tipo-de-pessoa', [ContratoController::class, 'getTipoDePessoa']);

Route::get('logout', [AuthController::class, 'logout']);

/* Route::middleware('auth:sanctum')->group(function () {

}); */
