<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserImageUploadRequest;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Storage;

class UserImageController extends Controller
{
    /**
     * @var ImageUploadService
     */
    protected $imageUploadService;
    /**
     * @var ResponseHelper
     */
    protected $responseHelper;

    /**
     * UserImageController constructor.
     * @param ImageUploadService $imageUploadService
     * @param ResponseHelper $responseHelper
     */
    public function __construct(ImageUploadService $imageUploadService, ResponseHelper $responseHelper)
    {
        $this->imageUploadService = $imageUploadService;
        $this->responseHelper = $responseHelper;
    }

    public function store(UserImageUploadRequest $request)
    {
        $file = $request->file->storeAs(
            'public/images/' . auth()->user()->id, $request->file->getClientOriginalName()
        );

        $this->imageUploadService->saveUpload($file);

        return $this->responseHelper->successResponse(true, 'Image Uploaded', null);
    }
}
