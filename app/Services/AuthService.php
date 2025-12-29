<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
class AuthService
{
    public function login($email, $password)
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
    }
}
