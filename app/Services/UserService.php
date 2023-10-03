<?php

namespace App\Services;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Models\User;

class UserService {

     // Get All Users
     public function getAllUsers() {
        return User::get();
     }

     public function getOneUser($id) {
        return User::whereId($id)->first();
     }

 // Register User
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response($user);
    }
    

// Login user
public function login(LoginRequest $request){
    if (!Auth::attempt($request->only('email', 'password'))) {
        return ErrorsHandler::sendError('Email or Password are invalid');
    }
    $user = Auth::user();
    $token = $user->createToken('Personal Access Token')->accessToken;

}
}