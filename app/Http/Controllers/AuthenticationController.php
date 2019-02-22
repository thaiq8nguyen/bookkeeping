<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Bookkeeping\User\UserInterface;

class AuthenticationController extends BaseController
{
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        $result = $this->user->login($request->all());

        if (!$result) {
            return $this->sendError('Incorrect email or password', [], 401);
        }

        return $this->sendResponse($result, 'The user is authenticated');
    }

    public function logout()
    {
        $loggedOut = $this->user->logout();

        if ($loggedOut) {
            return $this->sendResponse("", "You have logged out");
        } else {
            return $this->sendError("Logout Error");
        }
    }
}
