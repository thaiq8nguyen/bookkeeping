<?php

namespace App\Bookkeeping\User;

interface UserInterface
{
    public function login($credential);

    public function logout();
}
