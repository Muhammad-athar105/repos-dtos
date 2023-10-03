<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\ErrorsHandler\sendError;
use App\Services\UserService;
use Auth;

class UserController extends Controller
{

    
    public function register(RegisterRequest $request){
        $user = (new UserService())->register($request);
        return response($user);
    }
    
    
    //    protected $userservice;
    //    public function __construct(UserService $userservice){
    //     $this->userservice = $userservice;
    //     return response($user);

    
    //    }
  

    // User Login
public function login(LoginRequest $request)
{
    if (!Auth::attempt($request->only('email', 'password'))) {
        return Helper::sendError('Email or Password are invalid');
    }
    $user = Auth::user();

    if ($user->role == '1') {
        return new SendResponse($user);    
    } elseif ($user->role == '0') {
        return new response($user);
    }
    return response()->json(['status' => 'Unknown role']);
}


    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }

  
}

