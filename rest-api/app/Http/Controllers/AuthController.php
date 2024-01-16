<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors'  => 'Incorrect login details',
                'message' => 'Unauthenticated'
            ], 401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken("api_token")->plainTextToken;

        return response()->json([
            'data'      => [
                'user' => new UserResource($user),
                'token' => $token
            ],
            'message'   => 'Success'
        ], 200);
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create($request->all());
        $token = $user->createToken("api_token")->plainTextToken;
        return response()->json([
            'data'      => [
                'user' => new UserResource($user),
                'token' => $token
            ],
            'message'   => 'Success'
        ], 201);
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        Auth::guard('web')->logout();
        return response()->json([], 204);
    }
}
