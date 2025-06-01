<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherLog extends Model
{
    /** @use HasFactory<\Database\Factories\WeatherLogFactory> */
    use HasFactory;

    protected $fillable = [
        'temperature',
        'humidity',
        'client_id',
    ];
}
