<?php

use App\Http\Controllers\API\ExchangeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('rates', [ExchangeController::class, 'index']);

Route::post('rates', [ExchangeController::class, 'rates']);
