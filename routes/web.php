<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {

    Route::get('/login',
        [AuthController::class,'loginPage']
    )->name('login');

    Route::post('/login',
        [AuthController::class,'login']
    )->name('login.submit');

});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard',
        [DashboardController::class,'index']
    )->name('dashboard');

    Route::post('/logout',
        [AuthController::class,'logout']
    )->name('logout');

    Route::get('/users',
    [UserController::class,'index'])
    ->name('users.index');

Route::get('/users/data',
    [UserController::class,'data'])
    ->name('users.data');

Route::post('/users',
    [UserController::class,'store'])
    ->name('users.store');

Route::get('/users/{user}',
    [UserController::class,'show'])
    ->name('users.show');

Route::put('/users/{user}',
    [UserController::class,'update'])
    ->name('users.update');

Route::delete('/users/{user}',
    [UserController::class,'destroy'])
    ->name('users.destroy');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/data', [CustomerController::class, 'data'])->name('customers.data');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::patch('/customers/{customer}/status', [CustomerController::class, 'updateStatus'])->name('customers.status');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});