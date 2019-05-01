<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class CheckRenterID
{

    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse|mixed
     * Validate authenticated renter ID with request ID
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $renterID = $user->renter->id;

        $requestID = $request->route('renterID');

        if ($renterID != $requestID) {
            return response()->json(['success' => false, 'message' => 'unauthorized'], 401);
        }

        return $next($request);
    }
}
