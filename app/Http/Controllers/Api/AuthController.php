<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUp;
use App\Jobs\SendRegistrationMail;
use App\Mail\UserRegistered;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user_model = User::whereEmail($request->email);

        if (!$user_model->exists()) {
            return $this->respondWithError('Email address not found.');
        }

        $user = $user_model->first();
        if (!Hash::check($request->password, $user->password)) {
            return $this->respondWithError('Email or password invalid');
        }

        return $this->respondWithSuccess(['message' => 'Logged in successfully', 'user' => $user->load('userType:id,user_type'), 'token' => $this->generateToken($user)]);
    }

    public function signup(SignUp $request)
    {
        $user = User::create($request->except('password') + ['password' => Hash::make($request->password)]);
        SendRegistrationMail::dispatch($user);

        return $this->respondWithSuccess(['user' => $user->load('userType:id,user_type'), 'token' => $this->generateToken($user)]);
    }

    private function generateToken(User $user)
    {
        return $user->createToken(env('APP_NAME'))->plainTextToken;
    }
}
