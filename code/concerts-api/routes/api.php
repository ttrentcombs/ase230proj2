<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\ConcertController;
use App\Http\Controllers\Api\BookingController;


Route::get('/test', function () {
    return ['ok' => true];
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);


Route::get('/users',   [AuthController::class, 'indexUsers']);
Route::get('/profile', [AuthController::class, 'profile']);


Route::get('/venues',      [VenueController::class, 'index']);
Route::get('/venues/{id}', [VenueController::class, 'show']);
Route::post('/venues',     [VenueController::class, 'store']);

Route::get('/concerts',          [ConcertController::class, 'index']);
Route::get('/concerts/{id}',     [ConcertController::class, 'show']);
Route::post('/concerts',         [ConcertController::class, 'store']);
Route::put('/concerts/{id}',     [ConcertController::class, 'update']);
Route::delete('/concerts/{id}',  [ConcertController::class, 'destroy']);


Route::get('/bookings',  [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
