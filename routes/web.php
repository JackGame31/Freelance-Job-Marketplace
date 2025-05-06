<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::group([], function () {
    // home
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // search
    Route::get('/search', function () {
        return view('search');
    })->name('search');

    // detail freelance
    Route::get('/freelance', function () {
        return view('freelance');
    })->name('freelance');

    // about
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});

// User Routes
Route::group([], function () {
    // Authentication
    Route::controller(AuthController::class)->group(function () {
        Route::group(['middleware' => ['guest', 'guest:admin']], function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/login', 'authenticate')->name('login.authenticate');
            Route::get('/register', 'register')->name('register');
            Route::post('/register', 'store')->name('register.store');
        });

        Route::delete('/logout', 'logout')->name('logout')->middleware('auth');
    });

    // Applications
    Route::get('/application', function () {
        return view('user.application.index');
    })->name('application')->middleware('auth');
    Route::get('/application/show', function () {
        return view('user.application.show');
    })->name('application.show')->middleware('auth');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Authentication
    Route::controller(AdminAuthController::class)->group(function () {
        Route::group(['middleware' => 'guest:admin', 'guest'], function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/login', 'authenticate')->name('login.authenticate');
            Route::get('/register', 'register')->name('register');
            Route::post('/register', 'store')->name('register.store');
        });

        Route::delete('/logout', 'logout')->name('logout')->middleware('auth:admin');
    });

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard')->middleware('auth:admin');

    // Freelances
    Route::get('/freelance', function () {
        return view('admin.freelance.index');
    })->name('freelance.index')->middleware('auth:admin');

    Route::get('/freelance/create', function () {
        return view('admin.freelance.form');
    })->name('freelance.create')->middleware('auth:admin');

    Route::get('/freelance/view', function () {
        return view('admin.freelance.show');
    })->name('freelance.show')->middleware('auth:admin');

    Route::get('/freelance/edit', function () {
        return view('admin.freelance.form');
    })->name('freelance.edit')->middleware('auth:admin');
});

Route::get('/welcome', function () {
    return view('welcome');
});
