<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NovaPoshtaController;

Route::get('/novaposhta/cities', [NovaPoshtaController::class, 'getCities']);
Route::get('/novaposhta/warehouses/{cityRef}', [NovaPoshtaController::class, 'getWarehouses']);
