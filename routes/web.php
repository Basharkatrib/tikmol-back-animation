<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/login-google', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [AuthController::class, 'handleCallback']);

