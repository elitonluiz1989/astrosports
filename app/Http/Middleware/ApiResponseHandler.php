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
        $response = $next($request);

        if ($response->exception) {
            return $response;
        } else {
            return response()->json($response->original, $response->status());
        }
    }
}
