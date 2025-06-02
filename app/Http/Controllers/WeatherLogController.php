<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckClientToken;
use App\Http\Requests\StoreWeatherLogRequest;
use App\Http\Requests\UpdateWeatherLogRequest;
use App\Models\WeatherLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WeatherLogController extends Controller implements HasMiddleware
{
    public static function middleware(): array

    {
        return [
            new Middleware(CheckClientToken::class, only: ['store']),
        ];

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WeatherLog::query();

        // Use filled to ensure the parameter is present and not empty
        if ($request->filled('date')) {
            // If a specific date is provided, use it exclusively
            $query->whereDate('created_at', $request->date);
        } else {
            // Otherwise, check for a date range
            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }

            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }
        }

        return $query->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);
        $data['client_id'] = $request->get('client_id');

        $weatherLog = WeatherLog::create($data);
        return response()->json($weatherLog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(WeatherLog $weatherLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeatherLogRequest $request, WeatherLog $weatherLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WeatherLog $weatherLog)
    {
        //
    }
}
