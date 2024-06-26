<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnimalController::class, 'index']);
Route::resource('animals', AnimalController::class)->only('index', 'create', 'store');
