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
// use App\Services\LoginService;
use Auth;

class UserController extends Controller
{

    // Create a new user 
    protected $userservice;
    public function __construct(UserService $userservice){
        $this->userservice = $userservice;
    }
    
    public function index(){
        $user = $this->userservice->getAllUsers();
        return response()->json($user);
    }
    
    public function show($id){
        $user = $this->userservice->getOneUser($id);
        return response()->json($user);
    }

    public function register(RegisterRequest $request){
        $user = $this->userservice->register($request);
        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userservice->login($request);
      return Auth::attempt($user);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }

  
}

