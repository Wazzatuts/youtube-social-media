<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
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
    public function me()
    {

        $user = Auth::user();

        return $this->responseHelper->successResponse(true, 'Here is the the user', $user);
    }

    public function addFriend($id)
    {
        // Add friend

//        $addUser = auth()->user()->friends()->attach([20,21,22,23]);

        // Remove Friend

//        $removeFriends = auth()->user()->friends()->detach([$id]);

        //Sync Friends
        $removeFriends = auth()->user()->friends()->sync([$id]);


        return $this->responseHelper->successResponse(true, 'Added User', []);
    }
}
