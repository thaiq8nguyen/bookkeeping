<?php

namespace App\Http\Middleware;

use Closure;
use App\Renter;
use App\Transaction;

class CheckRenterTransaction
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
        $transactionID = $request->route('transactionID');
        $renterID = $request->route('renterID');


        $renter = Renter::withCount(['transactions' => function ($query) use ($transactionID) {
            $query->where('id', $transactionID);
        }])->where('id', $renterID)->first();

        if ($renter->transactions_count != 1) {
            return response()->json([
                'success' => false,
                'message' => 'The transaction does not belong to the renter'
            ]);
        }


        return $next($request);
    }
}
