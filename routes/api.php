<?php

use App\Http\Controllers\WeatherLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API']);
});

Route::apiResource('weather_log', WeatherLogController::class);
