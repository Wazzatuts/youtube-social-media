<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Mail\RegisterUserMail;
use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var ResponseHelper
     */
    protected $responseHelper;

    /**
     * AuthController constructor.
     * @param UserService $userService
     * @param ResponseHelper $responseHelper
     */
    public function __construct(UserService $userService, ResponseHelper $responseHelper)
    {
        $this->userService = $userService;
        $this->responseHelper = $responseHelper;
    }

    /**
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->registerUser($request->all());

        if ($user) {
            Mail::to($user->email)->send(new RegisterUserMail($user));
            return $this->responseHelper->successResponse(true,'Register Email Sent', $user);
        }

        return $this->responseHelper->errorResponse(false,'No user created' ,404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        return $this->responseHelper->errorResponse(false, 'Unauthorised', 401);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::user();

        return $this->responseHelper->successResponse(true, 'User', $user);
    }
}
