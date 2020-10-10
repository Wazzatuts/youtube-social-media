<?php


namespace App\Services;


use App\Repositories\Contracts\ImageUploadRepositoryContract;

class ImageUploadService
{
    /**
     * @var ImageUploadRepositoryContract
     */
    protected $imageUploadRepositoryContract;

    /**
     * ImageUploadService constructor.
     * @param ImageUploadRepositoryContract $imageUploadRepositoryContract
     */
    public function __construct(ImageUploadRepositoryContract $imageUploadRepositoryContract)
    {
        $this->imageUploadRepositoryContract = $imageUploadRepositoryContract;
    }

    public function saveUpload($file)
    {
        return $this->imageUploadRepositoryContract->saveUpload($file);
    }


}
