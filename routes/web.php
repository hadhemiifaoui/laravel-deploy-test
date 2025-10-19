<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Livewire\Users;



Route::get('/', function () {
    return view('welcome');
});



Route::get('/', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');

Route::get('/tasks-page', function () {
    return view('livewire.tasks-page');
});



Route::get('/users', function () {
    return view('users.index');
});
