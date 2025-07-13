<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublikasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/publikasi', [PublikasiController::class, 'me']);
    Route::get('/publikasi/{id}', [PublikasiController::class, 'show']);
    Route::post('/publikasi', [PublikasiController::class, 'store']);
    Route::put('/publikasi/{id}', [PublikasiController::class, 'update']);
    Route::delete('/publikasi/{id}', [PublikasiController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});