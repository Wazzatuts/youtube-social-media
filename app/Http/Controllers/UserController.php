<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var ResponseHelper
     */
    protected $responseHelper;

    /**
     * UserController constructor.
     * @param ResponseHelper $responseHelper
     */
    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper = $responseHelper;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {

        $user = Auth::user();

        return $this->responseHelper->successResponse(true, 'Here is the the user', $user);
    }
}
