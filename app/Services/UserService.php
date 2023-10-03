<?php

namespace App\Services;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Models\User;

class UserService {

 // Register User
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
        ]);

        // $user_role = Role::where(['name' => 'user'])->first();
        // if ($user_role){
        //     $user_role->assignRole($user_role);
        // }
        return response($user);
    }

}