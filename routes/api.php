<?php

// use App\Http\Controllers\Api\AuthContoller;

use App\Http\Controllers\Auth_ToDo_Controller;
use App\Http\Controllers\Todo_Contoller;
use Illuminate\Support\Facades\Route;



// Auth routes
Route::controller(Auth_ToDo_Controller::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User profile and logout
    Route::get('users', [Auth_ToDo_Controller::class, 'userProfile']);
    Route::get('logout', [Auth_ToDo_Controller::class, 'userLogout']);

    // Todo routes
    Route::get('/todos', [Todo_Contoller::class, 'index']);
    Route::post('/todos', [Todo_Contoller::class, 'store']);
    Route::get('/todos/{id}', [Todo_Contoller::class, 'show']);
    Route::put('/todos/{id}', [Todo_Contoller::class, 'update']);
    Route::delete('/todos/{id}', [Todo_Contoller::class, 'destroy']);

    Route::apiResource('todos', Todo_Contoller::class);
});


