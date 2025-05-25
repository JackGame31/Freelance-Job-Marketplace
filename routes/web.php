<?php

use App\Http\Controllers\Admin\ContractController;
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
    Route::controller(ContractController::class)
        ->middleware('auth')
        ->group(function () {
            Route::get('/application', 'application')->name('application')->middleware('auth');
            Route::get('/application/{freelance:id}', 'showUser')->name('application.show')->middleware('auth');
            Route::post('/application/{freelance:id}', 'apply')->name('application.apply')->middleware('auth');
            Route::delete('/application/{freelance:id}', 'withdraw')->name('application.withdraw');
        });
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

    // Logged in admin routes
    Route::middleware('auth:admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

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

        // Contracts
        Route::controller(ContractController::class)->group(function () {
            Route::get(
                '/freelance/{freelance}/{user}',
                'showAdmin'
            )->name('freelances.applicant')->middleware('auth:admin');
            Route::patch(
                '/freelance/{freelance}/{user}',
                'updateStatus'
            )->name('freelances.applicant.status');
            Route::post('/freelance/{freelance}/{user}/pay', 'pay')->name('freelances.applicant.pay');
        });
    });
});

Route::get('/welcome', function () {
    return view('welcome');
});
