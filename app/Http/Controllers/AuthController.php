<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->registerUser($request->all());

        $token = $user->createToken('YoutubeTutorial')->accessToken;

        return response()->json([
            'data' => [
                'success' => true,
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    public function login(Request $request)
    {
        $newUser = $this->userService->loginUser($request->all());

        if ($newUser) {
            $token = $newUser->createToken('YoutubeTutorial');

            return response()->json([
                'access_token' => $token->accessToken,
                'token_type' => 'Bearer',
                'expirey_date' => $token->token->expires_at,
                'user' => $newUser,
            ]);
        }

        return response()->json([
            'message' => 'Unauthorised',
        ],401);
    }
}
