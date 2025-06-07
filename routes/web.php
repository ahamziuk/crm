<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\NovaPoshtaController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Дашборд
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Авторизація
Auth::routes(); // login, logout, register, reset

// Група авторизованих
Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('products', ProductController::class);

    // Nova Poshta API
    Route::get('/novaposhta/cities', [NovaPoshtaController::class, 'getCities']);
    Route::get('/novaposhta/warehouses/{cityRef}', [NovaPoshtaController::class, 'getWarehouses']);
});

// Домашня сторінка після логіну
Route::get('/home', [HomeController::class, 'index'])->name('home');
