<?php

namespace App\Http\Middleware;

use Closure;

class ApiAccessMiddleware
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
        $allowedApis = [
            'api/sam',
            'api/create',
            'api/show',
            'api/assign',
            'api/delete',
            'api/update',
            'api/userTask/{id}'
            // Add more allowed APIs here
        ];

        if (!in_array($request->path(), $allowedApis)) {
            // Return a forbidden response if the API is not allowed
            return response()->json(['message' => 'Access forbidden'], 403);
        }

        // If the API is allowed, continue with the request
        return $next($request);
    }
}
