<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('index');
})->name('home');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/welcome', function () {
    return view('welcome');
});
