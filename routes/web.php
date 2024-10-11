<?php

use App\Http\Controllers\Todo_Contoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::post('/todos', [Todo_Contoller::class, 'store']);
Route::get('/todos', [Todo_Contoller::class, 'index']);
Route::get('/todos/{id}', [Todo_Contoller::class, 'show']);
Route::put('/todos/{id}', [Todo_Contoller::class, 'update']);
Route::delete('/todos/{id}', [Todo_Contoller::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});
Route::resource('todos', Todo_Contoller::class);
