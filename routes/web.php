<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/my-profile/{id}', function () {
    return view('my_profile');
});

Route::get('/all-profile', function () {
    return view('all_profiles');
});

Route::get('/messages', function () {
    return view('messages');
});

Route::get('/login', function () {
    return view('login');
})->name('login');



Route::middleware('auth:sanctum')->get('/get_user/{id}', [AuthController::class, 'get_user_profile']);

Route::post('/upload-cover', [ProfileController::class, 'uploadCover'])->name('upload.cover');




Route::get('/messages/{receiverId?}', function ($receiverId = null) {
    return view('messages', ['receiverId' => $receiverId]);
});