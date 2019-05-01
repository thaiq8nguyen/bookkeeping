<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckUserID
 * @package App\Http\Middleware
 */
class CheckUserID
{

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     * Validate authenticated user id with request user id
     */
    public function handle($request, Closure $next)
    {
        $userID = $request->input('userID');

        if (Auth::id() !== $userID) {
            return response()->json(['success' => false, 'message' => 'Mismatched user id'], 401);
        }

        return $next($request);
    }
}
