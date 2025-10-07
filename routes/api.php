<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PeminjamanController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/fasilitas', [FasilitasController::class, 'index']);
Route::post('/fasilitas/tambah', [FasilitasController::class, 'store']);
Route::put('/fasilitas/update/{id}', [FasilitasController::class, 'update']);
Route::delete('/fasilitas/delete/{id}', [FasilitasController::class, 'destroy']);

Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::post('/peminjaman/tambah', [PeminjamanController::class, 'store']);
Route::put('/peminjaman/approve/{id}', [PeminjamanController::class, 'approve']);
Route::put('/peminjaman/reject/{id}', [PeminjamanController::class, 'reject']);
Route::put('/peminjaman/kembalikan/{id}', [PeminjamanController::class, 'kembalikan']);
