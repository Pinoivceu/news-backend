<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WriterController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Welcome, Admin!']);
        });

        Route::get('/admin/articles', [AdminController::class, 'index']);  
        Route::post('/admin/articles', [AdminController::class, 'store']);
        Route::put('/admin/articles/{id}', [AdminController::class, 'update']);
        Route::delete('/admin/articles/{id}', [AdminController::class, 'destroy']);
    });

    // Writer
    Route::middleware('role:penulis')->group(function () { // Perbaiki role ke "penulis"
        Route::get('/writer/dashboard', function () {
            return response()->json(['message' => 'Welcome, Writer!']);
        });

        Route::get('/writer/articles', [WriterController::class, 'index']);
        Route::post('/writer/articles', [WriterController::class, 'store']);
        Route::put('/writer/articles/{id}', [WriterController::class, 'update']);
        Route::delete('/writer/articles/{id}', [WriterController::class, 'destroy']);
    });

});
