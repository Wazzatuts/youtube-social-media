<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserImageUploadRequest;

class UserImageController extends Controller
{
    public function store(UserImageUploadRequest $request)
    {
        dd("hiya");

        /// Public/Images/{id}/$request->file = (bob.jpeg)
    }
}
