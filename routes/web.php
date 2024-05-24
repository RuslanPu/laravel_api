<?php

use App\Http\Controllers\API\NakrutkaAPIController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/** General user routes */
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'userDashboard'])
    ->name('dashboard');

/** Manager routes */
Route::middleware('managerAuth')->prefix('manager')
    ->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'managerDashboard'])
            ->name('managerDashboardShow');
    });

Route::middleware('adminAuth')->prefix('admin')
    ->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])
            ->name('adminDashboardShow');

        /** CRUD managers */
        Route::get('/managers', [UserController::class, 'managers']);
        Route::get('/managers/create', [UserController::class, 'createManager']);
        Route::post('/managers', [UserController::class, 'storeManager']);
        Route::get('/managers/{id}/edit', [UserController::class, 'editManager']);
        Route::put('/managers/{id}', [UserController::class, 'updateManager']);
        Route::delete('/managers/{id}', [UserController::class, 'deleteManager']);

        /** CRUD admins */
        Route::get('/admins', [UserController::class, 'admins']);
        Route::get('/admins/create', [UserController::class , 'createAdmin']);
        Route::post('/admins', [UserController::class, 'storeAdmin']);
        Route::get('/admins/{id}/edit', [UserController::class, 'editAdmin']);
        Route::put('/admins/{id}', [UserController::class, 'updateAdmin']);
        Route::delete('/admins/{id}', [UserController::class, 'deleteAdmin']);

        /** CRUD clients */
        Route::get('/clients', [UserController::class, 'clients']);
        Route::get('/clients/create', [UserController::class , 'createClient']);
        Route::post('/clients', [UserController::class, 'storeClient']);
        Route::get('/clients/{id}/edit', [UserController::class, 'editClient']);
        Route::put('/clients/{id}', [UserController::class, 'updateClient']);
        Route::delete('/clients/{id}', [UserController::class, 'deleteClient']);

        /** CRUD users */
        Route::get('/users/create', [UserController::class, 'createUser']);
        Route::post('/users', [UserController::class, 'storeUser']);
        Route::get('/users/{id}/edit', [UserController::class, 'editUser']);
        Route::put('/users/{id}', [UserController::class, 'updateUser']);
        Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

        /** api nakrutka */
        Route::get('/api/balance', [NakrutkaAPIController::class, 'balance']);
        Route::get('/api/listServices', [NakrutkaAPIController::class, 'listServices']);
        Route::get('/api/statusOrder', [NakrutkaAPIController::class, 'statusOrder']);
        Route::get('/api/statusMultiOrder', [NakrutkaAPIController::class, 'statusMultiOrder']);
        Route::get('/api/addOrderFollowers', [NakrutkaAPIController::class, 'addOrderFollowers']);
        Route::get('/api/cancelOrder', [NakrutkaAPIController::class, 'cancelOrder']);
        Route::get('/api/addAllServicesToDB', [NakrutkaAPIController::class, 'addAllServiceApiToDb']);

        Route::get('/services', [NakrutkaAPIController::class, 'listServices'])
        ->name('apiServices');


    });

