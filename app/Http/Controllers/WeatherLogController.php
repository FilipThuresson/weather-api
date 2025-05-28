<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeatherLogRequest;
use App\Http\Requests\UpdateWeatherLogRequest;
use App\Models\WeatherLog;
use Illuminate\Http\Request;

class WeatherLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WeatherLog::all()->map(function ($log) {
            $log->created_at = $log->created_at->timezone('Europe/Stockholm')->toDateTimeString();
            $log->updated_at = $log->updated_at->timezone('Europe/Stockholm')->toDateTimeString();
            return $log;
        });
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
