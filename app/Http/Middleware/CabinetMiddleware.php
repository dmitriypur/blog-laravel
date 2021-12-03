<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CabinetMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if((int)auth()->user()->role !== User::ROLE_READER && (int)auth()->user()->role !== User::ROLE_ADMIN){
            abort(404);
        }
        return $next($request);
    }
}
