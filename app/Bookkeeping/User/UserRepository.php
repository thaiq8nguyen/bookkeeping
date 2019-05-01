<?php

namespace App\Bookkeeping\User;

use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserRepository implements UserInterface
{
    public function login($credential)
    {
        if (Auth::attempt(['email' => $credential['email'], 'password' => $credential['password']])) {
            $user = Auth::user();

            $token = $user->createToken('access');

            $result = [
                'accessToken' => $token->accessToken,
                'expiration' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
                'userFullName' => $user->name,
                'role' => $user->roles->first()->name,
            ];

            if ($user->roles->first->name == 'renter' && $user->roles()->exists()) {
                $result['renterID'] = $user->renter->id;
            }

            return $result;
        }

        return false;
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return true;
        }
        return false;
    }

    public function user()
    {
    }
}
