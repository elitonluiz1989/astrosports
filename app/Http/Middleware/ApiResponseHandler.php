<?php

namespace App\Http\Middleware;

use Closure;

class ApiResponseHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $response = $next($request);

            return response()->json($response->original, $response->status());
        } catch(\Exception $ex) {
            return response()->json($ex->getMessage(), 422);
        }
    }
}
