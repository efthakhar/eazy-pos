<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


// API Routes
Route::post('/user-registration',[UserController::class,'UserRegistration']);
