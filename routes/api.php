<?php

use App\Http\Controllers\ChainController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

/**
 * Api Routes
 */

Route::resource('/subscribe', EmailController::class)
    ->only(['store']);

Route::post('/chain', [ChainController::class, 'chain']);
