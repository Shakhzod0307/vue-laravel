<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users',[UserController::class,"index"])->name('users');
Route::post('/user/post',[UserController::class,'store'])->name('store.user');
Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('destroy');


Route::post('/login',[UserController::class,'login'])->name('login');
Route::post('/register',[UserController::class,'register'])->name('register');
Route::middleware('auth:sanctum')->post('/logout',[UserController::class,'logout'])->name('logout');
