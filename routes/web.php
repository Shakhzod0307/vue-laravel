<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;


Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [ChatController::class, 'index'])->name('dashboard');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat');

    Route::get('/messages/{user}', [ChatController::class, 'getMessages']);
    Route::post('/messages/{user}', [ChatController::class, 'sendMessage']);
});

