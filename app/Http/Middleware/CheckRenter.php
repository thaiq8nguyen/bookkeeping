<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRenter
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
        $user = Auth::user();

        $role = $user->roles()->first()->name;

        if ($role !== 'renter') {
            return response()->json(['success' => false, 'message' => 'unauthorized'], 401);
        }

        return $next($request);
    }
}
