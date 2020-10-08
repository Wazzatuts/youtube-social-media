<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\FogottenPasswordMail;
use App\Mail\RegisterUserMail;
use App\Services\PasswordResetService;
use App\Services\UserActivationTokenService;
use App\Services\UserService;
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
     * @var UserActivationTokenService
     */
    protected $userActivationTokenService;

    /**
     * @var PasswordResetService
     */
    protected $passwordResetService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     * @param ResponseHelper $responseHelper
     * @param UserActivationTokenService $userActivationTokenService
     * @param PasswordResetService $passwordResetService
     */
    public function __construct(
        UserService $userService,
        ResponseHelper $responseHelper,
        UserActivationTokenService $userActivationTokenService,
        PasswordResetService $passwordResetService
    )
    {
        $this->userService = $userService;
        $this->responseHelper = $responseHelper;
        $this->userActivationTokenService = $userActivationTokenService;
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->registerUser($request->all());

        if ($user) {
            $token = $this->userActivationTokenService->createNewToken($user->id);
            Mail::to($user->email)->send(new RegisterUserMail($user, $token->token));
            return $this->responseHelper->successResponse(true, 'Register Email Sent', $user);
        }

        return $this->responseHelper->errorResponse(false, 'No user created', 404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $checkActivated = $this->userService->checkUserIsActivated($request->email);

        if (!$checkActivated) {
            return $this->responseHelper->errorResponse(false, 'User Needs To Activate Account', 401);
        }

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

    public function activateEmail($code)
    {
        $checkToken = $this->userActivationTokenService->checkToken($code);

        return $this->responseHelper->successResponse(true, "Activate Email", $checkToken);
    }

    public function forgotPasswordCreate(Request $request)
    {
        $checkUserEmail = $this->userService->checkEmail($request->email);

        if (!$checkUserEmail) {
            return $this->responseHelper->errorResponse(false, "User Email doesnt Exist", 401);
        }

        $passwordResetData = $this->passwordResetService->createPasswordReset($request->email);
        Mail::to($request->email)->send(new FogottenPasswordMail($passwordResetData));


        return $this->responseHelper->successResponse(true, "password reset sent", $passwordResetData);

    }

    public function forgotPasswordToken(Request $request, $token)
    {
        $checkToken = $this->passwordResetService->checkReset($request->email, $token);

        if (!$checkToken) {
            return $this->responseHelper->errorResponse(false, "Details dont match", 400);
        }

        $user = $this->userService->getUserByEmail($request->email);

        if (!$user) {
            return $this->responseHelper->errorResponse(false, "User not found", 400);
        }

        // homework put into services
        $user->password = bcrypt($request->password);
        $user->save();

        // homework put into services
        $checkToken->delete();

        return $this->responseHelper->successResponse(true, "password reset complete", $user);

    }
}
