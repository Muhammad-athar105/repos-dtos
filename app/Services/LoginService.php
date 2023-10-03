<?php

namespace App\Services;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Models\User;


class LoginService {
// User Login
public function login(LoginRequest $request)
{
  return Auth::attempt($credentials);
}

}