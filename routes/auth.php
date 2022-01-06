<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthLoginController;


Route::get('/login', [OAuthLoginController::class, 'login'])
    ->name('login');

Route::get('/callback', [OAuthLoginController::class, 'callback'])
    ->name('oauth.callback');

Route::get('/logout', [OAuthLoginController::class, 'logout'])
    ->name('logout');
