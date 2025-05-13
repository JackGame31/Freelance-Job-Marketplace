<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\FreelanceController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

// Public Routes
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/search', 'search')->name('search');
    Route::get('/search/{freelance:id}', 'show')->name('search.show');
    Route::get('/about', 'about')->name('about');
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
    Route::resource('freelance', FreelanceController::class)
        ->middleware('auth:admin')->names([
            'index' => 'freelances.index',
            'create' => 'freelances.create',
            'store' => 'freelances.store',
            'show' => 'freelances.show',
            'edit' => 'freelances.edit',
            'update' => 'freelances.update',
            'destroy' => 'freelances.destroy',
        ]);
});

Route::get('/welcome', function () {
    return view('welcome');
});
