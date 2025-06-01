<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Client;

class CheckClientToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        $client = Client::where('token', $token)->first();

        if (!$client) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Make client accessible in the request
        $request->merge(['client_id' => $client->id]);

        return $next($request);
    }

}
