<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create([
            'email' => $registerRequest->input('email'),
            'password' => Hash::make($registerRequest->input('password'))
        ]);

        return Response::successResponse('You are Registered Successfully!', $user);
    }

    public function login(LoginRequest $loginRequest)
    {
        $email = $loginRequest->input('email');
        $password = $loginRequest->input('password');

        $user = User::where('email',$email)
            ->first();
        if(!$user || !Hash::check($password,$user->password)){
            return Response::errorResponse('The Provided Credentials are incorrect!',[], 401);
        }

        $token = $user->createToken($user->name . 'mini-shop-auth')->plainTextToken;

        $responseData = [
            'user' => $user,
            'token' => $token
        ];

        return Response::successResponse('You are Logged in!', $responseData);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return Response::successResponse('You are Logged out Successfully!', []);
    }
}
