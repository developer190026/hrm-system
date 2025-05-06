<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

// Define your API routes here
Route::resource('allbooks', BookController::class);
