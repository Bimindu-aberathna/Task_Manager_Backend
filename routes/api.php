<?php

// use App\Http\Controllers\Api\AuthContoller;

use App\Http\Controllers\Auth_ToDo_Controller;
use App\Http\Controllers\AuthContoller ;
use App\Http\Controllers\Todo_Contoller;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(Auth_ToDo_Controller::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');

    
});

// Group of routes

//

    // Route::post('/register', [UserController::class, 'register']);
    // Route::post('/login', [UserController::class, 'login']);
    // Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
    // Route::post('/reset-password', [UserController::class, 'resetPassword']);

    // // Protected routes
    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::post('/logout', [UserController::class, 'logout']);
        
    //     Route::get('/users', [UserController::class, 'index']);
    //     Route::get('/users/{id}', [UserController::class, 'show']);
    //     Route::put('/users/{id}', [UserController::class, 'update']);
    //     Route::delete('/users/{id}', [UserController::class, 'destroy']);

    //     // Route::apiResource('todos', Todo_Controller::class);
    // });

    Route::get('/todos', [Todo_Contoller::class, 'index']);
    Route::post('/todos', [Todo_Contoller::class, 'store']);
    Route::get('/todos/{id}', [Todo_Contoller::class, 'show']);
    Route::put('/todos/{id}', [Todo_Contoller::class, 'update']);
    Route::delete('/todos/{id}', [Todo_Contoller::class, 'destroy']);

    Route::apiResource('todos', Todo_Contoller::class);

