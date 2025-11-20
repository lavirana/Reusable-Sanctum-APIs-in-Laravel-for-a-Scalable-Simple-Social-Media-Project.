<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
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
Route::get('/profile-detail/{id}', [ProfileController::class, 'index']);
Route::get('/edit-profile/{id}', [ProfileController::class, 'edit']);
Route::put('/update-profile/{id}', [ProfileController::class, 'update'])->name('update.profile');

Route::middleware('auth:sanctum')->put('/update-user-password', [ProfileController::class, 'updatePassword'])
     ->name('update.password');


Route::get('/messages/{receiverId?}', function ($receiverId = null) {
    return view('messages', ['receiverId' => $receiverId]);
});
Route::get('/search', [SearchController::class, 'search'])->name('search');