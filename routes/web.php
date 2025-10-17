<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/my-profile', function () {
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
});