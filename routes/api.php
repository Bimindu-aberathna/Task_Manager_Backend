<?php

use App\Http\Controllers\Todo_Contoller;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Single route
Route::get('/todos', [Todo_Contoller::class, 'index']);

// Group of routes
Route::prefix('todos')->group(function () {
    Route::get('/', [Todo_Contoller::class, 'index']);
    Route::post('/', [Todo_Contoller::class, 'store']);
    Route::get('/{todo}', [Todo_Contoller::class, 'show']);
    Route::put('/{todo}', [Todo_Contoller::class, 'update']);
    Route::delete('/{todo}', [Todo_Contoller::class, 'destroy']);
});

Route::apiResource('todos', Todo_Contoller::class);

