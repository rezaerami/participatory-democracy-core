<?php

namespace App\Http\Middleware;

use App\Constants\HttpStatus;
use App\Helpers\Response;
use Closure;
use Illuminate\Http\Request;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()) {
            throw Response::error(HttpStatus::UNAUTHORIZED);
        }
        return $next($request);
    }
}
