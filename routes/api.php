<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FamiliarController;
use App\Http\Controllers\CodigoClienteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccidenteController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    // Rutas para ClienteController
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'index']);
        Route::get('/{id}', [ClienteController::class, 'show']);
        Route::post('/', [ClienteController::class, 'store']);
        Route::put('/{id}', [ClienteController::class, 'update']);
        Route::delete('/{id}', [ClienteController::class, 'destroy']);
    });

    // Rutas para FamiliarController
    Route::prefix('familiares')->group(function () {
        Route::get('/', [FamiliarController::class, 'index']);
        Route::get('/{id}', [FamiliarController::class, 'show']);
        Route::post('/', [FamiliarController::class, 'store']);
        Route::put('/{id}', [FamiliarController::class, 'update']);
        Route::delete('/{id}', [FamiliarController::class, 'destroy']);
    });

    // Rutas para CodigoClienteController
    Route::prefix('codigos')->group(function () {
        Route::get('/', [CodigoClienteController::class, 'index']);
        Route::get('/{id}', [CodigoClienteController::class, 'show']);
        Route::post('/', [CodigoClienteController::class, 'store']);
        Route::put('/{id}', [CodigoClienteController::class, 'update']);
        Route::delete('/{id}', [CodigoClienteController::class, 'destroy']);
    });

    // Rutas para AdminController
    Route::prefix('admins')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/{id}', [AdminController::class, 'show']);
        Route::post('/', [AdminController::class, 'store']);
        Route::put('/{id}', [AdminController::class, 'update']);
        Route::delete('/{id}', [AdminController::class, 'destroy']);
    });

    // Rutas para AccidenteController
    Route::prefix('accidentes')->group(function () {
        Route::get('/', [AccidenteController::class, 'index']);
        Route::get('/{id}', [AccidenteController::class, 'show']);
        Route::post('/', [AccidenteController::class, 'store']);
        Route::put('/{id}', [AccidenteController::class, 'update']);
        Route::delete('/{id}', [AccidenteController::class, 'destroy']);
    });
});
