<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function me()
    {

        $user = Auth::user();

        return $this->responseHelper->successResponse(true, 'Here is the the user', $user);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function toggleFriend($id)
    {
        $userFriends = auth()->user()->friends();

        if ($userFriends->find($id)) {
            $userFriends->detach([$id]);
            return $this->responseHelper->successResponse(true, 'Removed Friend', []);
        }

        $userFriends->attach($id);

        return $this->responseHelper->successResponse(true, 'Added Friend', []);
    }

    /**
     * @return JsonResponse
     */
    public function getFriends()
    {
        $userFriends = auth()->user()->friends()->get();
        return $this->responseHelper->successResponse(true, 'All Friends', $userFriends);
    }
}
